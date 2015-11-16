@extends('app')

@section('title', 'เป้าหมายค่าไฟฟ้า')

@section('content')
<!-- Content panel -->
<!--<div class="menu-trigger"></div>-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">เป้าหมายการใช้พลังงานไฟฟ้า</div>
				<div class="panel-body">
					{!! Form::open(array('action' => 'HomeController@set_estimate','method' =>'post')) !!}
					<div class="form-group">
					    <label for="sel1">Year</label>
					    <select class="form-control" id="sel1" name="year"  required>
					        
					        @foreach ($year as $key)
					        <option value = "{{ $key->year }}">{{ $key->year }}</option>
					        @endforeach
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