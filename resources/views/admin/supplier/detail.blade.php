@extends('layouts.admin.admin-master')

@section('title')
    User Detail
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
    <div class="page page-profile">
        <div class="pageheader">
            <h2>LPD-2 <span>// Local Purchase Division Section: 2</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.user')}}">Active Users</a>
                    </li>
                    <li>
                        <a href="{{route('admin.user.detail', ['id' => $user->id])}}"> {{$user->name}}</a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- page content -->
        <div class="pagecontent">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-md-3">
                    <!-- tile -->
                    <section id="purchase-order" class="tile tile-simple">
                        <!-- tile widget -->
                        <div class="tile-widget p-30 text-center">
                            <div class="thumb thumb-xl">
                                @if(Auth::user()->gender == "M")
{{--                                    <img src="{{ asset('/') }}back-end/assets/images/male_profile.png" alt="" class="img-circle size-30x30">--}}
                                    <img class="img-circle" src="{{ asset('/') }}back-end/assets/images/male_profile.png" alt="">
                                @else
{{--                                    <img src="{{ asset('/') }}back-end/assets/images/female_profile.png" alt="" class="img-circle size-30x30">--}}
                                    <img class="img-circle" src="{{ asset('/') }}back-end/assets/images/female_profile.png" alt="">
                                @endif

                            </div>
                            <h4 class="mb-0"><strong>{{$user->name}}</strong></h4>
                            <span class="text-muted">{{$user->designation}}</span>
                            <div class="mt-10">
                                <a title="Refresh" class ="myIcon icon-info icon-ef-3 icon-ef-3b icon-color" onclick="refresh()">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                {{--<a title="Edit Master Information" href="{{route('lpd2.purchase.order.edit',['id'=>$purchaseOrder->id])}}" class="myIcon icon-warning icon-ef-3 icon-ef-3b icon-color">
                                    <i class="fa fa-edit"></i>
                                </a>--}}
                                @if(Auth::user()->hasTaskPermission('updateuser', Auth::user()->id))
                                    <a title="Edit User Info " href="{{ route('admin.user.edit',['id'=>$user->id]) }}" class ="myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" data-options="splash-2 splash-ef-12">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endif
                                @if(Auth::user()->hasTaskPermission('removeuser', Auth::user()->id))
                                    @if(Auth::user()->id != $user->id)
                                        <a title="Delete User" class="DeleteUser myIcon icon-danger icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $user->id }}"><i class="fa fa-trash"></i></a>
                                    @endif
                                @endif
                                @if(Auth::user()->id != $user->id)
                                    @if(Auth::user()->hasTaskPermission('approveuser', Auth::user()->id))
                                        @if(!$user->approved)
                                            <a title="Approve User" class="ApproveUser myIcon icon-success icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $user->id }}"><i class="fa fa-check"></i></a>
                                        @else
                                            <a title="Dis-Approve User" class="DisApproveUser myIcon icon-danger icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $user->id }}"><i class="fa fa-times"></i></a>
                                        @endif
                                    @endif
                                @endif
                                @if(Auth::user()->hasTaskPermission('resetpassword', Auth::user()->id))
                                    @if(Auth::user()->id != $user->id)
                                        <a title="Reset User Password" href="{{ route('admin.user.password.reset',['id'=>$user->id]) }}" class ="myIcon icon-info icon-ef-3 icon-ef-3b icon-color" data-options="splash-2 splash-ef-12">
                                            <i class="fa fa-key"></i>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>

                    </section>
                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>User</strong> Info</h1>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Email</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            <p class="text-right text-greensea">{{$user->email}}</p>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Employee ID</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            <p class="text-right text-greensea">{{$user->employee_id}}</p>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Factory</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
{{--                                            <p class="text-right text-greensea">{{(App\Helpers\Helpers::IDwiseData('factories','id',$user->factory_id))->name}}</p>--}}
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Factory</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
{{--                                            <p class="text-right text-greensea">{{(App\Helpers\Helpers::IDwiseData('departments','id',$user->department_id))->name}}</p>--}}
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Mobile No(P)</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            <p class="text-right text-greensea">{{$user->personal_mobile_no}}</p>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Mobile No(O)</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            <p class="text-right text-greensea">{{$user->official_mobile_no}}</p>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Approval Authority</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($user->approval_authority == true)
                                                <p class="text-right text-greensea">
                                                    True
                                                </p>
                                            @else
                                                <p class="text-right text-danger">
                                                    False
                                                </p>
                                            @endif
{{--                                            <p class="text-right text-greensea">{{$user->approval_authority}}</p>--}}
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Approval Status</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($user->approved == true)
                                            <p class="text-right text-greensea">
                                               Approved
                                            </p>
                                                @else
                                                <p class="text-right text-danger">
                                                    Not Approved
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->

                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-md-9">
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile body -->
                        <div class="tile-body p-0">
                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-dark" role="tablist">
                                    <li role="presentation" class="active"><a href="#itemList" aria-controls="itemList" role="tab" data-toggle="tab">Role List</a></li>
                                   {{-- <li role="presentation"><a href="#productionPlan" aria-controls="settingsTab" role="tab" data-toggle="tab">Production Plan</a></li>
                                    <li role="presentation"><a href="#productionAchievement" aria-controls="productionTab" role="tab" data-toggle="tab">Production Achievement</a></li>
                                    <li role="presentation"><a href="#stock" aria-controls="proformaTab" role="tab" data-toggle="tab">Current Stock</a></li>
                                    <li role="presentation"><a href="#delivery" aria-controls="proformaTab" role="tab" data-toggle="tab">Approved Delivery</a></li>
                                    <li role="presentation"><a href="#delivery-not" aria-controls="proformaTab" role="tab" data-toggle="tab">Not Approved Delivery</a></li>
                              --}}  </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="itemList">
                                        <div class="wrap-reset">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <form method="post" id="ItemAdd" name="ItemAddForm" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <section class="tile">
                                                            <!-- tile header -->
                                                            <div class="tile-header dvd dvd-btm">
                                                                <h1 class="custom-font"><strong>Role & Task</strong> Access Form</h1>
                                                               {{-- @if(Auth::user()->id != $user->id)
                                                                    @if(Auth::user()->hasTaskPermission('useraccess', Auth::user()->id))
                                                                        <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                                                                    @endif
                                                                @endif--}}

                                                                <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>

                                                            </div>
                                                            <!-- /tile header -->
                                                            <!-- tile body -->
                                                            <div class="tile-body">
                                                                <input type="hidden" id="UserID" name="user_id" value="{{old('user', $user->id)}}">
                                                                @foreach($roleList as $role)
                                                                <div class="row" style="padding: 0px 15px;">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="checkbox checkbox-custom-alt">
                                                                                <input type="checkbox" id="{{$role->name}}C" name="r_{{$role->name}}" @if(Auth::user()->hasPermission($role->name,$user->id )) checked @endif><i></i> {{$role->view_name}}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        @foreach($taskList as $task)
                                                                            @if($task->role_id == $role->id)
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label class="checkbox checkbox-custom-alt">
                                                                                        <input type="checkbox" class="{{$role->name}}" @if(!(Auth::user()->hasPermission($role->name,$user->id ))) disabled @endif name="t_{{$task->name}}" @if(Auth::user()->hasTaskPermission($task->name,$user->id )) checked @endif><i></i> {{$task->view_name}}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                    <hr>
                                                                @endforeach
                                                            </div>
                                                            <!-- /tile body -->
                                                        </section>
                                                        <!-- /tile -->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /page content -->
    </div>
