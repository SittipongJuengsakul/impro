<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
use App\tbl_query as TBL;
use App\phphighchart as HC;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
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

        $Building1_arr = array(0,0,0,0,0,0);
        return view('slideshow_data',compact('EstMonthtoUse','thismonth','All_Used','tbl_EstArray','totalEst','ftEst','Building','Building1_arr'));

      }

        public function building_data($building_number)
        {
          //ปีปัจจุบัน
      	$thisyear = Carbon::now()->format('Y');
          //เดือนปัจจุบัน
      	$thismonth =  (int)Carbon::now()->format('m');
          //วันปัจจุบัน
          $thisday =  (int)Carbon::now()->format('d');
          $real_use = TBL::realuse_building($building_number,$thisyear,$thismonth);
          $est_building = TBL::getEstDataInTbl('tbl_building_b'.$building_number,$thisyear,$thismonth);
          $ftEst_building = TBL::getFtMonth($thisyear,$thismonth);
          $tbl_LP_B = TBL::tbl_LP_B($building_number,$thisyear,$thismonth);
          $tbl_AIR_B = TBL::tbl_AIR_B($building_number,$thisyear,$thismonth);
          $tbl_Other_B = TBL::tbl_Other_B($building_number,$thisyear,$thismonth);
          $dayB = TBL::avg_B($building_number,$thisyear,$thismonth,$thisday);
          //$Building1_arr = array($ftEst_building1,$est_building1,$tbl_LP_B1,$tbl_AIR_B1,$tbl_Other_B1,$avg_B1);
          try{
                $statusCode = 200;
                 $response = [
                   'use_building' => number_format($real_use, 2),
                   'all_use'=>$real_use,
                   'est_building' => number_format($est_building, 2),
                   'ftEst_building' => number_format($ftEst_building, 2),
                   'endmonth_building' => number_format($real_use+$dayB, 2),
                   'money_building' => number_format($real_use*$ftEst_building, 2),
                   'avg_building' => $dayB,
                   'elect' => $tbl_LP_B,
                   'air' => $tbl_AIR_B,
                   'other' => $tbl_Other_B,
                 ];
         }catch (Exception $e){
             $statusCode = 400;
         }finally{
             return Response::json($response, $statusCode);
         }
        }
}
