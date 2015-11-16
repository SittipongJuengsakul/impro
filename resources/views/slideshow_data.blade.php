@extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')

@section('content')

    <script type="text/javascript">
        $(function () {
            $(document).ready(function () {

                // Build the chart
                $('#container-TotalAll').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'ตารางแสดงข้อมูลรวมการใช้พลังงานทั้งหมด'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },

                    credits:{
                        enabled: false
                    },
                    exporting:{
                        enabled: false
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        floating: true,
                        y: 160,
                        x: -50
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        },
                        series: {
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                return Math.round(this.percentage*100)/100 + ' %';
                            },
                            distance: -30,
                            color:'white'
                        }
                    }
                    },
                    series: [{
                        name: "ใช้พลังงาน",
                        colorByPoint: true,
                        data: [
                        @foreach ($tbl_Array as $tbl)
                        {
                            name: '{!! $tbl[1] !!}',
                            y: {!! $tbl[0] !!}
                        },
                        @endforeach]
                    }]
                });
            });
        });
        </script>
        <script type="text/javascript">
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
        <script type="text/javascript">
$(function () {
    $('#container-show1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'สัดส่วนการใช้พลังงานไฟฟ้าตามกลุ่ม 1 - 6'
        },
        xAxis: {
            categories: [
            <?php $b=0; ?>
            @foreach ($tbl_Array as $tbl)
                <?php if($b<6){ ?>
                '{{ $tbl[1] }}',
                <?php $b++;}?>
            @endforeach
            ]
        },
            credits:{
                enabled: false
            },
            exporting:{
                enabled: false
            },
        yAxis: [{
            min: 0,
            title: {
                text: 'จำนวนพลังงานไฟฟ้า (kWh)'
            }
        }, {
            title: {
                text: 'จำนวนพลังงานไฟฟ้า (kWh)'
            },
            opposite: true
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
        series: [{
            name: 'เป้าหมายเดือนที่แล้ว',
            color: 'rgba(165,170,217,1)',
            data: [
            <?php $zz=0; ?>
            @foreach ($BeforeMonthEst_tbl as $BEtbl)
                <?php if($zz<6){ ?>
                {{ $BEtbl[0] }},
                <?php $zz++;}?>
            @endforeach
            ],
            pointPadding: 0.3,
            pointPlacement: -0.2
        }, {
            name: 'เดือนที่แล้วใช้พลังงานไฟฟ้าทั้งสิ้น',
            color: 'rgba(126,86,134,.9)',
            data: [
            <?php $z=0; ?>
            @foreach ($BeforeMonthTbl_Array as $Btbl)
                <?php if($z<6){ ?>
                {{ $Btbl[0] }},
                <?php $z++;}?>
            @endforeach
            ],
            pointPadding: 0.4,
            pointPlacement: -0.2
        }, {
            name: 'เป้าหมายเดือนนี้',
            color: 'rgba(248,161,63,1)',
            data: [
            <?php $b=0; ?>
            @foreach ($tbl_EstArray as $Etbl)
                <?php if($b<6){ ?>
                {{ $Etbl[0] }},
                <?php $b++;}?>
            @endforeach
            ],
            tooltip: {
                valuePrefix: '',
                valueSuffix: ''
            },
            pointPadding: 0.3,
            pointPlacement: 0.2,
            yAxis: 1
        }, {
            name: 'เดือนนี้ใช้พลังงานไฟฟ้าทั้งสิ้น',
            color: 'rgba(186,60,61,.9)',
            data: [
            <?php $b=0; ?>
            @foreach ($tbl_Array as $tbl)
                <?php if($b<6){ ?>
                {{ $tbl[0] }},
                <?php $b++;}?>
            @endforeach
            ],
            tooltip: {
                valuePrefix: '',
                valueSuffix: ''
            },
            pointPadding: 0.4,
            pointPlacement: 0.2,
            yAxis: 1
        }]
    });
});
        </script>

        

            <script type="text/javascript">
