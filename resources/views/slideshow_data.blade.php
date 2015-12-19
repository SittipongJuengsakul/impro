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
    <!-- Add Building 3 4 5 6 Area -->
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
  //init
  //highchart all Building
  BuildingAll({{ $Building[0] }},{{ $Building[1] }},{{ $Building[2] }},{{ $Building[3] }},{{ $Building[4] }});
  show_Building1({{ $Building1_arr[2] }},{{ $Building1_arr[3] }},{{ $Building1_arr[4] }});
  show_Building2({{ $Building2_arr[2] }},{{ $Building2_arr[3] }},{{ $Building2_arr[4] }});
  show_Building3({{ $Building3_arr[2] }},{{ $Building3_arr[3] }},{{ $Building3_arr[4] }});
  show_Building7({{ $Building7_arr[2] }},{{ $Building7_arr[3] }},{{ $Building7_arr[4] }});
  show_BuildingOther({{ $BuildingOther_arr[2] }},{{ $BuildingOther_arr[3] }},{{ $BuildingOther_arr[4] }});

    </script>
@stop
