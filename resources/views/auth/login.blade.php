@extends('app')

@section('content')
<!--<div class="menu-trigger"></div>-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<!--<div class="panel-heading">Login</div>-->
				<div class="panel-heading">เข้าสู่ระบบ</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>!</strong> เกิดปัญหา<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<!--<label class="col-md-4 control-label">E-Mail Address</label>-->
							<label class="col-md-4 control-label">อีเมล</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<!--<label class="col-md-4 control-label">Password</label>-->
							<label class="col-md-4 control-label">รหัสผ่าน</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> จดจำรหัสผ่าน
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<!--<button type="submit" class="btn btn-primary">Login</button>-->
								<button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>

								<!--<a class="btn btn-link" href="{{ url('/password/email') }}">ลืมรหัสผ่าน</a>-->
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