@endsection

@section('page-modals')
    !-- PI Update Modal -->
   {{-- <div class="modal splash fade" id="ResetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="ResetPasswordFormID" name="ResetPasswordForm" --}}{{--onsubmit="return validateForm()"--}}{{-- enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header bg-blue">
                        <h3 class="modal-title custom-font text-white">Reset User Password</h3>
                    </div>
                    <div class="modal-body">
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
                                <input id="id" type="hidden" class="form-control" name="user_id" value="{{ old('user_id', $user->id) }}">
                                <input id="current_password" type="hidden" class="form-control" name="current_password" value="{{ old('current_password', $user->password) }}">

                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="password" class="control-label">New Password</label>
                                        <input id="password" type="password" class="form-control" name="password" >

                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="password-confirm" class="control-label">Confirm New Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <a><button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" type="submit"><i class="fa fa-arrow-right"></i> Reset Password</button></a>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    --}}<!-- PI Update Approval Modal -->
@endsection

@section('pageScripts')
    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({
                "scrollY":        "1000px",
                "scrollCollapse": true,
                "paging":         false
            });

            $('.select2').select2();
            sessionStorage.clear();

        });
        @foreach($roleList as $role)
            $(document).ready(function () {
                $("#{{$role->name}}C").click(function () {
                    if ($("#{{$role->name}}C").is(":checked")) {
                        $(".{{$role->name}}").prop('checked', true);
                        $(".{{$role->name}}").prop('disabled', false);
                    } else {
                        $(".{{$role->name}}").prop('checked', false);
                        $(".{{$role->name}}").prop('disabled', true);
                    }
                    //$(".check").attr('checked', this.checked);
                });
            });
        @endforeach


        /*$(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ResetPasswordFormID').submit(function(e){
                e.preventDefault();

                var data = $(this).serialize();
                //var masterId = $('#MasterID').val();
                var id = document.forms["ResetPasswordForm"]["user_id"].value;
                var password = document.forms["ResetPasswordForm"]["password"].value;
                var confirm_password = document.forms["ResetPasswordForm"]["password_confirmation"].value;

                //console.log(data);
                //return;

                if(password == ""){
                    swal({
                        title: "Invalid Password!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(password.length < 8){
                    swal({
                        title: "Minimum Password Length 8 !",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else if(password != confirm_password){
                    swal({
                        title: "Password Mis-Match!",
                        icon: "warning",
                        button: "Ok!",
                    });
                    return false;
                }
                else{
                    //console.log(data.password_confirmation);
                    //return;

                    var url = '{{ route('admin.user.password.update') }}';
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            //console.log(data.password_confirmation);
                            //return;
                            if(data)
                            {
                                //console.log(data);
                                //return;
                                swal({
                                    title: "Password Change Successfully!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                            else
                            {
                                swal({
                                    title: "Something wrong happened!",
                                    text: "Wrong password format",
                                    icon: "warning",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Data Not Saved!",
                                text: "Please Check Your Data!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }

            })
        });*/


        $('#purchase-order').on('click',".DeleteUser", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.user.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This user will be removed temporarily!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });

        $('#purchase-order').on('click',".ApproveUser", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.user.access.provide') }}';
            swal({
                title: 'Are you sure?',
                text: 'This user access will be approved!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });

        $('#purchase-order').on('click',".DisApproveUser", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.user.access.block') }}';
            swal({
                title: 'Are you sure?',
                text: 'This user access will be blocked!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ItemAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#UserID').val();
               // var masterId = $('#MasterID').val();
                //console.log(data);

                /*$.each(data, function(i, field){
                    $("#ItemAdd").append(field.name + ":" + field.value + " ");
                });*/
                //return;
                var url = '{{ route('admin.user.apply-role') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        //console.log(data);
                        //return;
                        if(id)
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
                            });
                        }
                        else
                        {
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
                            });
                        }
                    },
                    error:function(error){
                        console.log(error);
                        swal({
                            title: "Data Not Saved!",
                            text: "Please Check Your Data!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                })

            })
        });
        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }

    </script>
@endsection()


