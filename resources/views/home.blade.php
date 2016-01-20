@extends('templates.layout')

@section('content')
    <div id="app">
        <router-view :hosts="hosts" :pageTitle.sync="pageTitle"></router-view>
    </div>
@endsection