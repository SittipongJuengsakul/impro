@extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')
@section('content')
<div id="container" style="margin: 0;">
    <div id="slider">
    <!-- Add intro -->
    @include('slide.intro')
    <!-- Add mapbot -->
    @include('slide.mapbot')
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
    <!-- แสดงหน้าประหยัดพลังงาน-->
    @include('slide.energysave')
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
  var site_url = '{{ URL::to("/") }}';
  var d = new Date();
  var monthbotjs = d.getMonth();
  var yearbotjs = d.getFullYear()+543;
  var daybotjs = d.getUTCDate();
  switch( monthbotjs ) {
      case 0 : monthbotjs= "มกราคม"; break;
      case 1 : monthbotjs= "กุมภาพันธ์"; break;
      case 2 : monthbotjs= "มีนาคม"; break;
      case 3 : monthbotjs= "เมษายน"; break;
      case 4 : monthbotjs= "พฤภษาคม"; break;
      case 5 : monthbotjs= "มิถุนายน"; break;
      case 6 : monthbotjs= "กรกฏาคม"; break;
      case 7 : monthbotjs= "สิงหาคม"; break;
      case 8 : monthbotjs= "กันยายน"; break;
      case 9 : monthbotjs= "ตุลาคม"; break;
      case 10 : monthbotjs= "พฤศจิกายน"; break;
      case 11 : monthbotjs= "ธันวาคม"; break;
      default : monthbotjs= "ไม่พบเดือน"; break;
  }
  $(".month_bot").html('เดือน '+monthbotjs+' '+yearbotjs);
  $(".daymonth_bot").html(daybotjs+' '+monthbotjs+' '+yearbotjs);
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
