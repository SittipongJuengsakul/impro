@extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')
@section('content')
<div id="container" style="margin: 0;">
    <div id="slider">
    <!-- Add Building All Area -->
    @include('slide.building_all')
    <!-- Add Building 1 Area -->
    @include('slide.building_1')
    <!-- Add Building 2 Area -->
    @include('slide.building_2')
    <!-- Add Building 3 Area -->
    @include('slide.building_3')
    <!-- Add Building 7 Area -->
    @include('slide.building_7')
    <!-- Add Building 13 Area -->
    @include('slide.building_13')
    <!-- Add Building 89 Area -->
    @include('slide.building_89')
    <!-- Chiller Plant -->
    @include('slide.chillerplant')
    <!-- แสดงการไช้งานหน่วย-->
    @include('slide.showkwh')
    <!-- แสดงการไช้เงินหน่วย-->
    @include('slide.showmoney')
    </div>
</div>


<script src="{{ URL::asset('assets/js/highcharts.js') }}"></script>
<script src="{{ URL::asset('assets/js/slideShowData/slideshowdata.js') }}"></script>
<script src="{{ URL::asset('assets/js/modules/exporting.js') }}"></script>
<script>
  //รีเฟชหน้าทุกๆ วันเวลา 00.00.01
  refreshAt(0,0,1);
  //init
  //highchart all Building
  //<div style="background:url(spinner.gif) no-repeat center center;width:32px;height:32px;"></div>


  var page_number=1;
  $(document).ready(function () {
    buildingall_show()
    building1_show();
    building2_show();
    building3_show();
    building7_show();
    building13_show();
    building89_show();
    $.ajax({
      url: 'http://localhost/impro-bot/public/user/slideshow/chillerplant_show_all'
    }).then(function(data) {
        chillerplant_show_dayall(data.b1,data.b2,data.b5,data.b7,data.dc1);
    });
    //showkwh
    $.ajax({
      url: 'http://localhost/impro-bot/public/user/slideshow/showkwh_all'
    }).then(function(data) {
        $('#showkwh_todayuse').html(data.daykwh);
        $('#showkwh_tomonthuse').html(data.monthkwh);
        $('#showkwh_toyearuse').html(data.yearkwh);
        $('#showmoney_todayuse').html(data.daymoney);
        $('#showmoney_tomonthuse').html(data.monthmoney);
        $('#showmoney_toyearuse').html(data.yearmoney);
    });


    setInterval(function(){
      page_number+=1;
      if(page_number>=3){
        page_number=1;
      }
        building1_show();
        building2_show();
        building3_show();
        building7_show();
        building13_show();
        building89_show();
        //chillerplant show
        $.ajax({
          url: 'http://localhost/impro-bot/public/user/slideshow/chillerplant_show_all'
        }).then(function(data) {
            chillerplant_show_dayall(data.b1,data.b2,data.b5,data.b7,data.dc1);
        });
  }, 900000);
  });

    </script>
@stop
