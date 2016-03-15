<div style="background-color: white;">
            <div class="row">
                  <div class="col-md-3" style="margin-top: 50px;padding-left:20px"><h1>ค่าไฟฟ้าอาคาร 8 9</h1>
                    <?php
                    $date = new DateTime();
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
                    <h2 style="margin-top: 0px;"><?php  echo 'เดือน '.$month.' '.$year; ?></h2>
                    <table class="table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>การใช้งาน</th>
                                <th>จำนวน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%">เป้าหมาย</td>
                                <td width="50%" id="building89_est"></td>
                            </tr>
                            <tr>
                                <td>ปัจจุบันใช้</td>
                                <td id="building89_current"></td>
                            </tr>
                            <tr>
                                <td>เป็นเงิน</td>
                                <td id="building89_money"></td>
                            </tr>
                            <tr>
                                <td>ประมาณการเมื่อถึงสิ้นเดือน</td>
                                <td id="building89_esttomonth"></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-9">
                    <div id="container-building-89" style="margin: 0 auto;min-height: 500px"></div>
                  </div>
                </div>
        </div>
