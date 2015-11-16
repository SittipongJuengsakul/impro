@extends('app')

@section('title', 'เป้าหมายค่าไฟฟ้า')

@section('content')
<!-- Content panel -->
<!--<div class="menu-trigger"></div>-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<?php
					        	switch ( $month ) {
								    case 1:
								        $month_name = 'มกราคม';
								        break;
								    case 2:
								        $month_name = 'กุมภาพันธ์';
								        break;
								    case 3:
								        $month_name = 'มีนาคม';
								        break;
								    case 4:
								        $month_name = 'เมษายน';
								        break;
								    case 5:
								        $month_name = 'พฤภษาคม';
								        break;
								    case 6:
								        $month_name = 'มิถุนายน';
								        break;
								    case 7:
								        $month_name = 'กรกฏาคม';
								        break;
								    case 8:
								        $month_name = 'สิงหาคม';
								        break;
								    case 9:
								        $month_name = 'กันยายน';
								        break;
								    case 10:
								        $month_name = 'ตุลาคม';
								        break;
								    case 11:
								        $month_name = 'พฤศจิกายน';
								        break;
								    case 12:
								        $month_name = 'ธันวาคม';
								        break;
								}
							?>
				<div class="panel-heading">กำหนดเป้าหมายค่าไฟฟ้าแต่ละอุปกรณ์ประจำเดือน {{ $month_name }} ปี {{ $year }}</div>
				<div class="panel-body">
					{!! Form::open(array('action' => 'HomeController@save_toolestimate','method' =>'post','data-toggle' =>'validator')) !!}
					<table class="table table-hover">
					    <thead>
					      <tr>
					        <th  width="20%">ชื่ออุปกรณ์</th>
					        <th  width="50%">เป้าหมาย (kWh)</th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php $i=1 ;?>
					      @foreach($results as $key)
					      <tr>
					        <td>{{ $key->groupName }}</td>
					        <td>
					        	<div class="input-group col-md-5">
							  		<input type="number" class="form-control" aria-describedby="basic-addon2" value="{{ $key->estimate }}" name="est_<?php echo $i;?>"  required>
							 		<span class="input-group-addon">kWh</span>
								</div>
							</td>
						  </tr>
						  <input type="hidden"  value="{{ $key->mdd_id }}" name="mddid_<?php echo $i;?>">
						  <?php $i++ ;?>
						  
						  @endforeach
					    </tbody>
					</table>
					<input type="hidden"  value="<?php echo $i-1 ;?>" name="num">
					<input type="hidden"  value="{{ $year }}" name="year">
					<input type="hidden"  value="{{ $month }}" name="month">
					<p class="text-right"><button type="submit" class="btn btn-primary">บันทึก</button></p>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@stop