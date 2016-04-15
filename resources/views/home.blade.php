@extends('layouts.app')

@section('content')
<div class="container home-page">
    <div class="row">
        <div class="col-sm-6 text-center left-box">
            <h3>Hello Bars</h3>
            <p>lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet</p>
            <div>
                <a class="btn btn-default" href="{{url('/hello-bar-create')}}">New</a>
                <a class="btn btn-default" href="{{url('/hello-bar-manage')}}">Manage</a>
            </div>
        </div>
        <div class="col-sm-6 text-center right-box">
            <h3>Traffic Generations</h3>
            <p>lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet</p>
            <div>
                <a class="btn btn-default" href="{{url('/traffic-create')}}">New</a>
                <a class="btn btn-default" href="{{url('/traffic-manage')}}">Manage</a>
            </div>
        </div>
    </div>
</div>
@endsection
