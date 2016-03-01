@extends('app')

@section('title', 'โชว์ข้อมูลแต่ละเดือน')

@section('content')
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
												//ค่าน้อยกว่า
												var dlen = 1;
												for(dlen;dlen<data[0].date;dlen++){
													table += "<tr>"
														+"<td>"+dlen+"</td>"
														+"<td>"+0+"</td>"
														+"</tr>";
												}
												//ค่าเท่ากัน
											$.each(data,function(i,datas){
												if(datas.kwh<=0){
													var kwhval = 0;
													data.kwh=0;
													console.log("วันที่ "+datas.date+" ค่าแสดงผิดพลาด!!");
												}else{
													var kwhval = datas.kwh;
												}
												total += kwhval;
												if(datas.kwh!=0){
													table += "<tr>"
														+"<td>"+datas.date+"</td>"
														+"<td>"+kwhval.toLocaleString()+"</td>"
														+"</tr>";
														len = datas.date;
												}else{
													table += "<tr>"
														+"<td>"+datas.date+"</td>"
														+"<td>"+0+"</td>"
														+"</tr>";
												}
												})
												//ค่ามากกว่า
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
														+"<td>"+total.toLocaleString()+" kWh </td>"
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


</script>
<script src="{{ URL::asset('assets/js/highcharts.js') }}"></script>
<script src="{{ URL::asset('assets/js/modules/exporting.js') }}"></script>
@stop
