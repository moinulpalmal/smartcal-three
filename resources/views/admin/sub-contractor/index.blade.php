@extends('layouts.admin.admin-master')
@section('title')
    Sub-Contractor
@endsection
@section('content')
    <style type="text/css">
        th {
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
        #SubContractorAddress {
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
        #Remarks {
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
            <h2>Sub-Contractors <span>Sub-Contractor List</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Administration</a>
                    </li>
                    <li>
                        <a href="{{route('admin.sub-contractor')}}">Sub-Contractors</a>
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
                            <h1 class="custom-font"><strong>Sub-Contractor</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorName" class="control-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="SubContractorName" placeholder="Enter sub-contractor name" required="">
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorType" class="control-label">Select Sub Contractor Type</label>
                                        <select id="SubContractorType" class="form-control chosen-select" name="sub_contractor_type" required = "" style="width: 100%;">
                                            <option value="">- - - Select - - -</option>
                                            <option value="I">International</option>
                                            <option value="L">Local</option>
                                            <option value="LI">Local & International</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorGrade" class="control-label">Grade Details</label>
                                        <input type="text" class="form-control" name="sub_contractor_grade" id="SubContractorGrade" placeholder="A,B,C" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="SubContractorAddress" class="control-label">Sub-Contractor Address</label>
                                        <textarea type="text" size="3" class="form-control" name="address" id="SubContractorAddress" placeholder="Enter sub-contractor address" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 no-padding">
                                    <div class="form-group">
                                        <label for="Remarks" class="control-label">Remarks</label>
                                        <textarea type="text" size="3" class="form-control" name="remarks" id="Remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <section class="tile">
                                        <div class="tile-header dvd dvd-btm bg-greensea">
                                            <h3 class="custom-font"><strong>Owner Info</strong></h3>
                                        </div>
                                        <div class="tile-body">
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerName" class="control-label">Name</label>
                                                    <input type="text" class="form-control" name="owner_name" id="OwnerName" placeholder="Enter name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerDesignation" class="control-label">Designation</label>
                                                    <input type="text" class="form-control" name="owner_designation" id="OwnerDesignation" placeholder="Enter designation" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerMobileNo" class="control-label">Mobile No</label>
                                                    <input type="text" class="form-control" name="owner_mobile_no" id="OwnerMobileNo" placeholder="Enter mobile no" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="OwnerEmail" class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="owner_email" id="OwnerEmail" placeholder="Enter email" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <section class="tile">
                                        <div class="tile-header dvd dvd-btm bg-greensea">
                                            <h3 class="custom-font"><strong>Primary Contact Person Info</strong></h3>
                                        </div>
                                        <div class="tile-body">
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryContactPersonName" class="control-label">Name</label>
                                                    <input type="text" class="form-control" name="primary_contact_person" id="PrimaryContactPersonName" placeholder="Enter name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryContactPersonDesignation" class="control-label">Designation</label>
                                                    <input type="text" class="form-control" name="primary_designation" id="PrimaryContactPersonDesignation" placeholder="Enter designation" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryMobileNo" class="control-label">Mobile No</label>
                                                    <input type="text" class="form-control" name="primary_mobile_no" id="PrimaryMobileNo" placeholder="Enter mobile no" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="PrimaryEmail" class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="primary_email" id="PrimaryEmail" placeholder="Enter email" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 no-padding">
                                    <section class="tile">
                                        <div class="tile-header dvd dvd-btm bg-greensea">
                                            <h3 class="custom-font"><strong>Secondary Contact Person Info</strong></h3>
                                        </div>
                                        <div class="tile-body">
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryContactPersonName" class="control-label">Name</label>
                                                    <input type="text" class="form-control" name="secondary_contact_person" id="SecondaryContactPersonName" placeholder="Enter name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryContactPersonDesignation" class="control-label">Designation</label>
                                                    <input type="text" class="form-control" name="secondary_designation" id="SecondaryContactPersonDesignation" placeholder="Enter designation" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryMobileNo" class="control-label">Mobile No</label>
                                                    <input type="text" class="form-control" name="secondary_mobile_no" id="SecondaryMobileNo" placeholder="Enter mobile no" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 no-padding">
                                                <div class="form-group">
                                                    <label for="SecondaryEmail" class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="secondary_email" id="SecondaryEmail" placeholder="Enter email" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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
                        <h1 class="custom-font"><strong>Sub-Contractor</strong> List</h1>
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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($subContractors as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-left">{{$item->name}}</td>
                                        <td>
                                            @if($item->type == 'I')
                                                <p><strong>International</strong></p>
                                                @elseif($item->type == 'L')
                                                <p><strong>Local</strong></p>
                                                    @elseif($item->type == 'LI')
                                                    <p><strong>International & Local</strong></p>
                                                        @else
                                                        <p><strong></strong></p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->status == 'I')
                                                <span class="label label-info">Waiting for approval</span>
                                            @elseif($item->status == 'A')
                                                <span class="label label-success">Active</span>
                                            @elseif($item->status == 'B')
                                                <span class="label label-danger">Blocked</span>
                                            @elseif($item->status == 'IN')
                                                <span class="label label-warning">In-Active</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#user{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>
                                            <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                            @if($item->status == 'I')
                                                <a title="Activate" class="ActivateBuyer btn btn-success btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-up"></i></a>
                                                @else
                                                    @if($item->status == 'A')
                                                        <a title="De-Activate" class="DeActivateBuyer btn btn-warning btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-down"></i></a>
                                                        <a title="Block" class="BlockActivateBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-times"></i></a>
                                                    @elseif($item->status == 'IN' || $item->status == 'B')
                                                        <a title="Activate" class="ActivateBuyer btn btn-success btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-up"></i></a>
                                                    @endif
                                                    @if($item->status == 'A')
                                                        <a title="Delete" class="DeleteBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                    @endif
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

@section('page-modals')
    @foreach($subContractors as $item)
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
                console.log(data);
                var url = '{{ route('admin.save-sub-contractor') }}';
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
            //$('body').animate({scrollTop:0}, 400);
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            var url = '{{ route('admin.edit-sub-contractor') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=sub_contractor_grade]').val(data.sub_contractor_grade);
                    $('input[name=owner_name]').val(data.owner_name);
                    $('input[name=owner_email]').val(data.owner_email);
                    $('input[name=owner_designation]').val(data.owner_designation);
                    $('input[name=owner_mobile_no]').val(data.owner_mobile_no);
                    $('input[name=primary_contact_person]').val(data.primary_contact_person);
                    $('input[name=primary_mobile_no]').val(data.primary_mobile_no);
                    $('input[name=primary_email]').val(data.primary_email);
                    $('input[name=primary_designation]').val(data.primary_designation);
                    $('input[name=secondary_contact_person]').val(data.secondary_contact_person);
                    $('input[name=secondary_mobile_no]').val(data.secondary_mobile_no);
                    $('input[name=secondary_email]').val(data.secondary_email);
                    $('input[name=secondary_designation]').val(data.secondary_designation);
                    //$('input[name=remarks]').val(data.remarks);

                    document.getElementById('SubContractorAddress').value = data.address;
                    document.getElementById('Remarks').value = data.remarks;
                    //$("#FactoryName option[value = '" + data.factory_name + "']").attr('selected', 'selected').change();
                    //console.log();

                    $('input[name=id]').val(data.id);
                },
                error:function(error){
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



        $('#advanced-usage').on('click',".ActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.activate-sub-contractor') }}';
            swal({
                title: 'Are you sure?',
                text: 'This sub-contractor will be a active one!',
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

        $('#advanced-usage').on('click',".DeActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.in-activate-sub-contractor') }}';
            swal({
                title: 'Are you sure?',
                text: 'This sub-contractor will be in-active!',
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
        $('#advanced-usage').on('click',".BlockActivateBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.black-list-sub-contractor') }}';
            swal({
                title: 'Are you sure?',
                text: 'This sub-contractor will be blocked!',
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

        $('#advanced-usage').on('click',".DeleteBuyer", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.delete-sub-contractor') }}';
            swal({
                title: 'Are you sure?',
                text: 'This sub-contractor will be removed permanently!',
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

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
    </script>
@endsection()

