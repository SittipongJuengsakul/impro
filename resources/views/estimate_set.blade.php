@extends('app')

@section('title', 'เป้าหมายค่าไฟฟ้า')

@section('content')
<!-- Content panel -->
<!--<div class="menu-trigger"></div>-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">กำหนดเป้าหมายค่าไฟฟ้าประจำปี {{ $year }}</div>
				<div class="panel-body">
					{!! Form::open(array('action' => 'HomeController@save_estimate','method' =>'post','data-toggle' =>'validator')) !!}
					<table class="table table-hover">
					    <thead>
					      <tr>
					        <th  width="20%">เดือน</th>
					        <th  width="30%">อัตราค่าไฟฟ้า (บาท/kWh)</th>
					        <th  width="50%">เป้าหมาย (kWh)</th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php $i=1 ;?>
					      @foreach($results as $key)
					      <tr>
					        <td>	
							<?php
					        	switch ( $key->month ) {
								    case 1:
								        $month = 'มกราคม';
								        echo $month;
								        break;
								    case 2:
								        $month = 'กุมภาพันธ์';
								        echo $month;
								        break;
								    case 3:
								        $month = 'มีนาคม';
								        echo $month;
								        break;
								    case 4:
								        $month = 'เมษายน';
								        echo $month;
								        break;
								    case 5:
								        $month = 'พฤภษาคม';
								        echo $month;
								        break;
								    case 6:
								        $month = 'มิถุนายน';
								        echo $month;
								        break;
								    case 7:
								        $month = 'กรกฏาคม';
								        echo $month;
								        break;
								    case 8:
								        $month = 'สิงหาคม';
								        echo $month;
								        break;
								    case 9:
								        $month = 'กันยายน';
								        echo $month;
								        break;
								    case 10:
								        $month = 'ตุลาคม';
								        echo $month;
								        break;
								    case 11:
								        $month = 'พฤศจิกายน';
								        echo $month;
								        break;
								    case 12:
								        $month = 'ธันวาคม';
								        echo $month;
								        break;
								}
							?>
					        </td>
					        <td>

							  	<input type="number" class="form-control" size="5" value="{{ $key->Ft }}" name="ft_<?php echo $i;?>" step="0.01" required>
					        </td>
					        <td>
					        	<div class="input-group col-md-10">
							  		<input type="text" class="form-control" aria-describedby="basic-addon2" value="{{ number_format($key->estimate) }}" name="est_<?php echo $i;?>" onblur="this.value=formatMoney(this.value);" required>
							 		<span class="input-group-addon">kWh</span>
								</div>
							</td>
						  </tr>
						  <?php $i++ ;?>

						  @endforeach
					    </tbody>
					</table>
					<input type="hidden"  value="{{ $key->year }}" name="year">
					<p class="text-right"><button type="submit" class="btn btn-primary">บันทึก</button></p>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function formatMoney(inum){  // ฟังก์ชันสำหรับแปลงค่าตัวเลขให้อยู่ในรูปแบบ เงิน   
    var s_inum=new String(inum);   
    var num2=s_inum.split(".",s_inum);   
    var l_inum=num2[0].length;   
    var n_inum="";   
    for(i=0;i<l_inum;i++){   
        if(parseInt(l_inum-i)%3==0){   
            if(i==0){   
                n_inum+=s_inum.charAt(i);          
            }else{   
                n_inum+=","+s_inum.charAt(i);          
            }      
        }else{   
            n_inum+=s_inum.charAt(i);   
        }   
    }   
    if(num2[1]!=undefined){   
        n_inum+="."+num2[1];   
    }   
    return n_inum;   
}   

$("input").focus(function() {
  this.value = "";
});
</script>
@stop