$(function () {
    $('#container-show2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'สัดส่วนการใช้พลังงานไฟฟ้าตามกลุ่ม 7 - 12'
        },
        xAxis: {
            categories: [
            <?php $b=0; ?>
            @foreach ($tbl_Array as $tbl)
                <?php if($b<6){?>
                <?php } elseif($b<12){ ?>
                '{{ $tbl[1]}}',
                <?php } $b++;?>
            @endforeach
            ]
        },
            credits:{
                enabled: false
            },
            exporting:{
                enabled: false
            },
        yAxis: [{
            min: 0,
            title: {
                text: 'จำนวนพลังงานไฟฟ้า (kWh)'
            }
        }, {
            title: {
                text: 'จำนวนพลังงานไฟฟ้า (kWh)'
            },
            opposite: true
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
        series: [{
            name: 'เป้าหมายเดือนที่แล้ว',
            color: 'rgba(165,170,217,1)',
            data: [
            <?php $zz=0; ?>
            @foreach ($BeforeMonthEst_tbl as $BEtbl)
                <?php if($zz<6){?>
                <?php } elseif($zz<12){ ?>
                {{ $BEtbl[0]}},
                <?php } $zz++;?>
            @endforeach
            ],
            pointPadding: 0.3,
            pointPlacement: -0.2
        }, {
            name: 'เดือนที่แล้วใช้พลังงานไฟฟ้าทั้งสิ้น',
            color: 'rgba(126,86,134,.9)',
            data: [
            <?php $z=0; ?>
            @foreach ($BeforeMonthTbl_Array as $Btbl)
                <?php if($z<6){?>
                <?php } elseif($z<12){ ?>
                {{ $Btbl[0]}},
                <?php } $z++;?>
            @endforeach
            ],
            pointPadding: 0.4,
            pointPlacement: -0.2
        }, {
            name: 'เป้าหมายเดือนนี้',
            color: 'rgba(248,161,63,1)',
            data: [
            <?php $b=0; ?>
            @foreach ($tbl_EstArray as $Etbl)
                <?php if($b<6){?>
                <?php } elseif($b<12){ ?>
                {{ $Etbl[0]}},
                <?php } $b++;?>
            @endforeach
            ],
            tooltip: {
                valuePrefix: '',
                valueSuffix: ''
            },
            pointPadding: 0.3,
            pointPlacement: 0.2,
            yAxis: 1
        }, {
            name: 'เดือนนี้ใช้พลังงานไฟฟ้าทั้งสิ้น',
            color: 'rgba(186,60,61,.9)',
            data: [<?php $c=0; ?>
            @foreach ($tbl_Array as $tbl)
                <?php if($c<6){?>
                <?php } elseif($c<12){ ?>
                {{ $tbl[0]}},
                <?php } $c++;?>
            @endforeach
            ],
            tooltip: {
                valuePrefix: '',
                valueSuffix: ''
            },
            pointPadding: 0.4,
            pointPlacement: 0.2,
            yAxis: 1
        }]
    });
});
        </script>

<div id="container" style="margin: 0;">
    <div id="slider">
        <div style="background-color: white;">
            <div class="row">
                  <div class="col-md-3" style="margin-top: 50px;padding-left:30px"><h1>พลังงานไฟฟ้าที่ใช้</h1>
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
                                <td>เป้าหมาย</td>
                                <td>{{ $totalEst }} kWh</td>
                            </tr>
                            <tr>
                                <td>ปัจจุบันใช้</td>
                                <td>{!! $kwh = number_format($SumAll, 2) !!} kWh</td>
                            </tr>
                            <tr>
                                <td>เป็นเงิน</td>
                                <?php $money = $SumAll*$ftEst ?>
                                <td>{!! number_format($money, 2) !!} บาท</td>
                            </tr>

                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-9">
                    <div id="container-TotalAll" style="margin: 0 auto;min-height: 500px"></div>
                  </div>
                </div>
        </div>
        <div style="background-color: white; width:100%;heigh:800px;display:block;">
             <div class="row">
                  <div class="col-md-12">
                    <div id="container-show1" style="margin: 0 auto;min-height: 500px"></div>
                    <table class="table table-bordered" style="margin-top: 10px;">
                        <thead>
                            <tr>
                                <td class="tbhead">แสดง</td>
                                <?php $b=0; ?>
                                @foreach ($tbl_Array as $tbl)
                                    <?php if($b<6){ ?>
                                    <td class="tbhead">{{ $tbl[1]}}</td>
                                    <?php $b++;}?>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td class="tbbody">เป้าหมาย (kWh)</td>
                                 <?php $b=0; ?>
                                @foreach ($tbl_EstArray as $Etbl)
                                    <?php if($b<6){ ?>
                                    <td class="tb-body">{{ $Etbl[0] }}</td>
                                    <?php $b++;}?>
                                @endforeach
                                </tr>
                        <tr>
                            <td class="tbbody">ปัจจุบัน (kWh)</td>
                                <?php $b=0; ?>
                                @foreach ($tbl_Array as $tbl)
                                    <?php if($b<6){ ?>
                                    <td class="tb-body">{{ $tbl[0] }}</td>
                                    <?php $b++;}?>
                                @endforeach
                            
                        </tr>
                        </tbody>
                    </table>
                  </div>
            </div>
        </div>
        <div style="background-color: white; width:100%;heigh:800px;display:block;">
             <div class="row">
                  <div class="col-md-12">
                    <div id="container-show2" style="margin: 0 auto;min-height: 500px"></div>
                    <table class="table table-bordered" style="margin-top: 10px;">
                        <thead>
                            <tr>
                                <td class="tbhead">แสดง</td>
                                <?php $c=0; ?>
                                @foreach ($tbl_Array as $tbl)
                                    <?php if($c<6){?>
                                    <?php } elseif($c<12){ ?>
                                    <td class="tbhead">{{ $tbl[1]}}</td>
                                    <?php } $c++;?>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td class="tbbody">เป้าหมาย (kWh)</td>
                            <?php $b=0; ?>
                            @foreach ($tbl_EstArray as $Etbl)
                                <?php if($b<6){?>
                                <?php } elseif($b<12){ ?>
                                <td class="tb-body">{{ $Etbl[0]}}</td>
                                <?php } $b++;?>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="tbbody">ปัจจุบัน (kWh)</td>
                            <?php $b=0; ?>
                            @foreach ($tbl_Array as $tbl)
                                <?php if($b<6){?>
                                <?php } elseif($b<12){ ?>
                                <td class="tb-body">{{ $tbl[0]}}</td>
                                <?php } $b++;?>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                  </div>
            </div>
        </div>


    </div>
</div>


<script src="{{ URL::asset('assets/js/highcharts.js') }}"></script>
<script src="{{ URL::asset('assets/js/modules/exporting.js') }}"></script>
@stop

