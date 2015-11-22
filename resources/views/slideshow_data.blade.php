@extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')

@section('content')
<div id="container" style="margin: 0;">
    <div id="slider">
        <div style="background-color: white;">
            <div class="row">
                  <div class="col-md-3" style="margin-top: 50px;padding-left:20px"><h1>พลังงานไฟฟ้าที่ใช้</h1>
                  <h2 style="margin-top: 0px;">เดือน <?
                    $score = 4;
                     
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
                         
                    }
                     
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
                                <td width="50%">{{ $totalEst }} kWh</td>
                            </tr>
                            <tr>
                                <td>ปัจจุบันใช้</td>
                                <td>{{ $kwh = number_format($All_Used, 2) }} kWh</td>
                            </tr>
                            <tr>
                                <td>เป็นเงิน</td>
                                <?php $money = $All_Used*$ftEst ?>
                                <td>{{ number_format($money, 2) }} บาท</td>
                            </tr>
                            <tr>
                                <td>ประมาณการเมื่อถึงสิ้นเดือน</td>
                                <td>{{ number_format($EstMonthtoUse, 2) }} kWh</td>
                            </tr>

                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-9">
                    <div id="container-TotalAll" style="margin: 0 auto;min-height: 500px"></div>
                  </div>
                </div>
        </div>
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

//slider
var win = $(window);
            $(document).ready(function () {
                var container = $("#container");
                var sudoSlider = $("#slider").sudoSlider({
                    effect: "fade",
                    pause: 3000,
                    auto:true,
                    responsive: true,
                    prevNext: false,
                    continuous: true,
                    autoHeight: false,
                    touch: true,
                    customLink: ".sudoSliderLink",
                    updateBefore: true
                });

                win.on("resize blur focus", function () {
                    var height = win.height();
                    sudoSlider.height(height);
                    container.height(height);
                }).resize();


                sudoSlider.find(".slide").each(function () {
                    var slide = $(this);
                    var imageSrc = slide.attr("data-background");
                    if (!imageSrc) {
                        return;
                    }
                    $("<img />").attr("src", imageSrc).properload(function () {
                        var backgroundImage = $(this);
                        var imageHeight = backgroundImage[0].naturalHeight;
                        var imageWidth = backgroundImage[0].naturalWidth;

                        if (!imageHeight) {
                            var img = new Image();
                            img.src = imageSrc;
                            imageWidth = img.width;
                            imageHeight = img.height;

                        }

                        var aspectRatio = imageWidth / imageHeight;

                        backgroundImage.appendTo(slide);

                        slide.css({
                            zIndex: 0
                        });

                        backgroundImage.css({
                            position: "absolute",
                            zIndex: -1,
                            top: 0,
                            left: 0
                        });

                        win.on("resize blur focus", function () {
                            var sliderWidth = sudoSlider.width();
                            var sliderHeight = sudoSlider.height();
                            if ((sliderWidth / sliderHeight) < aspectRatio ) {
                                var leftMargin = ((sliderWidth - (sliderHeight * aspectRatio)) / 2) + "px";
                                backgroundImage.css({
                                    top: 0,
                                    left: leftMargin,
                                    width: sliderHeight * aspectRatio,
                                    height: sliderHeight
                                });
                            } else {
                                backgroundImage.css({
                                    left: 0,
                                    top: ((sliderHeight - (sliderWidth / aspectRatio)) / 2) + "px",
                                    height: sliderWidth / aspectRatio,
                                    width: sliderWidth
                                });
                            }
                        }).resize();

                    }, true);
                });
            });
    if(window.top==window) {
        window.setTimeout('location.reload()', 900000); //Reloads after 15 min
    }
    else {
        
    }
    </script>
@stop

