<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Input;
use App\Http\Controllers\UrlPath as UrlPath; //Save URL in here

class HomeController extends Controller
{
    public function index()
    {
		if(Auth::check()){
            return redirect(UrlPath::UserHomeUrlPath());
        }
        else{
            return redirect(UrlPath::LoginUrlPath());
        }

    }

    public function home()
    {
        return view(UrlPath::UserHomeUrlPath());
    }

    public function showdata(){
        if (Auth::check())
        {
            $years = DB::table('tbl_ahu_b1')->groupBy('year')->get();
            $meters = DB::table('groupmeter')
                    ->select('groupName')
                    ->get();
            return view('report_data',['year' => $years],['meter' => $meters]);
        }
        else{
            return redirect(UrlPath::LoginUrlPath());
        }

    }

    public function form_estimate(){
        if (Auth::check())
        {
        //qury year from table "tdl_1d" for select year data (if tdl_1d delete DATADASE ERROR !!)
        $years = DB::table('tbl_ahu_b1')->select('year')->groupBy('year')->get();

        return view('estimate_form',['year' => $years]);
        }
        else{
            return redirect(UrlPath::LoginUrlPath());
        }
    }


    public function set_estimate(){
		if (Auth::check())
        {
        //input value from view estimate_form
        $year = Input::get('year');

        $results = DB::select('select * from estimate_electriccity where year = :id', ['id' => $year]);

        //check Year in Database
        if($results == NULL){
            //insert data ta Database
            for ($i=1; $i <= 12; $i++) {
                DB::insert('insert into estimate_electriccity (month,year,estimate,Ft) values (?,?,?,?)', [$i,$year,0,0]);
            }//for

            $results2 = DB::select('select * from estimate_electriccity where year = :id', ['id' => $year]);
            return view('estimate_set',['results' => $results2],['year' => $year]);

        }else{

            return view('estimate_set',['results' => $results],['year' => $year]);

        }//else
        }
        else{
            return redirect(UrlPath::LoginUrlPath());
        }
    }


    public function submit(){
        if (Auth::check())
        {
        $groupMeter = $_POST['tool_php'];
        $month = $_POST['month_php'];
        $year = $_POST['year_php'];
        $data = $this->get_data_db($groupMeter,$month,$year);
        echo json_encode($data);
        }
        else{
            return redirect(UrlPath::LoginUrlPath());
        }
    }

    public function test()
    {
      $max = DB::table("tbl_ahu_b1")
      ->select('date',DB::raw('ROUND(MAX(kwh),2) as kwh'))
      ->where('month','1')
      ->where('year','2016')
      ->groupBy('date')
      ->get();
      //return $max[0]->kwh;
      dd(count($max));
    }
    function get_data_db($table,$month,$year){
        if (Auth::check())
        {
            $max = DB::table("tbl_".$table)
            ->select('date',DB::raw('ROUND(MAX(kwh),2) as kwh'))
            ->where('month',$month)
            ->where('year',$year)
            ->groupBy('date')
            ->get();

            $min = DB::table("tbl_".$table)
            ->select('date',DB::raw('ROUND(MIN(kwh),2) as kwh'))
            ->where('month',$month)
            ->where('kwh','>','0')
            ->where('year',$year)
            ->groupBy('date')
            ->get();
              for($i=0;$i<count($min);$i++){
                if($min[$i]->kwh > 0){
                  $max[$i]->kwh = $max[$i]->kwh - $min[$i]->kwh;
                }
              }
            $results = $max;
            return $results;

        }
        else{
            return redirect(UrlPath::LoginUrlPath());
        }
    }

    public function save_estimate(){
        if (Auth::check())
        {
              //nnnnecho Input::get('ft_1');
        for ($i=1; $i <= 12; $i++) {
            $name1 =  'est_'.$i;
            $name2 =  'ft_'.$i;
            $year = Input::get('year');
            $estimate = Input::get($name1);
            $Ft = Input::get($name2);

            $string = $estimate;
            $newString = '';
            $arrString = explode(',', $string);
            foreach ($arrString as $v) {
                $newString .=  $v;
            }

            $estimate = $newString;
            //echo $name1." ".$name2;
            //echo $year."   ".$estimate."  ".$Ft;
            DB::update('update estimate_electriccity set estimate = ?,Ft = ? where month = ? and year = ? ', [$estimate,$Ft,$i,$year]);
        }

        $years = DB::table('tbl_ahu_b1')->select('year')->groupBy('year')->get();

        return redirect('user/form_estimate')->with('years');
        }
        else{
            return redirect(UrlPath::LoginUrlPath());
        }
    }

