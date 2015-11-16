 @extends('app')

@section('title', 'แสดงข้อมูลการใช้พลังงานไฟฟ้า')

@section('content')
	<!--<div class="menu-trigger"></div>-->
	<div class="row">
		<div class="col-md-9">
		<script src="/socket.io/socket.io.js"></script>
<script>
  var socket = io('http://localhost');
  socket.on('news', function (data) {
    console.log(data);
    socket.emit('my other event', { my: 'data' });
  });
</script>
	</div>
@stop

