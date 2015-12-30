//slider
var win = $(window);
            $(document).ready(function () {
                var slidenumber=0;
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
function refreshAt(hours, minutes, seconds) {
                var now = new Date();
                var then = new Date();

                if(now.getHours() > hours ||
                   (now.getHours() == hours && now.getMinutes() > minutes) ||
                    now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
                    then.setDate(now.getDate() + 1);
                }
                then.setHours(hours);
                then.setMinutes(minutes);
                then.setSeconds(seconds);

                var timeout = (then.getTime() - now.getTime());
                setTimeout(function() { window.location.reload(true); }, timeout);
                console.log('refresh!');
}
function BuildingAll(b1,b2,b3456,b7,b13,b89,other){
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
                            name: 'Building 1/3',
                            y: b13
                        },{
                            name: 'Building 8 9',
                            y: b89
                        },{
                            name: 'Other',
                            y: other
                        },
                        ]
                    }]
                });
}
function show_Building(id_contain,elect,aircon,other,num_building){
    // Build the chart
                var array_building = [];
                if(elect>0){
                  array_building.push({ name: "ไฟฟ้า แสงสว่าง ปลั๊ก",y:elect});
                }else{
                  console.log('tbl_pb ของอาคาร '+num_building+' ไม่มี');
                }
                if(aircon>0){
                  array_building.push({ name: "เครื่องปรับอากาศ",y:aircon});
                }else{
                  console.log('tbl_aircon ของอาคาร '+num_building+' ไม่มี');
                }
                if(other>0){
                  array_building.push({ name: "อื่น",y:other});
                }else{
                  console.log('ไม่มีข้อมูลไดๆ ของอาคาร '+num_building);
                }

                $(id_contain).highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'สัดส่วนการใช้พลังงานอาคาร '+num_building
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
                        data: array_building
                    }]
                });
}

