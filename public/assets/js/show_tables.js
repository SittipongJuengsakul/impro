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
									var table = "<table class = 'table'>"
												+"<thead style = 'width:100%'>"
													+"<tr>"
														+"<th>วันที่</th>"
														+"<th>ค่าพลังงานไฟฟ้า (kWh)</th>"
													+"</th>"
												+"</thead>"
												+"<tbody>";
											$.each(data,function(i,datas){
												total += datas.consumption;
												table += "<tr>"
													+"<td>"+datas.date+"</td>"
													+"<td>"+datas.consumption+"</td>"
													+"</tr>";	
													
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
												excel(table);
												//excel(data);
									$("#table").html(table);
									$("#total_chart").html('ค่าพลังงานการใช้ไฟฟ้ารวม '+total.toFixed(2)+' kWh');
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