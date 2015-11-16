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
}
