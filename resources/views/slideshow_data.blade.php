@extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')
@section('content')
<div id="container" style="margin: 0;">
    <div id="slider">
    <!-- Add Building All Area -->
    @include('slide.building_all')
    <!-- Add Building 1 Area -->
    @include('slide.building_1')
    <!-- Chiller Plant -->
    @include('slide.chillerplant')
    <!-- แสดงการไช้งานหน่วย-->
    @include('slide.showkwh')
    <!-- แสดงการไช้เงินหน่วย-->
    @include('slide.showmoney')
    <!-- แสดงการไช้พลังงานกลุ่ม 1-->
    @include('slide.energyg1')
    @include('slide.energyg2')
    @include('slide.energyg3')
    @include('slide.energyg4')
    @include('slide.energyg5')
    @include('slide.energyg6')
    @include('slide.energyg7')
    @include('slide.energyg8')
    @include('slide.energyg9')
    @include('slide.energyg10')
    @include('slide.energyg11')
    @include('slide.energyg12')
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
    chiller_show();
    showkwnmoney();
    energy_show(1);
    energy_show(2);
    energy_show(3);
    energy_show(4);
    energy_show(5);
    energy_show(6);
    energy_show(7);
    energy_show(8);
    energy_show(9);
    energy_show(10);
    energy_show(11);
    energy_show(12);

    setInterval(function(){
      page_number+=1;
      if(page_number>=3){
        page_number=1;
      }
      building1_show();
  }, 900000);
  });

    </script>
@stop
