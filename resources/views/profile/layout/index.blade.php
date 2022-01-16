@extends('layouts.admin.admin-master')
@section('title')
    User Profile
@endsection

@section('content')
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>{{ Auth::user()->name }} <span>// Profile Settings</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home.profile')}}"><i class="fa fa-home"></i> Profile</a>
                    </li>
                </ul>
                {{--<div class="page-toolbar">
                    <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                    </a>
                </div>--}}
            </div>
        </div>
    </div>
@endsection
