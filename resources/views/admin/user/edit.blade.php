@extends('layouts.admin.admin-master')
@section('title')
    Update Users
@endsection
@section('content')
    <style type="text/css">
        th{
            background-color: #0689bd;
            color: white;
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
            <h2>User <span>Create New User</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.user')}}">Active Users</a>
                    </li>
                    <li>
                        <a href="{{route('admin.user.detail', ['id' => $user->id])}}"> {{$user->name}}</a>
                    </li>
                    <li>
                        <a href="{{route('admin.user.edit', ['id' => $user->id])}}"> Update: {{$user->name}}</a>
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
            <div class="col-md-12">
                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Create </strong>User</h1>
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
                                        <a role="button" tabindex="0" class="tile-refresh">
                                            <i class="fa fa-refresh"></i> Refresh
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                        </ul>
                    </div>
                    <!-- /tile header -->
                    <!-- tile body -->
                    <div class="tile-body">                       <!-- row -->
                        <form method="post" id="UserCreatForm" name="UserCreatForm" action="{{route('admin.user.update')}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="row">
                                <!-- col -->
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- tile -->
                                    <section class="tile">
                                        <!-- tile header -->
                                        <div class="tile-header dvd dvd-btm">
                                            <h1 class="custom-font"><strong>Provide</strong> User Update Information</h1>
                                            <a><button class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-edit"></i></button></a>
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
                                            <div class="row" style="padding: 0px 15px;">
                                                <input id="id" type="hidden" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id', $user->id) }}">

                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="EmpCode" class="control-label">Employee ID</label>
                                                        <input id="EmpCode" type="text" class="form-control @error('employee_id') is-invalid @enderror" placeholder="6655" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="FullName" class="control-label">Employee Name</label>
                                                        <input id="FullName" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name', $user->name) }}" required autocomplete="name" >
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Designation" class="control-label">Employee Designation</label>
                                                        <input id="Designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation', $user->designation) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Gender" class="control-label">Select Gender</label>
                                                        <select id="Gender" class="form-control select2 @error('gender') is-invalid @enderror" name="gender" style="width: 100%;" required>
                                                            <option value="">- - - Select - - -</option>
                                                            <option value="M" @if($user->gender == 'M') selected="selected" @endif>Male</option>
                                                            <option value="F" @if($user->gender == 'F') selected="selected" @endif>Female</option>
                                                            <option value="O" @if($user->gender == 'O') selected="selected" @endif>Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding: 0px 15px;">
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="OfficialPhone" class="control-label">Official Mobile No.</label>
                                                        <input id="OfficialPhone" type="text" class="form-control @error('official_mobile_number') is-invalid @enderror" placeholder="01847326665" name="official_mobile_number" value="{{ old('official_mobile_number', $user->official_mobile_no) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="PersonalPhone" class="control-label">Personal Mobile No.</label>
                                                        <input id="PersonalPhone" type="text" class="form-control @error('personal_mobile_number') is-invalid @enderror" placeholder="01847326665" name="personal_mobile_number" value="{{ old('personal_mobile_number', $user->personal_mobile_no) }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="ExtensionPhone" class="control-label">Official Extension No.</label>
                                                        <input id="ExtensionPhone" type="text" class="form-control @error('official_extension_no') is-invalid @enderror" placeholder="547" name="official_extension_no" value="{{ old('official_extension_no', $user->official_extension_no) }}">
                                                    </div>
                                                </div>
                                            </div>
                                           {{-- <div class="row" style="padding: 0px 15px;">
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="FactoryName" class="control-label">Select Factory</label>
                                                        <select id="FactoryName" class="form-control select2 @error('factory') is-invalid @enderror" name="factory" required style="width: 100%;">
                                                            <option value="" selected ="selected">- - - Select - - -</option>
                                                            @if(!empty($factories))
                                                                @foreach($factories as $item)
                                                                    <option value="{{ $item->id }}" @if($user->factory_id == $item->id) selected="selected" @endif>{{ $item->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="DepartmentName" class="control-label">Select Department</label>
                                                        <select id="DepartmentName" class="form-control select2 @error('department') is-invalid @enderror" name="department" required style="width: 100%;">
                                                            <option value="" selected ="selected">- - - Select - - -</option>
                                                            @if(!empty($departments))
                                                                @foreach($departments as $item)
                                                                    <option value="{{ $item->id }}"  @if($user->department_id == $item->id) selected="selected" @endif>{{ $item->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="EmployeeJoiningDate" class="control-label">Joining Date</label>
                                                        <input id="EmployeeJoiningDate" type="date" class="form-control @error('employee_joining_date') is-invalid @enderror" name="employee_joining_date" value="{{ old('employee_joining_date', $user->employee_joining_date) }}">
                                                    </div>
                                                </div>
                                            </div>--}}
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


@section('pageScripts')
    <script>
        $('.select2').select2();
        //$('.ddlDepartment').select2();
    </script>
@endsection()

