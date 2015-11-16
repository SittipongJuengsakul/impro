@extends('app')

@section('title', 'เป้าหมายค่าไฟฟ้า')

@section('content')
<!-- Content panel -->
<!--<div class="menu-trigger"></div>-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">เป้าหมายพลังงานไฟฟ้าแยกตามอุปกรณ์</div>
				<div class="panel-body">
					{!! Form::open(array('action' => 'HomeController@tool_estimate','method' =>'post')) !!}
					<div class="form-group">
					    <label for="sel1">Year</label>
					    <select class="form-control" id="sel1" name="year">
					        
					        @foreach ($year as $key)
					        <option value = "{{ $key->year }}">{{ $key->year }}</option>
					        @endforeach
				      	</select>   
					</div>
					<div class="form-group">
					    <label for="sel1">Month</label>
					    <select class="form-control" id="sel1" name="month">
					        <option value = "1">มกราคม</option>
					        <option value = "2">กุมภาพันธ์</option>
					        <option value = "3">มีนาคม</option>
					        <option value = "4">เมษายน</option>
					        <option value = "5">พฤษ๓าคม</option>
					        <option value = "6">มิถุนายน</option>
					        <option value = "7">กรกฏาคม</option>
					        <option value = "8">สิงหาคม</option>
					        <option value = "9">กันยายน</option>
					        <option value = "10">คุลาคม</option>
					        <option value = "11">พฤศจิกายน</option>
					        <option value = "12">ธันวาคม</option>
				      	</select>   
					</div>

					<p class="text-right"><button type="submit" class="btn btn-primary">ตกลง</button></p>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@stop