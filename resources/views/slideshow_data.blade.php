@extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')
@section('content')
<div id="container" style="margin: 0;">
    <div id="slider">
    <!-- Add Building All Area -->
    <!-- @include('slide.building_all') -->
    <!-- Add Building 1 Area -->
    @include('slide.building_1')

    </div>
</div>


<script src="{{ URL::asset('assets/js/highcharts.js') }}"></script>
<script src="{{ URL::asset('assets/js/slideShowData/slideshowdata.js') }}"></script>
<script src="{{ URL::asset('assets/js/modules/exporting.js') }}"></script>
<script>
  //init
  //highchart all Building
  //BuildingAll({{ $Building[0] }},{{ $Building[1] }},{{ $Building[2] }},{{ $Building[3] }},{{ $Building[4] }});

  setTimeout(function(){
     $.ajax({
 		    url: 'http://localhost/impro-bot/public/user/slideshow/building_data/1'
 		}).then(function(data) {
        $('#building1_est').html(data.est_building+' kWh');
        $('#building1_current').html(data.use_building+' kWh');
        $('#building1_money').html(data.money_building +' บาท');
        $('#building1_esttomonth').html(data.endmonth_building+' kWh');
 		   	show_Building1(data.elect,data.air,data.other);
 		});
  }, 1000);

    </script>
@stop
