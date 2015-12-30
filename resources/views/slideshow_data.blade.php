@extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')
@section('content')
<div id="container" style="margin: 0;">
    <div id="slider">
    <!-- Add Building All Area -->
    <!-- @include('slide.building_all') -->
    <!-- Add Building 1 Area -->
    @include('slide.building_1')
    <!-- Add Building 2 Area -->
    @include('slide.building_2')
    <!-- Add Building 3 Area -->
    @include('slide.building_3')
    <!-- Add Building 7 Area -->
    @include('slide.building_7')
    <!-- Add Building other Area -->
    @include('slide.building_other')
    <!-- Chiller Plant -->
    @include('slide.chillerplant')
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
  //BuildingAll({{ $Building[0] }},{{ $Building[1] }},{{ $Building[2] }},{{ $Building[3] }},{{ $Building[4] }});
  //<div style="background:url(spinner.gif) no-repeat center center;width:32px;height:32px;"></div>
  function building1_show(){
    $('#building1_est').html('<div class="loader_content"></div>');
    $('#building1_current').html('<div class="loader_content"></div>');
    $('#building1_money').html('<div class="loader_content"></div>');
    $('#building1_esttomonth').html('<div class="loader_content"></div>');
    $.ajax({
      url: 'http://localhost/impro-bot/public/user/slideshow/building_data/1'
    }).then(function(data) {
        $('#building1_est').html(data.est_building+' kWh');
        $('#building1_current').html(data.use_building+' kWh');
        $('#building1_money').html(data.money_building +' บาท');
        $('#building1_esttomonth').html(data.endmonth_building+' kWh');
        var other_data = data.all_use-data.elect-data.air;
        show_Building('#container-building-1',data.elect,data.air,other_data,'1');
    });
  }
  function building2_show() {
    $('#building2_est').html('<div class="loader_content"></div>');
    $('#building2_current').html('<div class="loader_content"></div>');
    $('#building2_money').html('<div class="loader_content"></div>');
    $('#building2_esttomonth').html('<div class="loader_content"></div>');
    $.ajax({
      url: 'http://localhost/impro-bot/public/user/slideshow/building_data/2'
    }).then(function(data) {
        $('#building2_est').html(data.est_building+' kWh');
        $('#building2_current').html(data.use_building+' kWh');
        $('#building2_money').html(data.money_building +' บาท');
        $('#building2_esttomonth').html(data.endmonth_building+' kWh');
        var other_data = data.all_use-data.elect-data.air;
        show_Building('#container-building-2',data.elect,data.air,other_data,'2');
    });
  }
  function building3_show() {
    $('#building3_est').html('<div class="loader_content"></div>');
    $('#building3_current').html('<div class="loader_content"></div>');
    $('#building3_money').html('<div class="loader_content"></div>');
    $('#building3_esttomonth').html('<div class="loader_content"></div>');
    $.ajax({
      url: 'http://localhost/impro-bot/public/user/slideshow/building_data/3'
    }).then(function(data) {
        $('#building3_est').html(data.est_building+' kWh');
        $('#building3_current').html(data.use_building+' kWh');
        $('#building3_money').html(data.money_building +' บาท');
        $('#building3_esttomonth').html(data.endmonth_building+' kWh');
        var other_data = data.all_use-data.elect-data.air;
        show_Building('#container-building-3',data.elect,data.air,other_data,'3');
    });
  }

  var page_number=1;
  $(document).ready(function () {
    building1_show();
    building2_show();
    building3_show();
    setInterval(function(){
      page_number+=1;
      if(page_number>=3){
        page_number=1;
      }
        building1_show();
        building2_show();
        building3_show();
  }, 4000);
  });

    </script>
@stop
