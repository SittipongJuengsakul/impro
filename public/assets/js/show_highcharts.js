function chart(data){
		var i = 0;
		var len = data.length;
		var month = $("#month").val();
		var year = $("#year").val();
		var month_check = new Date(year,month,0).getDate();
		var myseries = [];
				$.each(data,function(i,datas){
					var dlen = 1;
					for(dlen;dlen<data[0].date;dlen++){
						myseries.push([dlen,0]);
					}
					if(i<=len){
						if(datas.kwh<=0){
							var kwhval = 0;
							data.kwh=0;
						}else{
							var kwhval = datas.kwh;
						}
						myseries.push([datas.date,kwhval]);
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


										/*dataLabels: {
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
										}*/
									}]//series
								});
		}
