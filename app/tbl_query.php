<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Schema;
class tbl_query extends Model
{

	/**
     * get groupname like (%Total%) of matchdatadisplay table
     *
     * @return data table total of record in json array
     */
    public static function getTotalAvaliableTbl()
    {
    	return DB::table('matchdatadisplay')->where('status','1')
    	->get();
    }
    /**
     * get groupname of matchdatadisplay table
     *
     * @return data of record in json array
     */
    public static function getAvaliableTbl()
    {
    	return DB::table('matchdatadisplay')->where('status','1')
    	->get();
    }
	/**
     * Handle of get Data in table tbl_(name of table in table groupmeter)
     *
     * @param  nametbl is name of table in table groupmeter, Year to Display , Month to display
     * @return data of table in json array
     */
    public static function getDataInTbl($nametbl,$year,$month)
    {
    	  strtolower($nametbl);
        return DB::table($nametbl)
        ->where('year',$year)->where('month',$month)->sum('consumption');
    }

    public static function getEstDataInTbl($nametbl,$year,$month)
    {
        $data = 0;//
        $mdd_data = 0;//
        $newname = "'".$nametbl."'";
        $mddid = DB::table('matchdatadisplay')->select('mdd_id')->where('tabledbname',$nametbl)->get();
            //$mdd_data = $mdd_ids->mdd_id;
        $before_data = DB::table('estimate_tool')
        ->where('estimate_tool.mdd_id',$mddid[0]->mdd_id)
        ->where('estimate_tool.year',$year)
        ->where('estimate_tool.month',$month)->get();
          //$data = $dt->estimate;
        return $before_data[0]->estimate;
    }
    public static function getEstMonth($year,$month)
    {
        return DB::table('estimate_electriccity')
        ->where('year',$year)->where('month',$month)->sum('estimate');
    }
    public static function getFtMonth($year,$month)
    {
        return DB::table('estimate_electriccity')
        ->where('year',$year)->where('month',$month)->sum('ft');
    }

//--------------------  Bot ไหม่ -------------------------
    public static function tbl_mea_BOT($year,$month)
    {
        return DB::table('tbl_mea_bot')
        ->where('year',$year)->where('month',$month)->sum('consumption');
    }
    public static function avg_tbl_mea_BOT($year,$month,$thisday,$All_Used)
    {
        $table = 'tbl_mea_bot';
        $check = Schema::hasTable($table);
        switch($month) {
            case 1 : $thismonth= 31; break;
            case 2 : $thismonth= 28; break;
            case 3 : $thismonth= 31; break;
            case 4 : $thismonth= 30; break;
            case 5 : $thismonth= 31; break;
            case 6 : $thismonth= 30; break;
            case 7 : $thismonth= 31; break;
            case 8 : $thismonth= 31; break;
            case 9 : $thismonth= 30; break;
            case 10 : $thismonth= 31; break;
            case 11 : $thismonth= 30; break;
            case 12 : $thismonth= 31; break;
            default : $thismonth= 30; break;
        }
        if(!$check){
          return 0;
        }else{
          $valAvg = $All_Used;
          $valAvg = $valAvg/$thisday;//หาค่าเฉลี่ยของเดือนนี้
          $dayleft = $thismonth-$thisday;
          if($dayleft<=1){
            $dayleft=1;
          }
          $valAvg = $valAvg*$dayleft;
          return $valAvg;
        }
    }
    public static function Building1($year,$month){
        $check = Schema::hasTable('tbl_mea_b1');
        if(!$check){
          return 0;
        }else{
          return DB::table('tbl_mea_b1')
          ->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    public static function Building2($year,$month){
        $check = Schema::hasTable('tbl_mea_b2');
        if(!$check){
          return 0;
        }else{
          return DB::table('tbl_mea_b2')
          ->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    public static function Building3456($year,$month){
        $check = Schema::hasTable('tbl_mea_b3');
        if(!$check){
          return 0;
        }else{
          return DB::table('tbl_mea_b3')
          ->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    public static function Building7($year,$month){
        $check = Schema::hasTable('tbl_mea_b7');
        if(!$check){
          return 0;
        }else{
          return DB::table('tbl_mea_b7')
          ->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    public static function Building13($year,$month){
        $check = Schema::hasTable('tbl_mea_b13');
        if(!$check){
          return 0;
        }else{
          return DB::table('tbl_mea_b13')
          ->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    public static function Building89($year,$month){
        $check = Schema::hasTable('tbl_mea_b89');
        if(!$check){
          return 0;
        }else{
          return DB::table('tbl_mea_b89')
          ->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    public static function BuildingOther($year,$month){
        $subA = DB::table('tbl_mea_b13')->where('year',$year)->where('month',$month)->sum('consumption');
        $subB = DB::table('tbl_mea_bd')->where('year',$year)->where('month',$month)->sum('consumption');
        return $subA+$subB;
    }

    //---------------- Building  ---------------------
    public static function realuse_building($building_number,$year,$month){
        $table = 'tbl_building_b'.$building_number;
        $check = Schema::hasTable($table);
        if(!$check){
          return 0;
        }else {
          return DB::table($table)
          ->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    public static function avg_B($building_number,$year,$month,$thisday){
      $table = 'tbl_building_b'.$building_number;
      $check = Schema::hasTable($table);
      switch($month) {
          case 1 : $thismonth= 31; break;
          case 2 : $thismonth= 28; break;
          case 3 : $thismonth= 31; break;
          case 4 : $thismonth= 30; break;
          case 5 : $thismonth= 31; break;
          case 6 : $thismonth= 30; break;
          case 7 : $thismonth= 31; break;
          case 8 : $thismonth= 31; break;
          case 9 : $thismonth= 30; break;
          case 10 : $thismonth= 31; break;
          case 11 : $thismonth= 30; break;
          case 12 : $thismonth= 31; break;
          default : $thismonth= 30; break;
      }
      if(!$check){
        return 0;
      }else{
        $valAvg = DB::table($table)->where('year',$year)->where('month',$month)->sum('consumption');
        $valAvg = $valAvg/$thisday;//หาค่าเฉลี่ยของเดือนนี้
        $dayleft = $thismonth-$thisday;
        if($dayleft<=1){
          $dayleft=1;
        }
        $valAvg = $valAvg*$dayleft;
        return $valAvg;
      }
    }
    //ไฟฟ้า ตึก
    public static function tbl_LP_B($building_number,$year,$month){
        $table = 'tbl_pb'.$building_number;
        $check = Schema::hasTable($table);
        if(!$check){
          return 0;
        }else{
          return DB::table($table)->where('year',$year)->where('month',$month)->avg('consumption');
        }
    }
    // แอร์ ตึก
    public static function tbl_AIR_B($building_number,$year,$month){
        $table = 'tbl_aircon_b'.$building_number;
        $check = Schema::hasTable($table);
        if(!$check){
          return 0;
        }else{
            return DB::table($table)->where('year',$year)->where('month',$month)->sum('consumption');
        }
    }
    // อื่นๆ ตึก
    public static function tbl_Other_B($building_number,$year,$month){
      $table = 'tbl_building_b'.$building_number;
      $check_1 = Schema::hasTable($table);
      if(!$check_1){
        $tb1 = 0;
      }else{
        $tb1 = DB::table($table)->where('year',$year)->where('month',$month)->sum('consumption');
      }
      $table = 'tbl_pb'.$building_number;
      $check_2 = Schema::hasTable($table);
      if(!$check_2){
        $tb2 = 0;
      }else{
        $tb2 = DB::table($table)->where('year',$year)->where('month',$month)->sum('consumption');
      }
      $table = 'tbl_aircon_b'.$building_number;
      $check_3 = Schema::hasTable($table);
      if(!$check_3){
        $tb3 = 0;
      }else{
        $tb3 = DB::table($table)->where('year',$year)->where('month',$month)->sum('consumption');
      }
      return $tb1-$tb2-$tb3;
    }
}
