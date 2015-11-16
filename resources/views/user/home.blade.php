@extends('app')

@section('title', 'หน้าหลัก')

@section('content')
<!-- Content panel -->
	<div class="menu-trigger"></div>
	{{ Auth::user() }}
@stop