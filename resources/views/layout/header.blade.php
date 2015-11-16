<!--<nav id="slide-menu">
	<ul>
	@if (Auth::guest())
		<li><a href="{{ URL::asset('auth/login') }}">เข้าสู่ระบบ</a></li>
		<li><a href="{{ URL::asset('auth/register') }}">สมัครสมาชิก</a></li>
		<li><a href="{{ URL::asset('user/slideshow') }}">แสดงข้อมูลการใช้พลังงานไฟฟ้า</a></li>
	@else
		<li><a href="{{ URL::asset('user/slideshow') }}">แสดงข้อมูลการใช้พลังงานไฟฟ้า</a></li>
		<li><a href="{{ URL::asset('user/report') }}">รายงานการใช้พลังงานไฟฟ้า</a></li>
		<li><a href="{{ URL::asset('user/form_estimate') }}">กำหนดเป้าหมายการใช้พลังงานไฟฟ้ารวม</a></li>
		<li><a href="{{ URL::asset('user/form_toolestimate') }}">กำหนดเป้าหมายการใช้พลังงานไฟฟ้ารายอุปกรณ์</a></li>
		<li><a href="{{ URL::asset('auth/logout') }}">ออกจากระบบ</a></li>
	@endif
	</ul>
</nav>-->

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<img src="{{ URL::asset('assets/img/logo_BOT_Th.png')}}" style="width:213px;height:49PX";>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
		@if (Auth::guest())
			<li><a href="{{ URL::asset('auth/login') }}">เข้าสู่ระบบ</a></li>
			<li><a href="{{ URL::asset('auth/register') }}">สมัครสมาชิก</a></li>
			<li><a href="{{ URL::asset('user/slideshow') }}">แสดงข้อมูลการใช้พลังงานไฟฟ้า</a></li>
		@else
			<li><a href="{{ URL::asset('user/slideshow') }}">แสดงข้อมูลการใช้พลังงานไฟฟ้า</a></li>
			<li><a href="{{ URL::asset('user/report') }}">รายงานการใช้พลังงานไฟฟ้า</a></li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">กำหนดเป้าหมาย<span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="{{ URL::asset('user/form_estimate') }}">กำหนดเป้าหมายการใช้พลังงานไฟฟ้ารวม</a></li>
				<li><a href="{{ URL::asset('user/form_toolestimate') }}">กำหนดเป้าหมายการใช้พลังงานไฟฟ้ารายอุปกรณ์</a></li>
			  </ul>
			</li>
			<li><a href="{{ URL::asset('auth/logout') }}">ออกจากระบบ</a></li>
		@endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
