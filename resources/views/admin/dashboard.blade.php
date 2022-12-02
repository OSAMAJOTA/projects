@extends('layouts.admin')

@section('title')
home
@endsection

@section('contentheader')
home
@endsection


@section('contentheaderlink')
<a href="{{ route('admin.dashboard') }}">link </a>
@endsection

@section('contentheaderacive')
this is test
@endsection


@section('content')
<div class="row" style="background-image:url({{ asset('assets/admin/imgs/dash.jpg') }});background-size:cover;background-repeate:ni-repeate; min-height:600px;">
</div> 
@endsection
