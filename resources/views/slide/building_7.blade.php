<div style="background-color: white;">
            <div class="row">
                  <div class="col-md-3" style="margin-top: 50px;padding-left:20px"><h1>ค่าไฟฟ้าอาคาร 7</h1>
                  <h2 style="margin-top: 0px;">เดือน <?
                    
                    echo $month;?> {{ Carbon\Carbon::now()->format('Y')+543 }}</h2>
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
                                <td width="50%" id="building7_est"></td>
                            </tr>
                            <tr>
                                <td>ปัจจุบันใช้</td>
                                <td id="building7_current"></td>
                            </tr>
                            <tr>
                                <td>เป็นเงิน</td>
                                <td id="building7_money"></td>
                            </tr>
                            <tr>
                                <td>ประมาณการเมื่อถึงสิ้นเดือน</td>
                                <td id="building7_esttomonth"></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-9">
                    <div id="container-building-7" style="margin: 0 auto;min-height: 500px"></div>
                  </div>
                </div>
        </div>
