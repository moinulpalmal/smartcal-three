@extends('layouts.admin.admin-master')

@section('title')
    Historical Users
    @endsection
@section('content')
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>Users <span>Active Users List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.historical-user')}}">Historical Users</a>
                    </li>
                </ul>
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
                        <h1 class="custom-font"><strong>Manage</strong> Historical Users</h1>
                        <ul class="controls">
                            <li>
                                {{--                                    <a href="{{asset('/user/add')}}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add Entry</a>--}}
                                @if(Auth::user()->hasTaskPermission('createuser', Auth::user()->id))
                                <a href="{{route('admin.user.new')}}" role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add New User</a>
                                @endif
                            </li>
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
{{--                            <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>--}}
                        </ul>
                    </div>
                    <!-- /tile header -->

                    <!-- tile body -->
                    <div class="tile-body">
                        {{--<div class="row">
                            <div class="col-md-6"><div id="colVis"></div></div>
                            <div class="col-md-6"><div id="tableTools"></div></div>
                        </div>--}}
                        <div class="table-responsive">
                            <h3 class="text-success text-center">{{Session::get('message')}}</h3>
                            <table class="table table-hover" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">User Name</th>
                                    {{--<th class="text-center">Factory</th>
                                    <th class="text-center">Department</th>--}}
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Registration Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($users as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td>{{$item->name}}</td>
{{--                                        <td>{{(App\Helpers\Helper::IDwiseData('factories','id',$item->factory_id))->name}}</td>--}}
{{--                                        <td>{{(App\Helpers\Helper::IDwiseData('departments','id',$item->department_id))->name}}</td>--}}
                                        <td>{!! $item->email !!}</td>
                                        <td class="text-center {{$item->approved == false ? 'text-danger' : 'text-success'}}">{{$item->approved == true ? 'Approved' : 'Not Approved'}}</td>
                                        <td class="text-center">

                                            @if(Auth::user()->hasTaskPermission('restoreuser', Auth::user()->id))
                                                <a title="Restore User" class="RestoreUser btn btn-info btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-up"></i></a>
                                                <a title="Remove User" class="RemoveUser btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
@endsection

@section('pageVendorScripts')
    @endsection
@section('pageScripts')

    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({

            });
        });

        $('#advanced-usage').on('click',".RestoreUser", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.user.restore') }}';
            swal({
                title: 'Are you sure?',
                text: 'This user will be restored!',
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

        $('#advanced-usage').on('click',".RemoveUser", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.user.remove') }}';
            swal({
                title: 'Are you sure?',
                text: 'This user will be restored!',
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

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }
    </script>

@endsection()
