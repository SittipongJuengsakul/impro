<?php
$date = new DateTime();
$thismonth = $date->format('m');
$year = $date->format('Y');
switch( $thismonth ) {
    case 1 : $monthd= "มกราคม"; break;
    case 2 : $monthd= "กุมภาพันธ์"; break;
    case 3 : $monthd= "มีนาคม"; break;
    case 4 : $monthd= "เมษายน"; break;
    case 5 : $monthd= "พฤภษาคม"; break;
    case 6 : $monthd= "มิถุนายน"; break;
    case 7 : $monthd= "กรกฏาคม"; break;
    case 8 : $monthd= "สิงหาคม"; break;
    case 9 : $monthd= "กันยายน"; break;
    case 10 : $monthd= "ตุลาคม"; break;
    case 11 : $monthd= "พฤศจิกายน"; break;
    case 12 : $monthd= "ธันวาคม"; break;
    default : $monthd= ""; break;
}?>
<div style="background-color: white;">
            <div class="row">
                  <div class="col-md-12">
                    <h1>ค่าการใช้พลังงาน Chiller Plant</h1><?php echo 'วันที่ '.$date->format('d').' '.$monthd.' '.$year; ?>
                    <h2 style="margin-top: 0px;" id="daymonth_bot_chiiler"></h2>
                    <div id="container_chiller_plant_all" style="margin: 0 auto;min-height: 500px"></div>
                  </div>
            </div>
</div>
