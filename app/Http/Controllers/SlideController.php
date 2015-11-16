<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
use App\tbl_query as TBL;
use App\phphighchart as HC;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SlideController extends Controller
{
	/**
     * Display Slider Total Data in View 
     *
     * @return view of Slide Show Total Data , @compact ResultOneTbl,CountTotalTbl,SumResult
     */
    public function slideshowdata()
    {	
    	$thisyear = Carbon::now()->format('Y');
    	$thismonth =  (int)Carbon::now()->format('m');
        $beformonth = $thismonth-1;
    	$SumAll = 0.00;
    	$CountValueArray=0;
    	$totalavaliable = TBL::getAvaliableTbl();
        $totalEst = TBL::getEstMonth($thisyear,$thismonth);
        $ftEst = TBL::getFtMonth($thisyear,$thismonth);
    	$tbl_Array = array();
    	foreach ($totalavaliable as $tta) {
    		$resultConsumtiom = TBL::getDataInTbl($tta->tabledbname,$thisyear,$thismonth);
            $resultEstConsumtiom = TBL::getEstDataInTbl($tta->tabledbname,$thisyear,$thismonth);

            $BeforeMonthresultConsumtiom = TBL::getDataInTbl($tta->tabledbname,$thisyear,$beformonth);//
            $BeforeEstresultConsumtiom = TBL::getEstDataInTbl($tta->tabledbname,$thisyear,$beformonth);//
    		$SumAll = $SumAll+$resultConsumtiom;
    		$tbl_Array[$CountValueArray] = array($resultConsumtiom,$tta->groupName);
            $tbl_EstArray[$CountValueArray] = array($resultEstConsumtiom);

            $BeforeMonthTbl_Array[$CountValueArray] = array($BeforeMonthresultConsumtiom,$tta->groupName);
            $BeforeMonthEst_tbl[$CountValueArray] = array($BeforeEstresultConsumtiom);
            $CountValueArray++;

    	}
        //return dd($totalEst);
        return view('slideshow_data',compact('thismonth','tbl_Array','CountValueArray','SumAll','BeforeMonthTbl_Array','BeforeMonthEst_tbl','tbl_EstArray','totalEst','ftEst'));
        }

    public function highchart(){
        $thisyear = Carbon::now()->format('Y');
        $thismonth =  (int)Carbon::now()->format('m');
        $totalavaliable = TBL::getAvaliableTbl();
        $cttotal = count($totalavaliable);
        $loopJS = count($totalavaliable)/6; // Loop For print script to display  and 6 is web can display 6 in 1 page
        $ceilloopJS = ceil($loopJS); // such as 1.1  =  2
        $beformonth = $thismonth-1;
        $highchartobj = new HC;
        $SumAll = 0.00;
        $CountValueArray=0;
        $totalEst = TBL::getEstMonth($thisyear,$thismonth);
        $ftEst = TBL::getFtMonth($thisyear,$thismonth);
        $chart = array();
        $chart['dataname'] = ''; //place for display array of data name 
        $chart['dataEstBeforeMonth'] = '';
        $chart['dataBeforeMonth'] = '';
        $chart['dataEstThisMonth'] = '';
        $chart['dataThisMonth'] = '';
        $indexarr = 0;
        foreach ($totalavaliable as $tta) {
            $resultConsumtiom = TBL::getDataInTbl($tta->tabledbname,$thisyear,$thismonth);
            $resultEstConsumtiom = TBL::getEstDataInTbl($tta->tabledbname,$thisyear,$thismonth);

            $BeforeMonthresultConsumtiom = TBL::getDataInTbl($tta->tabledbname,$thisyear,$beformonth);//
            $BeforeEstresultConsumtiom = TBL::getEstDataInTbl($tta->tabledbname,$thisyear,$beformonth);//
            $SumAll = $SumAll+$resultConsumtiom;
            $tbl_Array[$CountValueArray] = array($resultConsumtiom,$tta->groupName);
            $tbl_EstArray[$CountValueArray] = array($resultEstConsumtiom);

            $BeforeMonthTbl_Array[$CountValueArray] = array($BeforeMonthresultConsumtiom,$tta->groupName);
            $BeforeMonthEst_tbl[$CountValueArray] = array($BeforeEstresultConsumtiom);
            $CountValueArray++;
        }
        for($i=0;$i<$ceilloopJS;$i++){
            for($j=0;$j<=5;$j++){
                if($indexarr<$cttotal){
                $chart['dataname'] .= '\''.$tbl_Array[$indexarr][1].'\','; //place for display array of data name 
                $chart['dataEstBeforeMonth'] .= $BeforeMonthEst_tbl[$indexarr][0].',';
                $chart['dataBeforeMonth'] .= $BeforeMonthTbl_Array[$indexarr][0].',';
                $chart['dataEstThisMonth'] .= $tbl_EstArray[$indexarr][0].',';
                $chart['dataThisMonth'] .= $tbl_Array[$indexarr][0].',';
                $indexarr++;
                }
                
            }
            
            $path = 'js';
            $chart['iddivname'] = '#container-show'.$i;
            $hc[$path] = $highchartobj->create_barchart($chart);
            //echo $cttotal." = ";
            //print_r($chart);
            $chart['dataname'] = ''; //place for display array of data name 
            $chart['dataEstBeforeMonth'] = '';
            $chart['dataBeforeMonth'] = '';
            $chart['dataEstThisMonth'] = '';
            $chart['dataThisMonth'] = '';
            
        }
        return view('user.slide',compact('hc','thismonth','tbl_Array','CountValueArray','SumAll','BeforeMonthTbl_Array','BeforeMonthEst_tbl','tbl_EstArray','totalEst','ftEst'));
    }
}
