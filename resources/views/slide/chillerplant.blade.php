<div style="background-color: white;">
            <div class="row">
                  <div class="col-md-12">
                    <?php
                    $date = new DateTime();
                    $days = $date->format('d');
                    $thismonth = $date->format('m');
                    $year = $date->format('Y');
                    switch( $thismonth ) {
                        case 1 : $month= "มกราคม"; break;
                        case 2 : $month= "กุมภาพันธ์"; break;
                        case 3 : $month= "มีนาคม"; break;
                        case 4 : $month= "เมษายน"; break;
                        case 5 : $month= "พฤภษาคม"; break;
                        case 6 : $month= "มิถุนายน"; break;
                        case 7 : $month= "กรกฏาคม"; break;
                        case 8 : $month= "สิงหาคม"; break;
                        case 9 : $month= "กันยายน"; break;
                        case 10 : $month= "ตุลาคม"; break;
                        case 11 : $month= "พฤศจิกายน"; break;
                        case 12 : $month= "ธันวาคม"; break;
                        default : $month= ""; break;
                    }?>
                    <h1>ค่าการใช้พลังงาน Chiller Plant <? echo 'ของวันที่ '.$days.' เดือน '.$month.' '.$year; ?></h1>
                    <h2 style="margin-top: 0px;" id="daymonth_bot_chiiler"></h2>
                    <div id="container_chiller_plant_all" style="margin: 0 auto;min-height: 500px"></div>
                  </div>
            </div>
</div>
