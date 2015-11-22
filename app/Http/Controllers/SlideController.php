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
        //ปีปัจจุบัน
    	$thisyear = Carbon::now()->format('Y');
        //เดือนปัจจุบัน
    	$thismonth =  (int)Carbon::now()->format('m');
        //วันปัจจุบัน
        $thisday =  (int)Carbon::now()->format('d');
        //เป้าหมายการไช้ไฟฟ้าของเดือนนี้ ทุกตึก
        $totalEst = TBL::getEstMonth($thisyear,$thismonth);
        //ค่าไฟฟ้า
        $ftEst = TBL::getFtMonth($thisyear,$thismonth);
        //เดือนที่แล้ว
        $beformonth = $thismonth-1;
        //ปริมาณไฟฟ้าที่ไช้รวมทุกตึก
        $All_Used = TBL::tbl_mea_BOT($thisyear,$thismonth);
        //ประมาณปริมาณที่ไช้จากวันที่เหลือของเดือน
        $EstMonthtoUse = TBL::avg_tbl_mea_BOT($thisyear,$thismonth)*(30-$thisday);
        //ตึก 1
        $b1 = TBL::Building1($thisyear,$thismonth);
        //ตึก 2
        //$b2 = TBL::Building2($thisyear,$thismonth); b2 ไม่มี
        $b2 = 100;
        //ตึก 3 4 5 6
        $b3 = TBL::Building3456($thisyear,$thismonth);
        //ตึก 7
        $b7 = TBL::Building7($thisyear,$thismonth);
        //ตึก other : mea_PW+mea_B89+mea_landscap ไม่มี
        $bOther = TBL::BuildingOther($thisyear,$thismonth);
        //ประกาศค่า building รวม
        $Building = array($b1,$b2,$b3,$b7,$bOther);
        //------------------- ข้อมูลตึก 1 ----------------------
        $est_building1 = 10000;
        $ftEst_building1 = 7.62;
        $tbl_LP_B1 = TBL::tbl_LP_B1($thisyear,$thismonth);
        $tbl_AIR_B1 = TBL::tbl_AIR_B1($thisyear,$thismonth);
        $tbl_Other_B1 = TBL::tbl_Other_B1($thisyear,$thismonth);
        $dayB = TBL::avg_B1($thisyear,$thismonth)*(30-$thisday);
        $avg_B1 = $Building[0]+$dayB;
        $Building1_arr = array($ftEst_building1,$est_building1,$tbl_LP_B1,$tbl_AIR_B1,$tbl_Other_B1,$avg_B1);
        //------------------- ข้อมูลตึก 2 ----------------------
        $est_building2 = 20000;
        $ftEst_building2 = 7.62;
        $tbl_LP_B2 = TBL::tbl_LP_B2($thisyear,$thismonth);
        $tbl_AIR_B2 = TBL::tbl_AIR_B2($thisyear,$thismonth);
        $tbl_Other_B2 = TBL::tbl_Other_B2($thisyear,$thismonth);
        $dayB = TBL::avg_B2($thisyear,$thismonth)*(30-$thisday);
        $avg_B2 = $Building[0]+$dayB;
        $Building2_arr = array($ftEst_building2,$est_building2,$tbl_LP_B2,$tbl_AIR_B2,$tbl_Other_B2,$avg_B2);
        //------------------- ข้อมูลตึก 3 4 5 6 ----------------------
        $est_building3 = 30000;
        $ftEst_building3 = 7.62;
        $tbl_LP_B3 = TBL::tbl_LP_B3($thisyear,$thismonth);
        $tbl_AIR_B3 = TBL::tbl_AIR_B3($thisyear,$thismonth);
        $tbl_Other_B3 = TBL::tbl_Other_B3($thisyear,$thismonth);
        $dayB = TBL::avg_B3($thisyear,$thismonth)*(30-$thisday);
        $avg_B3 = $Building[0]+$dayB;
        $Building3_arr = array($ftEst_building3,$est_building3,$tbl_LP_B3,$tbl_AIR_B3,$tbl_Other_B3,$avg_B3);
        //------------------- ข้อมูลตึก 7 ----------------------
        $est_building7 = 70000;
        $ftEst_building7 = 7.62;
        $tbl_LP_B7 = TBL::tbl_LP_B7($thisyear,$thismonth);
        $tbl_AIR_B7 = TBL::tbl_AIR_B7($thisyear,$thismonth);
        $tbl_Other_B7 = TBL::tbl_Other_B7($thisyear,$thismonth);
        $dayB = TBL::avg_B7($thisyear,$thismonth)*(30-$thisday);
        $avg_B7 = $Building[0]+$dayB;
        $Building7_arr = array($ftEst_building7,$est_building7,$tbl_LP_B7,$tbl_AIR_B7,$tbl_Other_B7,$avg_B7);

        //------------------- ข้อมูลตึก Other ----------------------
        $est_buildingOther = 100000;
        $ftEst_buildingOther = 7.62;
        $tbl_LP_BOther = TBL::tbl_LP_BOther($thisyear,$thismonth);
        $tbl_AIR_BOther = TBL::tbl_AIR_BOther($thisyear,$thismonth);
        $tbl_Other_BOther = TBL::tbl_Other_BOther($thisyear,$thismonth);
        $dayB = TBL::avg_BOther($thisyear,$thismonth)*(30-$thisday);
        $avg_BOther = $Building[0]+$dayB;
        $BuildingOther_arr = array($ftEst_buildingOther,$est_buildingOther,$tbl_LP_BOther,$tbl_AIR_BOther,$tbl_Other_BOther,$avg_BOther);
        
        //return TBL::avg_B1($thisyear,$thismonth);
        return view('slideshow_data',compact('EstMonthtoUse','thismonth','All_Used','tbl_EstArray','totalEst','ftEst','Building','Building1_arr','Building2_arr','Building3_arr','Building7_arr','BuildingOther_arr'));
        }
/*
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
    */
}