    public function tool_estimate(){
        if (Auth::check())
        {

        $year = Input::get('year');
        $month = Input::get('month');

        // Check have month and year in Database
        $results = DB::select('SELECT * from estimate_tool where year = ? and month = ?',[$year,$month]);
        //get data tool
        $results1 = DB::select('SELECT matchdatadisplay.mdd_id,matchdatadisplay.groupName,estimate_tool.year,estimate_tool.month,estimate_tool.estimate FROM estimate_tool JOIN matchdatadisplay ON matchdatadisplay.mdd_id = estimate_tool.mdd_id WHERE estimate_tool.year = ? and estimate_tool.month = ? AND matchdatadisplay.status = 1',[$year,$month]);
        //get idtool
        $results2 = DB::select('SELECT * FROM matchdatadisplay');
       // echo "<pre>";
       // print_r($results2);die();

        if($results == NULL){
            // foreach is save data to databasse
           // echo count($results2);
            foreach ($results2 as $key) {
               // echo $key->mdd_id;
               DB::insert('insert into estimate_tool (month,year,estimate,mdd_id) values (?,?,?,?)', [$month,$year,0,$key->mdd_id]);
            }

            //get data tool
            $results3 = DB::select('SELECT matchdatadisplay.mdd_id,matchdatadisplay.groupName,estimate_tool.year,estimate_tool.month,estimate_tool.estimate FROM estimate_tool JOIN matchdatadisplay ON matchdatadisplay.mdd_id = estimate_tool.mdd_id WHERE estimate_tool.year = ? and estimate_tool.month = ? AND matchdatadisplay.status = 1',[$year,$month]);

            return view('estimate_tool',['results' => $results3,'year' => $year,'month' => $month]);
        }else{
            if(count($results2) == count($results)){
                return view('estimate_tool',['results' => $results1,'year' => $year,'month' => $month]);
            }else{
                foreach ($results2 as $key) {
                    $check = DB::select('SELECT * FROM estimate_tool WHERE year = ? AND month = ? AND mdd_id = ?',[$year,$month,$key->mdd_id]);
                    //print_r($check);
                    if($check == NULL){
                       DB::insert('insert into estimate_tool (month,year,estimate,mdd_id) values (?,?,?,?)', [$month,$year,0,$key->mdd_id]);
                    }
                }
                $results4 = DB::select('SELECT matchdatadisplay.mdd_id,matchdatadisplay.groupName,estimate_tool.year,estimate_tool.month,estimate_tool.estimate FROM estimate_tool JOIN matchdatadisplay ON matchdatadisplay.mdd_id = estimate_tool.mdd_id WHERE estimate_tool.year = ? and estimate_tool.month = ? AND matchdatadisplay.status = 1  GROUP BY estimate_tool.mdd_id ASC',[$year,$month]);
                return view('estimate_tool',['results' => $results4,'year' => $year,'month' => $month]);
            }
        }
		}
		else{
            return redirect(UrlPath::LoginUrlPath());
        }

    }

    public function save_toolestimate(){
        if (Auth::check())
        {
        $year = Input::get('year');
        $month = Input::get('month');

        $num = Input::get('num');

        //echo $num."-".$year."-".$month;

        for ($i=1; $i <= $num; $i++) {
            $name2 = 'mddid_'.$i;
            $name =  'est_'.$i;
            $estimate = Input::get($name);
            $id = Input::get($name2);

            $string = $estimate;
            $newString = '';
            $arrString = explode(',', $string);
            foreach ($arrString as $v) {
                $newString .=  $v;
            }

            $estimate = $newString;
            //echo $id;
            DB::update('update estimate_tool set estimate = ? where mdd_id = ? and month = ? and year = ? ', [$estimate,$id,$month,$year]);
        }

        $years = DB::table('tbl_ahu_b1')->select('year')->groupBy('year')->get();

        return view('estimatetool_form',['year' => $years]);
		}
		else{
				return redirect(UrlPath::LoginUrlPath());
        }
    }

    public function form_toolestimate(){
        if (Auth::check())
        {
        //qury year from table "tdl_1d" for select year data (if tdl_1d delete DATADASE ERROR !!)
        $years = DB::table('tbl_ahu_b1')->select('year')->groupBy('year')->get();

        return view('estimatetool_form',['year' => $years]);
		}
		else{
			return redirect(UrlPath::LoginUrlPath());
        }
    }
}
