@extends('app')

@section('title', 'โชว์ข้อมูลแต่ละเดือน')

@section('content')
<!--<style>
	table{
		width:20%;
	}

	tbody{
	  overflow-y: scroll;
	  height: 820px;
	  width: 90%;
	  position: absolute;
	}
	td{
		width: 80%;
	}

</style>-->
<!--Control panel-->
<!--<div class = "menu-trigger"></div>-->
	<div class = "row">

			<div class = "form-group">
				<label class = "control-label col-sm-1">Select Mater</label>
				<div class = "col-sm-2">
					<select	class = "form-control" name = "tool" id = "tool" required>
						<option value = "">กรุณาเลือกอุปกรณ์</option>
							<?php foreach($meter as $meter) {?>
								<option value = "<?php echo $meter->groupName;?>"><?php echo $meter->groupName;?></option>
							<?php } ?>
					</select>
				</div>
				<label class = "control-label col-sm-1">Month</label>
				<div class = "col-sm-2">
					<select class = "form-control" name = "month" id = "month" required>
						<option value = "">กรุณาเลือกเดือน</option>
						<option value = "1">มกราคม</option>
						<option value = "2">กุมภาพันธ์</option>
						<option value = "3">มีนาคม</option>
						<option value = "4">เมษายน</option>
						<option value = "5">พฤภษาคม</option>
						<option value = "6">มิถุนายน</option>
						<option value = "7">กรกฏาคม</option>
						<option value = "8">สิงหาคม</option>
						<option value = "9">กันยายน</option>
						<option value = "10">ตุลาคม</option>
						<option value = "11">พฤศจิกายน</option>
						<option value = "12">ธันวาคม</option>
					</select>
				</div>
				<div>
					<label class = "control-label col-sm-1">Years</label>
						<div class = "col-sm-2">
							<select class = "form-control" name = "year" required id = "year">
								<option value = "">กรุณาเลือกปี</option>
									<?php foreach($year as $a) { ?>
										<option value = "<?php echo $a->year;?>"><?php echo $a->year;?></option>
									<?php }?>
							</select>
						</div>
				</div>
				<div class = "control-label col-sm-1">
					<button type = "submit" class = "btn btn-success" id = "export" >ตกลง</button>
				</div>
					<a id="link"  style="display:none;"></a>
    				<input type="button" class="btn btn-primary" onclick="tableToExcel()" value="ส่งออกรายงาน">

			</div>

	</div><br>
	<div class = "row">
		<div class = "col-sm-2" id = "table">

		</div>
		<div class = "col-sm-10"  >
				<div id="container" style="min-width: 100%; height: 100%; margin: 0px auto  ;" >

				</div>
				<H2 id = "total_chart" style = "color:black;text-align:center"></h2>
		</div>
	</div>

<script>
		$("#export").click(function(){
			var tool = $("#tool").val();
			var month = $("#month").val();
			var year = $("#year").val();
			//var url = $(this).attr("data-link");
			var len;
			var month_check = new Date(year,month,0).getDate();
			var i,total = 0;
			if(tool != "" && month != "" && year != ""){
					$.ajax({
						url:"submit",
						type:"POST",
						beforeSend:function(xhr){
							var token = $('meta[name="csrf_token"]').attr('content');
								if (token) {
								return xhr.setRequestHeader('X-CSRF-TOKEN', token);
							}
						},
						data:{tool_php:tool,month_php:month,year_php:year},
						dataType:"JSON",
						success:function(data){
							if(data != ""){

									chart(data);

									len = data.length;
									//โชว์ตารางงงง
									var table = "<table class = 'table' id = 'table_data'>"
												+"<thead style = 'width:100%'>"
													+"<tr>"
														+"<th>วันที่</th>"
														+"<th>ค่าพลังงานไฟฟ้า (kWh)</th>"
													+"</th>"
												+"</thead>"
												+"<tbody>";
											$.each(data,function(i,datas){
												total += datas.kwh;
												table += "<tr>"
													+"<td>"+datas.date+"</td>"
													+"<td>"+datas.kwh.toLocaleString()+"</td>"
													+"</tr>";
													len = datas.date;
												})
												if(len < month_check){
													len += 1;
													for(len;len<=month_check;len++){
														table += "<tr>"
															+"<td>"+len+"</td>"
															+"<td>"+0+"</td>"
															+"</tr>";
													}
												}
											table += "<tr>"
														+"<td>total</td>"
														+"<td>"+total.toFixed(2)+"</td>"
													+"</tr>"
												+"</tbody>"
												+"</table>";

									$("#table").html(table);
									$("#total_chart").html('ค่าพลังงานการใช้ไฟฟ้ารวม '+total.toLocaleString()+' kWh');
									//ปิดการโชว์
							}
							else{
								alert("ไม่มีข้อมูล");
							}
						}
					});
			}
			else{
				alert('กรุณาเลือกข้อมูลให้ครบ');
			}

		});
/*	function chart(data){

		var i = 0;
		var len = data.length;
		var month = $("#month").val();
		var year = $("#year").val();
		var month_check = new Date(year,month,0).getDate();
		var myseries = [];
				$.each(data,function(i,datas){
					if(i<=len){
						myseries.push([datas.date,datas.consumption]);
					}
				});
				if(len < month_check){
					len = len + 1;
					for(len;len<=month_check;len++){
						myseries.push([len,0]);
					}
				}


			if(month == 1) month = 'มกราคม';
			else if(month == 2) month = 'กุมภาพันธ์';
			else if(month == 3) month = 'มีนาคม';
			else if(month == 4) month = 'เมษายน';
			else if(month == 5) month = 'พฤภษาคม';
			else if(month == 6) month = 'มิถุนายน';
			else if(month == 7) month = 'กรกฏาคม';
			else if(month == 8) month = 'สิงหาคม';
			else if(month == 9) month = 'กันยายน';
			else if(month == 10) month = 'ตุลาคม';
			else if(month == 11) month = 'พฤศจิกายน';
			else month = 'ธันวาคม';

			var year = $("#year").val();

							$('#container').highcharts({
								chart: {
									type: 'column'
								},
								title: {
									text: '<strong>ตารางแสดงข้อมูลการใช้พลังงานไฟฟ็า</strong><br><strong>เดือน '+month+' ปี '+year+'</strong>'
								},
								subtitle: {

									text: ''
								},
								xAxis: {
									type: 'category',
									labels: {
										rotation: 0,
										style: {
											fontSize: '15px',
											fontFamily: 'Verdana, sans-serif'
										}
									}
								},
								yAxis: {
									min: 0,
									title: {
										text: 'ค่าพลังงานไฟฟ้า (kWh)'
									}
								},
								legend: {
									enabled: false
								},
								tooltip: {
									pointFormat: 'ค่าไฟฟ้า: <b>{point.y:.1f} kWh</b>'
								},
									series: [{
										name: 'Population',
										data:
											myseries
										,


										dataLabels: {
											enabled: true,
											rotation: -360,
											color: '#051841',
											align: 'center',
											format: '{point.y:.1f}', // one decimal
											y: -5, // 10 pixels down from the top
											style: {
												fontSize: '10px'
												//fontFamily: 'Verdana, sans-serif'
											}
										}
									}]//series
								});
		}	*/

						//กราฟ
					//กราฟ




</script>
<script src="{{ URL::asset('assets/js/highcharts.js') }}"></script>
<script src="{{ URL::asset('assets/js/modules/exporting.js') }}"></script>
@stop
