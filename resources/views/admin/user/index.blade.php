@extends('layouts.admin.admin-master')

@section('title')
    Users
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
                        <a href="{{route('admin.user')}}">Active Users</a>
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
                        <h1 class="custom-font"><strong>Manage</strong> Users</h1>
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
                                        {{--<td>{{(App\Helpers\Helpers::IDwiseData('factories','id',$item->factory_id))->name}}</td>
                                        <td>{{(App\Helpers\Helpers::IDwiseData('departments','id',$item->department_id))->name}}</td>
                                        --}}<td>{!! $item->email !!}</td>
                                        <td class="text-center {{$item->approved == false ? 'text-danger' : 'text-success'}}">{{$item->approved == true ? 'Approved' : 'Not Approved'}}</td>
                                        <td class="text-center">
                                            <a title="Detail" href="{{route('admin.user.detail',['id'=>$item->id])}}" class="btn btn-info btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                        {{--<td class="text-center">
                                            @if($item->approved == true)
                                                <a href="{{route('',['id'=>$item->id])}}" class="btn btn-warning btn-xs">
                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                </a>
                                            @else
                                                <a href="{{route('/admin/user/approve',['id'=>$item->id])}}" class="btn btn-info btn-xs">
                                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                                </a>
                                            @endif
                                            --}}{{--<a href="{{route('/shop/edit',['id'=>$item->id])}}" class="btn btn-success btn-xs">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                                --}}{{--
                                            <a href="{{route('/admin/user/detail',['id'=>$item->id])}}" class="btn btn-success btn-xs">
                                                <span class="glyphicon glyphicon-tree-conifer"></span>
                                            </a>
                                            <a href="{{route('/admin/user/soft-delete',['id'=>$item->id])}}" class="btn btn-danger btn-xs">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>

                                            <a href="#" class="btn btn-success btn-xs">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            <a href="#" class="btn btn-default btn-xs">
                                                <span class="glyphicon glyphicon-tasks"></span>
                                            </a>
                                        </td>--}}
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
@section('page-modals')
   {{-- @if($factories != null)
    @foreach($factories as $item)
        <!-- Modal -->
        <div class="modal splash fade" id="user{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title custom-font">{!! $item->name !!}</h3>
                    </div>
                    <div class="modal-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-5">
                                    <strong class="text-left">Factory Name</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6 text-right">
                                    <p>{{$item->name}}</p>
                                </div>
                                <div class="col-md-5">
                                    <strong class="text-left">Short Name</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6">
                                    <p class="text-right">{{$item->short_name}}</p>
                                </div>
                                <div class="col-md-5">
                                    <strong class="text-left">Address</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6">
                                    <p class="text-right">{{$item->address}}</div>
                                <div class="col-md-5">
                                    <strong class="text-left">Is CHO</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6">
                                    @if($item->IsCHO == 'CHO')
                                        <p class="text-white-50 text-right">Yes</p>
                                    @else
                                        <p class="text-danger text-right">No</p>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <strong class="text-left">VAT No.</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6 text-right">
                                    <p>{{$item->vat_no}}</p>
                                </div>
                                <br>
                                <div class="col-md-5">
                                    <strong class="text-left">BIN No.</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6">
                                    <p class="text-right">{{$item->bin_no}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-5">
                                    <strong class="text-left">Factory Head</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6">
                                    <p class="text-right">{{$item->factory_head_info}}</p>
                                </div>
                                <div class="col-md-5">
                                    <strong class="text-left">Factory Manager</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6 text-right">
                                    <p class="text-right">{{$item->manager_info}}</p>
                                </div>
                                <div class="col-md-5">
                                    <strong class="text-left">Contact Person</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6">
                                    <p class="text-right">{{$item->contact_person_info}}</div>
                                <div class="col-md-5">
                                    <strong class="text-left">Store Info</strong>
                                </div>
                                <div class="col-md-1">:</div>
                                <div class="col-md-6">
                                    <p class="text-right">{{$item->factory_store_info}}</div>
                            </div>
                            <div class="col-md-5">
                                <strong class="text-left">Messenger Info</strong>
                            </div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-6">
                                <p class="text-right">{{$item->factory_messenger_info}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Submit</button>
                        <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    @endforeach
    @endif--}}
@endsection
@section('pageVendorScripts')

    @endsection
@section('pageScripts')

    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({

            });
        });

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }
    </script>

@endsection()
