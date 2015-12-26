<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

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
        return DB::table('tbl_'.$nametbl)
        ->where('year',$year)->where('month',$month)->sum('consumption');
    }

    public static function getEstDataInTbl($nametbl,$year,$month)
    {
        $data = 0;//
        $mdd_data = 0;//
        $newname = "'".$nametbl."'";
        $mddid = DB::table('matchdatadisplay')->select('mdd_id')->where('groupname',$nametbl)->get();
        foreach($mddid as $mdd_ids) { 
            $mdd_data = $mdd_ids->mdd_id; 
        }
        $before_data = DB::table('estimate_tool')->where('estimate_tool.mdd_id',$mdd_data)
        ->where('estimate_tool.year',$year)->where('estimate_tool.month',$month)->get();
        foreach ($before_data as $dt) {
            $data = $dt->estimate;
        }
        return $data;
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
    public static function avg_tbl_mea_BOT($year,$month)
    {
        return DB::table('tbl_mea_bot')
        ->where('year',$year)->where('month',$month)->avg('consumption');
    }
    public static function Building1($year,$month){
        return DB::table('tbl_mea_b1')
        ->where('year',$year)->where('month',$month)->sum('consumption');
    }
    public static function Building2($year,$month){
        return DB::table('tbl_mea_b2')
        ->where('year',$year)->where('month',$month)->sum('consumption');
    }
    public static function Building3456($year,$month){
        return DB::table('tbl_mea_b3')
        ->where('year',$year)->where('month',$month)->sum('consumption');
    }
    public static function Building7($year,$month){
        return DB::table('tbl_mea_b7')
        ->where('year',$year)->where('month',$month)->sum('consumption');
    }
    public static function BuildingOther($year,$month){
        $subA = DB::table('tbl_mea_b13')->where('year',$year)->where('month',$month)->sum('consumption');
        $subB = DB::table('tbl_mea_bd')->where('year',$year)->where('month',$month)->sum('consumption');
        //$subC = DB::table('tbl_mea_pw')->where('year',$year)->where('month',$month)->sum('consumption');
        //$subD = DB::table('tbl_mea_b89')->where('year',$year)->where('month',$month)->sum('consumption');
        //$subE = DB::table('tbl_mea_landscap')->where('year',$year)->where('month',$month)->sum('consumption');
        //mea_B13+mea_BD+ mea_PW+mea_B89+mea_landscap
        //return $subA+$subB+$subC+$subD+$subE;
        return $subA+$subB;
    }

    //---------------- Building 1 ---------------------
    //$tbl_LP_B1 = 
    //$tbl_AIR_B1 = 
     //$tbl_Other_B1 =
    public static function avg_B1($year,$month){
        return DB::table('tbl_mea_b1')->where('year',$year)->where('month',$month)->avg('consumption');
        //return 200;// ตาราง tbl_LP_B1 ไม่มี
    }
    public static function tbl_LP_B1($year,$month){
        //return DB::table('tbl_mea_b1')->where('year',$year)->where('month',$month)->sum('consumption');
        return 200;// ตาราง tbl_LP_B1 ไม่มี
    }
    public static function tbl_AIR_B1($year,$month){
        return DB::table('tbl_aircon_b1')->where('year',$year)->where('month',$month)->sum('consumption');
        //return 200;// ตาราง tbl_LP_B1 ไม่มี
    }
    public static function tbl_Other_B1($year,$month){
        //return DB::table('tbl_mea_b1')->where('year',$year)->where('month',$month)->sum('consumption');
        return 200;// ตาราง tbl_LP_B1 ไม่มี
    }
    //---------------- Building 2 ---------------------
    public static function avg_B2($year,$month){
        //return DB::table('tbl_mea_b2')->where('year',$year)->where('month',$month)->avg('consumption');
        return 90;// ตาราง tbl_mea_b2 ไม่มี
    }
    public static function tbl_LP_B2($year,$month){
        //return DB::table('tbl_LP_B2')->where('year',$year)->where('month',$month)->sum('consumption');
        return 200;// ตาราง tbl_LP_B2 ไม่มี
    }
    public static function tbl_AIR_B2($year,$month){
        //return DB::table('tbl_aircon_b2')->where('year',$year)->where('month',$month)->sum('consumption');
        return 100;// ตาราง aircon_b2 ไม่มี
    }
    public static function tbl_Other_B2($year,$month){
        //return DB::table('tbl_Other_B2')->where('year',$year)->where('month',$month)->sum('consumption');
        return 20;// ตาราง tbl_Other_B2 ไม่มี
    }
    //---------------- Building 3 ---------------------
    public static function avg_B3($year,$month){
        return 40;// ตาราง tbl_mea_b2 ไม่มี
    }
    public static function tbl_LP_B3($year,$month){
        return 50;// ตาราง tbl_LP_B2 ไม่มี
    }
    public static function tbl_AIR_B3($year,$month){
        return 10;// ตาราง aircon_b2 ไม่มี
    }
    public static function tbl_Other_B3($year,$month){
        return 20;// ตาราง tbl_Other_B2 ไม่มี
    }
    //---------------- Building 7 ---------------------
    public static function avg_B7($year,$month){
        return 20;// ตาราง tbl_mea_b2 ไม่มี
    }
    public static function tbl_LP_B7($year,$month){
        return 30;// ตาราง tbl_LP_B2 ไม่มี
    }
    public static function tbl_AIR_B7($year,$month){
        return 100;// ตาราง aircon_b2 ไม่มี
    }
    public static function tbl_Other_B7($year,$month){
        return 20;// ตาราง tbl_Other_B2 ไม่มี
    }
    //---------------- Building Other ---------------------
    public static function avg_BOther($year,$month){
        return 30;// ตาราง tbl_mea_b2 ไม่มี
    }
    public static function tbl_LP_BOther($year,$month){
        return 40;// ตาราง tbl_LP_B2 ไม่มี
    }
    public static function tbl_AIR_BOther($year,$month){
        return 30;// ตาราง aircon_b2 ไม่มี
    }
    public static function tbl_Other_BOther($year,$month){
        return 20;// ตาราง tbl_Other_B2 ไม่มี
    }
}
