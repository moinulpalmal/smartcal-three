@extends('layouts.admin.admin-master')

@section('title')
    Stores
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
        #FactoryAddress {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }
        #MasInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }

        #CPInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }

        #ManInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }

        #FHInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }
        #StoreInfo {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            display: block; /*reset from inline*/
            width: 100%;
            margin: 0; /*remove defaults*/
            padding: 4px;
            background: #EEF;
            border: 1px solid #333;
            overflow-y: auto; /*resets IE*/
            overflow-x: hidden;
            resize: none;
        }
    </style>
    <div class="page page-dashboard">
        <div class="pageheader ">
            <h2>Factories <span>Factory List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.store')}}">Stores</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="FactoryAdd" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Store</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryName" class="control-label">Store Name</label>
                                        <input type="text" class="form-control" name="name" id="FactoryName" placeholder="Enter factory name" required="">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="ShortName" class="control-label">Short Name</label>
                                        <input type="text" class="form-control" name="short_name" id="ShortName" placeholder="Enter short name" required="">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="StoreType" class="control-label">Select Sub Contractor Type</label>
                                        <select id="StoreType" class="form-control chosen-select" name="store_type" required = "" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            <option value="C">Central Store</option>
                                            <option value="S">Sub Store</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryAddress" class="control-label">Store Address</label>
                                        <textarea type="text" size="3" class="form-control" name="address" id="FactoryAddress" placeholder="Enter factory address" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="CPInfo" class="control-label">Primary Contact Person Info</label>
                                        <textarea type="text" size="3" class="form-control" name="contact_person_info" id="CPInfo" placeholder="Enter factory address" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="FHInfo" class="control-label">Store Manager Info</label>
                                        <textarea type="text" size="3" class="form-control" name="manager_info" id="FHInfo" placeholder="Enter factory head info" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                </form>
            </div>
            <!-- /col -->
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <section class="tile">
                    <!-- tile header -->
                    <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>Store</strong> List</h1>
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
                                    <li>
                                        <a role="button" tabindex="0" class="tile-fullscreen">
                                            <i class="fa fa-expand"></i> Fullscreen
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
                        <div class="table-responsive">
                            <h3 class="text-success text-center">{{Session::get('message')}}</h3>
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">Store Name</th>
                                    <th class="text-center">Short Name</th>
                                    <th class="text-center">Store Type</th>
                                    <th class="text-center">Contact Person Info</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($stores as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{!! $item->short_name !!}</td>
                                        <td class="text-center">
                                            @if($item->store_type == "C")
                                                <strong>Central Store</strong>
                                                @endif
                                                @if($item->store_type == "S")
                                                    <strong>Sub Store</strong>
                                                @endif
                                        </td>
                                        <td>{!! $item->contact_person_info !!}</td>
                                        <td>{!! $item->address !!}</td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#user{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>
                                            <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                            <a class="DeleteFactory btn btn-danger btn-xs" ><i class="fa fa-trash"></i></a>
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

@section('page-modals')
    @foreach($stores as $item)
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
@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}

    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({

            });
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#FactoryAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('admin.save-store') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        //console.log(data);
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
        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);

            var FactoryID = button.attr("data-id");


            var url = '{{ route('admin.edit-store') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=short_name]').val(data.short_name);
                    document.getElementById('FactoryAddress').value = data.address;
                    document.getElementById('FHInfo').value = data.manager_info;
                    document.getElementById('CPInfo').value = data.contact_person_info;
                    $('input[name=id]').val(data.id);
                },
                error:function(error){
                    //console.log(error);
                    swal({
                        title: "No Data Found!",
                        text: "no data!",
                        icon: "error",
                        button: "Ok!",
                        className: "myClass",
                    });
                }
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

