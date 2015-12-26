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
function BuildingAll(b1,b2,b3456,b7,other){
    // Build the chart
                $('#container-TotalAll').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สัดส่วนการใช้พลังงานทั้งหมด'
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
                        data: [{
                            name: 'Building 1',
                            y: b1
                        },{
                            name: 'Building 2',
                            y: b2
                        },{
                            name: 'Building 3 4 5 6',
                            y: b3456
                        },{
                            name: 'Building 7',
                            y: b7
                        },{
                            name: 'Other',
                            y: other
                        },
                        ]
                    }]
                });
}
function show_Building1(elect,aircon,other){
    // Build the chart
                $('#container-building-1').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สัดส่วนการใช้พลังงานอาคาร 1'
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
                        data: [{
                            name: 'ไฟฟ้า แสงสว่าง ปลั๊ก',
                            y: elect
                        },{
                            name: 'เครื่องปรับอากาศ',
                            y: aircon
                        },{
                            name: 'อื่น',
                            y: other
                        }
                        ]
                    }]
                });
}
function show_Building2(elect,aircon,other){
    // Build the chart
                $('#container-building-2').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สัดส่วนการใช้พลังงานอาคาร 2'
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
                        data: [{
                            name: 'ไฟฟ้า แสงสว่าง ปลั๊ก',
                            y: elect
                        },{
                            name: 'เครื่องปรับอากาศ',
                            y: aircon
                        },{
                            name: 'อื่น',
                            y: other
                        }
                        ]
                    }]
                });
}
function show_Building3(elect,aircon,other){
    // Build the chart
                $('#container-building-3').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สัดส่วนการใช้พลังงานอาคาร 3 4 5 6'
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
                        data: [{
                            name: 'ไฟฟ้า แสงสว่าง ปลั๊ก',
                            y: elect
                        },{
                            name: 'เครื่องปรับอากาศ',
                            y: aircon
                        },{
                            name: 'อื่น',
                            y: other
                        }
                        ]
                    }]
                });
}
function show_Building7(elect,aircon,other){
    // Build the chart
                $('#container-building-7').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สัดส่วนการใช้พลังงานอาคาร 7'
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
                        data: [{
                            name: 'ไฟฟ้า แสงสว่าง ปลั๊ก',
                            y: elect
                        },{
                            name: 'เครื่องปรับอากาศ',
                            y: aircon
                        },{
                            name: 'อื่น',
                            y: other
                        }
                        ]
                    }]
                });
}
function show_BuildingOther(elect,aircon,other){
    // Build the chart
                $('#container-building-other').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สัดส่วนการใช้พลังงานอาคาร อื่นๆ'
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
                        data: [{
                            name: 'ไฟฟ้า แสงสว่าง ปลั๊ก',
                            y: elect
                        },{
                            name: 'เครื่องปรับอากาศ',
                            y: aircon
                        },{
                            name: 'อื่น',
                            y: other
                        }
                        ]
                    }]
                });
}
