@extends('layouts.admin.admin-master')
@section('title')
    User Profile
@endsection

@section('content')
    <style type="text/css">
        th{
            background-color: #0689bd;
            color: white;
            /*font-size: x-small;
            height: 10px !important;*/
        }
        .tile-body{
            background-color: white;
        }
        .tile-header{
            color: white;
        }
        .tile-header{
            background-color:#105e7d;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>{{ Auth::user()->name }} <span>// Profile Settings</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home.profile')}}"><i class="fa fa-home"></i> Profile</a>
                    </li>
                    <li>
                        <a href="{{route('home.profile.change-password')}}"> Change Password</a>
                    </li>
                </ul>
                {{--<div class="page-toolbar">
                    <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                    </a>
                </div>--}}
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Change</strong> <span>// Password</span></h1>
                        <ul class="controls">
                            <li class="dropdown">
                                <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                    <i class="fa fa-cog"></i>
                                    <i class="fa fa-spinner fa-spin"></i>
                                </a>
                                <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                    <li>
                                        <a role="button" tabindex="0" class="tile-toggle">
                                            <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                            <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="refresh()" role="button" tabindex="0" class="tile-refresh">
                                            <i class="fa fa-refresh"></i> Refresh
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{--                            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>--}}
                        </ul>
                    </div>
                    <!-- /tile header -->
                    <!-- tile body -->
                    <div class="tile-body">                       <!-- row -->
                        <form method="post" id="UserCreatForm" name="UserCreatForm" action="{{route('home.profile.update-password')}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="row">
                                <!-- col -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- tile -->
                                    <section class="tile">
                                        <!-- tile header -->
                                        <div class="tile-header dvd dvd-btm">
                                            <h1 class="custom-font"><strong>Password</strong> Change Form</h1>
                                            <a><button class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                                        </div>
                                        <!-- /tile header -->
                                        <!-- tile body -->
                                        <div class="tile-body">
                                            @if (count($errors) > 0)
                                                <div class="row" style="padding: 0px 15px;">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger">
                                                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                                @if (\Illuminate\Support\Facades\Session::has('change-password-success'))
                                                    <div class="row" style="padding: 0px 15px;">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-success">
                                                                <strong>Success!</strong><br><br>
                                                                <ul>
                                                                    <li>{{ \Illuminate\Support\Facades\Session::get('change-password-success') }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif


                                                <div class="row" style="padding: 0px 15px;">
                                                    <div class="col-md-4 no-padding">
                                                        <div class="form-group">
                                                            <label for="current-password" class="control-label">Current Password</label>
                                                            <input id="current-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 no-padding">
                                                        <div class="form-group">
                                                            <label for="new-password" class="control-label">New Password</label>
                                                            <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" value="{{ old('new-password') }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 no-padding">
                                                        <div class="form-group">
                                                            <label for="new-password-confirmation" class="control-label">Confirm New Password</label>
                                                            <input id="new-password-confirmation" type="password" class="form-control @error('new-password-confirmation') is-invalid @enderror" name="new-password-confirmation" value="{{ old('new-password-confirmation') }}" autocomplete="new-password">
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- /tile body -->
                                    </section>
                                    <!-- /tile -->
                                </div>
                                <!-- /col -->
                                <!-- col -->
                                <!-- /col -->
                            </div>
                        </form>
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
@endsection