function buildingall_show(){
  $('#buildinga_est').html('<div class="loader_content"></div>');
  $('#buildinga_current').html('<div class="loader_content"></div>');
  $('#buildinga_money').html('<div class="loader_content"></div>');
  $('#buildinga_esttomonth').html('<div class="loader_content"></div>');
  $.ajax({
    url: 'http://localhost/impro-bot/public/user/slideshow/building_all_data'
  }).then(function(data) {
      $('#buildinga_est').html(data.est_all_use+' kWh');
      $('#buildinga_current').html(data.all_use+' kWh');
      $('#buildinga_money').html(data.money_all_use +' บาท');
      $('#buildinga_esttomonth').html(data.endmonth_all_use+' kWh');
      BuildingAll(data.b1,data.b2,data.b3,data.b7,data.b13,data.b89,data.bother);
  });
}
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
      show_Building('#container-building-3',data.elect,data.air,other_data,'3 4 5 6');
  });
}
function building7_show() {
  $('#building7_est').html('<div class="loader_content"></div>');
  $('#building7_current').html('<div class="loader_content"></div>');
  $('#building7_money').html('<div class="loader_content"></div>');
  $('#building7_esttomonth').html('<div class="loader_content"></div>');
  $.ajax({
    url: 'http://localhost/impro-bot/public/user/slideshow/building_data/7'
  }).then(function(data) {
      $('#building7_est').html(data.est_building+' kWh');
      $('#building7_current').html(data.use_building+' kWh');
      $('#building7_money').html(data.money_building +' บาท');
      $('#building7_esttomonth').html(data.endmonth_building+' kWh');
      var other_data = data.all_use-data.elect-data.air;
      show_Building('#container-building-7',data.elect,data.air,other_data,'7');
  });
}
function building13_show() {
  $('#building13_est').html('<div class="loader_content"></div>');
  $('#building13_current').html('<div class="loader_content"></div>');
  $('#building13_money').html('<div class="loader_content"></div>');
  $('#building13_esttomonth').html('<div class="loader_content"></div>');
  $.ajax({
    url: 'http://localhost/impro-bot/public/user/slideshow/building_data/13'
  }).then(function(data) {
      $('#building13_est').html(data.est_building+' kWh');
      $('#building13_current').html(data.use_building+' kWh');
      $('#building13_money').html(data.money_building +' บาท');
      $('#building13_esttomonth').html(data.endmonth_building+' kWh');
      var other_data = data.all_use-data.elect-data.air;
      show_Building('#container-building-13',data.elect,data.air,other_data,'1/3');
  });
}
function building89_show() {
  $('#building89_est').html('<div class="loader_content"></div>');
  $('#building89_current').html('<div class="loader_content"></div>');
  $('#building89_money').html('<div class="loader_content"></div>');
  $('#building89_esttomonth').html('<div class="loader_content"></div>');
  $.ajax({
    url: 'http://localhost/impro-bot/public/user/slideshow/building_data/89'
  }).then(function(data) {
      $('#building89_est').html(data.est_building+' kWh');
      $('#building89_current').html(data.use_building+' kWh');
      $('#building89_money').html(data.money_building +' บาท');
      $('#building89_esttomonth').html(data.endmonth_building+' kWh');
      var other_data = data.all_use-data.elect-data.air;
      show_Building('#container-building-89',data.elect,data.air,other_data,'8 9');
  });
}
function chillerplant_show_dayall(b1,b2,b5,b7,dc1){
      if(b1==0){
        console.log('ไม่มี tbl_plant_b1');
      }
      if(b2==0){
        console.log('ไม่มี tbl_plant_b2');
      }
      if(b5==0){
        console.log('ไม่มี tbl_plant_b5');
      }
      if(b7==0){
        console.log('ไม่มี tbl_plant_b7');
      }
      if(dc1==0){
        console.log('ไม่มี tbl_plant_dc1');
      }
      $('#container_chiller_plant_all').highcharts({
          title: {
              text: '',
              x: -20 //center
          },
          credits:{
              enabled: false
          },
          exporting:{
              enabled: false
          },
          subtitle: {
              text: '',
              x: -20
          },
          xAxis: {
              text: 'เวลา (นาฬิกา)',
              categories: ['1', '2', '3', '4', '5', '6','7', '8', '9', '10', '11', '12','13','14','15','16','17','18','19','20','21','22','23','24']
          },
          yAxis: {
              title: {
                  text: 'พลังงานที่ใช้ (kWh)'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          tooltip: {
              valueSuffix: ' kWh'
          },
          legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
          },
          series: [{
              name: 'tbl_Plant_B1',
              data: b1
          }, {
              name: 'tbl_Plant_B2',
              data: b2
          }, {
              name: 'tbl_Plant_B5',
              data: b5
          }, {
              name: 'tbl_Plant_B7',
              data: b7
          }, {
              name: 'tbl_Plant_DC1',
              data: dc1
          }]
      });
}
function chiller_show(){
  $.ajax({
    url: 'http://localhost/impro-bot/public/user/slideshow/chillerplant_show_all'
  }).then(function(data) {
      chillerplant_show_dayall(data.b1,data.b2,data.b5,data.b7,data.dc1);
  });
}
function showkwnmoney(){
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
}
function energy_show(groupnumber){
  $.ajax({
    url: 'http://localhost/impro-bot/public/user/slideshow/energy_group_all/tbl_energy_g'+groupnumber
  }).then(function(data) {
    energy_group(data.energy,data.estenergy,groupnumber);
  });
}
function energy_group(energy,estenergy,groupnumber){
      var colorenergy = '';
      colorenergy = 'rgba(0,79,202,0.67)';
      $('#container_energy_g1').highcharts({
          chart: {
              type: 'column'
          },
          title: {
              text: 'กลุ่มที่ 1'
          },
          xAxis: {
              categories: [
                  'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤภษาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'
              ]
          },
          yAxis: [{
              min: 0,
              title: {
                  text: ''
              }
          }, {
              title: {
                  text: 'การใช้พลังงาน (kWh)'
              }
          }],
          legend: {
              shadow: false
          },
          credits:{
              enabled: false
          },
          exporting:{
              enabled: false
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
          series: [ {
              name: 'เป้าหมายการใช้พลังงาน',
              color: 'rgba(149,183,236,0.67)',
              data: estenergy,
              tooltip: {
                  valuePrefix: '',
                  valueSuffix: ' kWh'
              },
              pointPadding: 0.3,
              pointPlacement: 0.0,
              yAxis: 1
          }, {
              name: 'พลังงานที่ใช้งานจริง',
              color: colorenergy,
              data: energy,
              tooltip: {
                  valuePrefix: '',
                  valueSuffix: ' kWh'
              },
              pointPadding: 0.4,
              pointPlacement: 0.0,
              yAxis: 1
          }]
      });
}
