@extends('layouts.admin.admin-master')
@section('title')
    Thread
@endsection
@section('content')
    <style type="text/css">
        .tile-body{
            background-color: white;
        }
        .tile-header{
            color: white;
        }
        .tile-header{
            background-color:#105e7d;
        }
        tfoot input {
            width: 100%;
            padding: 1px;
            box-sizing: border-box;
        }
    </style>
    <div class="page page-profile">
        <div class="pageheader">
        <h2>Thread <span> Booking Details</span></h2>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"> Thread</a>
                </li>
                <li>
                    <a href="{{route('thread.booking.recent')}}"> Recent Bookings</a>
                </li>
                <li>
                    <a href="{{route('thread.booking.detail', ['id', $purchaseOrder->id ])}}"> LPD-3 PO NO: {{$purchaseOrder->lpd_po_no}}</a>
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
                            {{--<div class="thumb thumb-xl">
                                <img class="img-circle" src="assets/images/arnold-avatar.jpg" alt="">
                            </div>--}}
                            <h4 class="mb-0"><strong>LPD-3 PO NO:</strong> {{$purchaseOrder->lpd_po_no}}</h4>
                            <div class="mt-10">
                                @if($duplicate == true)
                                    @if(Auth::user()->hasTaskPermission('resetpo', Auth::user()->id))
                                        <a title="Reset LPD PO" class="ResetPO myIcon icon-success icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $purchaseOrder->id }}"><i class="fa fa-recycle"></i></a>
                                    @endif
                                @else
                                <a title="Refresh" class ="myIcon icon-info icon-ef-3 icon-ef-3b icon-color" onclick="refresh()">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                @if(Auth::user()->hasTaskPermission('updatetdmaster', Auth::user()->id))
                                    <a title="Edit Booking Master Update" class ="myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" href="{{route('thread.booking.edit', ['id' => $purchaseOrder->id])}}" {{--data-toggle="modal" data-target="#POUpdateModal" --}}data-options="splash-2 splash-ef-12">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endif
                                @if(Auth::user()->hasTaskPermission('revisetd', Auth::user()->id))
                                    <a title="Revise Booking" class="ReviseOrder myIcon icon-success icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $purchaseOrder->id }}"><i class="fa fa-recycle"></i></a>
                                    <a title="Urgent Booking" class="UrgentOrder myIcon icon-warning icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $purchaseOrder->id }}"><i class="fa fa-rocket"></i></a>

                                @endif
                                @if(Auth::user()->hasTaskPermission('deletetd', Auth::user()->id))
                                    <a title="Delete Booking" class="DeleteOrder myIcon icon-danger icon-ef-3 icon-ef-3b icon-color" data-id = "{{ $purchaseOrder->id }}"><i class="fa fa-trash"></i></a>
                                @endif

                                <a title="PDF View" class ="myIcon icon-danger icon-ef-3 icon-ef-3b icon-color" {{--target="_blank"--}} href="{{route('thread.booking.detail.pdf', ['id' => $purchaseOrder->id])}}">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                                    @endif
                            </div>
                        </div>
                    </section>
                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Booking</strong> Info</h1>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Supplier</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->supplier_id != null)
                                                <p class="text-right text-greensea">
                                                    {{(App\Helpers\Helper::IDwiseData('suppliers','id',$purchaseOrder->supplier_id))->name}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Delivery Location</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->delivery_location_id != null)
                                                <p class="text-right text-greensea">
                                                    {{(App\Helpers\Helper::IDwiseData('delivery_locations','id',$purchaseOrder->delivery_location_id))->name}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Buyer</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->buyer_id != null)
                                                <p class="text-right text-greensea">
                                                    {{(App\Helpers\Helper::IDwiseData('buyers','id',$purchaseOrder->buyer_id))->name}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Style</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->style != null)
                                                <p class="text-right text-greensea">
                                                    {{$purchaseOrder->style}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Buyer PO NO</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->buyer_po_no != null)
                                                <p class="text-right text-greensea">
                                                    {{$purchaseOrder->buyer_po_no}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Consumption / Pcs/ Inch/ DZ</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->consumption_per_dz != null)
                                                <p class="text-right text-greensea">
                                                    {{$purchaseOrder->consumption_per_dz}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Garments Qty</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->garments_quantity != null)
                                                <p class="text-right text-greensea">
                                                    {{$purchaseOrder->garments_quantity}}
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
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Booking</strong> Status</h1>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <ul class="list-unstyled">
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Booking Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->lpd_po_date != null)
                                                <p class="text-right text-greensea">
                                                    {{\Carbon\Carbon::parse($purchaseOrder->lpd_po_date)->format('d/m/Y')}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Last Approval Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->approval_date != null)
                                                <p class="text-right text-greensea">{{\Carbon\Carbon::parse($purchaseOrder->approval_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Is Revised</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->is_revised == true)
                                                <p class="text-right text-greensea">Yes</p>
                                                @else
                                                <p class="text-right text-danger">No</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                                <li>
                                    <div class="row">
                                        <div class="col-md-5 pull-left">
                                            <strong>Last Revise Date</strong>
                                        </div>
                                        <div class="col-md-7 pull-right">
                                            @if($purchaseOrder->last_revise_date != null)
                                                <p class="text-right text-greensea">{{\Carbon\Carbon::parse($purchaseOrder->last_revise_date)->format('d/m/Y')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <hr>
                            </ul>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- /tile -->
                    <!-- tile -->

                    <!-- /tile -->
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Description</strong> </h1>
                        </div>

                        <!-- tile body -->

                        <div class="tile-body">
                            <p class="text-default lt">{!! $purchaseOrder->description !!}</p>
                        </div>
                        <!-- /tile body -->
                    </section>
                    <!-- tile -->
                    <section class="tile tile-simple">
                        <!-- tile header -->
                        <div class="tile-header">
                            <h1 class="custom-font"><strong>Remarks</strong> </h1>
                        </div>

                        <!-- tile body -->

                        <div class="tile-body">
                            <p class="text-default lt">{!! $purchaseOrder->remarks !!}</p>
                        </div>
                        <!-- /tile body -->
                    </section>

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
                                    <li role="presentation" class="active"><a href="#itemList" aria-controls="itemList" role="tab" data-toggle="tab">Item List</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="itemList">
                                        <div class="wrap-reset">
                                            @if($duplicate == true)
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                        <h4 class="text-danger text-bold"><strong>Duplicate LPD PO No. Please Contact with Administrator</strong></h4>
                                                    </div>
                                                </div>
                                            @else
                                                @if(Auth::user()->hasTaskPermission('deletetd', Auth::user()->id))
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                            <form method="post" id="ItemAdd" name="ItemAddForm" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <section class="tile">
                                                                    <!-- tile header -->
                                                                    <div class="tile-header dvd dvd-btm">
                                                                        <h1 class="custom-font"><strong>Item</strong> Insert/Update Form</h1>

                                                                        <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>

                                                                    </div>
                                                                    <!-- /tile header -->
                                                                    <!-- tile body -->
                                                                    <div class="tile-body">
                                                                        <input type="hidden" id="DetailID" name="item_id">
                                                                        <input type="hidden" id="DecimalID" class="DecimalCount" name="decimal_count">
                                                                        <input type="hidden" id="MasterID" name="purchase_order_master_id" value="{{old('purchase_order_master_id', $purchaseOrder->id)}}">
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-5 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="ProductID" class="control-label">Select Product</label>
                                                                                    <select id="ProductID" class="form-control select2" name="thread_product_setup" required style="width: 100%;" onchange="javascript:getProductPrice(this)">
                                                                                        <option value="">- - - Select - - -</option>
                                                                                        @if(!empty($products))
                                                                                            @foreach($products as $group)
                                                                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                                                            @endforeach'
                                                                                        @endif'
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="InputUnitID" class="control-label">Unit</label>
                                                                                    <select id="InputUnitID" class="form-control select2" name="input_unit" required style="width: 100%;" >
                                                                                        <option value="">- Select -</option>
                                                                                        @if(!empty($units))
                                                                                            @foreach($units as $group)
                                                                                                <option value="{{ $group->id }}">{{ $group->full_unit }}</option>
                                                                                            @endforeach'
                                                                                        @endif'
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label class="checkbox checkbox-custom-alt checkbox-custom-lg" style="padding-top: 17px">
                                                                                        <input name="no_cal" class="NoCal" id="NoCal" type="checkbox"><i></i> <strong>No Calculation!</strong>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-8 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="Color" class="control-label">Color</label>
                                                                                    <input type="text" class="form-control" name="color" id="Color" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="Shade" class="control-label">Shade</label>
                                                                                    <input type="text" class="form-control" name="shade" id="Shade" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-2 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="PerConLength" class="control-label">Per Con Length (meter)</label>
                                                                                    <input type="number" id="PerConLength" class="form-control PerConLength" name="per_con_length" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="GQty" class="control-label">Garments Qty</label>
                                                                                    <input type="number" id="GQty" class="form-control GQty" name="garments_order_quantity" step="any">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="Consumption" class="control-label">Consumption</label>
                                                                                    <input type="number" id="Consumption" class="form-control Consumption" name="consumption" step="any">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="Qty" class="control-label">Order Quantity</label>
                                                                                    <input type="number" id="Qty" class="form-control Qty" step="any" name="order_quantity" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-2 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="UnitPrice" class="control-label">Unit Price</label>
                                                                                    <input type="number" id="UnitPrice" class="form-control UnitPrice" step="any" name="unit_price" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="Total" class="control-label">Total Price</label>
                                                                                    <input type="number" step="any" id="Total" class="form-control Total" name="total_price" required readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding: 0px 15px;">
                                                                            <div class="col-md-12 no-padding">
                                                                                <div class="form-group">
                                                                                    <label for="ItemRemarks" class="control-label">Remarks</label>
                                                                                    <input type="text" id="ItemRemarks" class="form-control ItemRemarks" name="item_remarks">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /tile body -->
                                                                </section>
                                                                <!-- /tile -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                    <section class="tile">
                                                        <!-- tile header -->
                                                        <div class="tile-header dvd dvd-btm">
                                                            <h1 class="custom-font"><strong>Item</strong> List</h1>
                                                        </div>
                                                        <!-- /tile header -->
                                                        <!-- tile body -->
                                                        <div class="tile-body">
                                                            @if(!empty($uniqueProducts))
                                                                @foreach($uniqueProducts as $uproduct)
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage{{$uproduct->id}}">
                                                                    <thead>
                                                                    <tr style="background-color: #1693A5; color: white;">
                                                                        <th class="text-center">Color</th>
                                                                        <th class="text-center">Shade</th>
                                                                        <th class="text-center">Per Con Length (meter)</th>
                                                                        <th class="text-center">Garments Quantity</th>
                                                                        <th class="text-center">Consumption</th>
                                                                        <th class="text-center">Order Quantity</th>
                                                                        <th class="text-center">Unit</th>
                                                                        <th class="text-center">Unit Price</th>
                                                                        <th class="text-center">Total Price</th>
                                                                        <th class="text-center">Remarks</th>
                                                                        <th class="text-center">Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <h5 class="text-left"><strong>{{$uproduct->name}}</strong></h5>
                                                                        @foreach($details as $item)
                                                                            @if($item->thread_product_setup_id == $uproduct->id)
                                                                                <tr>
                                                                                    <td class="text-left">{{$item->color}}</td>
                                                                                    <td class="text-left">{{$item->shade}}</td>
                                                                                    <td class="text-left">{{$item->per_con_length}}</td>
                                                                                    <td class="text-left">{{$item->garments_order_quantity}}</td>
                                                                                    <td class="text-left">{{$item->consumption}}</td>
                                                                                    <td class="text-left">{{$item->order_quantity}}</td>
                                                                                    <td class="text-center">{{ (App\Helpers\Helper::IDwiseData('units','id',$item->input_unit_id))->full_unit }}</td>
                                                                                    <td class="text-right">$ {{ $item->unit_price }}</td>
                                                                                    <td class="text-right">$ {{ $item->total_price }}</td>
                                                                                    <td class="text-right">{{$item->remarks}}</td>
                                                                                    <td class="text-center">
                                                                                        {{--                                                                                                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#user{{$item->id}}" data-options="splash-2 splash-ef-12"><i class="fa fa-eye"></i></button>--}}
                                                                                        @if(Auth::user()->hasTaskPermission('updatetditem', Auth::user()->id))
                                                                                            {{--                                                                                                    <a onclick="iconChange()" data-id = "{{ $item->item_count }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>--}}
                                                                                            <a title="Delete" class="DeleteDetail btn btn-danger btn-xs" data-id = "{{ $item->item_count }}"><i class="fa fa-trash"></i></a>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <!-- /tile body -->
                                                    </section>
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

@section('page-modals')  <


@endsection

@section('pageScripts')
    <script>
        $(window).load(function(){
           /* $('#advanced-usage').DataTable({

            });*/

            $('.select2').select2();
            sessionStorage.clear();

        });

        @if(!empty($uniqueProducts))
        @foreach($uniqueProducts as $uproduct)
        $('#advanced-usage{{$uproduct->id}}').on('click',".DeleteDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('thread.booking.detail.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This item will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{item_id: id, _token: '{{csrf_token()}}', purchase_order_master_id: $('#MasterID').val()},
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
        @endforeach
        @endif

        $('#purchase-order').on('click',".UrgentOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('thread.booking.urgent') }}';
            swal({
                title: 'Are you sure?',
                text: 'This booking will be made urgent permanently!',
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

        $('#purchase-order').on('click',".ReviseOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('thread.booking.revise') }}';
            swal({
                title: 'Are you sure?',
                text: 'This booking will be revise permanently!',
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
        $('#purchase-order').on('click',".DeleteOrder", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('thread.booking.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This booking will be removed permanently!',
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
                var id = $('#DetailID').val();
                var masterId = $('#MasterID').val();
                //console.log(masterId);
                //return;
                var url = '{{ route('thread.booking.detail.save') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        console.log(data);
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

        function getProductPrice(_category) {
            //console.log('dada');

            var categoryId = _category.value;
            var supplierId = '{{$purchaseOrder->supplier_id}}';
            var url = '{{ route('thread.product.get-price') }}';
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            if (categoryId) {
                $.ajax({
                    url: url,
                    data: {id: categoryId, supplier: supplierId},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        //console.log(data);
                        document.forms["ItemAddForm"]["unit_price"].value = data.unit_price;
                        document.forms["ItemAddForm"]["per_con_length"].value = data.per_con_length;
                        document.forms["ItemAddForm"]["decimal_count"].value = data.decimal_count;

                    }
                });
            } else {
                document.forms["ItemAddForm"]["unit_price"].value = 0;
                document.forms["ItemAddForm"]["per_con_length"].value = 0;
                document.forms["ItemAddForm"]["decimal_count"].value = 0;
            }
        }

        $('#ItemAdd').delegate('.PerConLength, .GQty, .Consumption, .UnitPrice, .Qty, .Total ','keyup',function(){
            var tr = $(this).parent().parent().parent().parent().parent().parent();
            var decimal_count =  parseInt((parseInt(tr.find('.DecimalCount').val())) + 1);
            var length_per_con = parseFloat(tr.find('.PerConLength').val()).toFixed(12);
            var g_qty = parseFloat(tr.find('.GQty').val()).toFixed(12);
            var consumption = parseFloat(tr.find('.Consumption').val()).toFixed(12);
            var no_cal = '';
            if(document.getElementById('NoCal').checked) {
                no_cal = 'on';
            } else {
                no_cal = '';
            }

            var order_qty = 0;
            if(no_cal == 'on'){
                //console.log(no_cal);
                //tr.find('.Qty').val(order_qty);
            }
            else{
                order_qty = Math.round((g_qty * consumption)/length_per_con);
                tr.find('.Qty').val(order_qty);
            }

            //console.log(decimal_count);
            //return;

            var qty = parseFloat(tr.find('.Qty').val()).toFixed(12);

            //console.log(qty);


            //console.log(gross_qty);
            //return;
            var unit_price = parseFloat(tr.find('.UnitPrice').val()).toFixed(12);
            var total_price = parseFloat(qty * unit_price).toFixed(12);
            //console.log("ConvRate: " + convRate);
            var total_sqm_price_b = (total_price);
            //var num_total_b = total_sqm_price_b.toString();
            //num_total_b = num_total_b.slice(0, (num_total_b.indexOf("."))+ decimal_count); //With 3 exposing the hundredths place
            var num_total_b = total_price;
            if(decimal_count == 2){
                num_total_b = upto2Decimal(num_total_b);
            }
            if(decimal_count == 3){
                num_total_b = upto3Decimal(num_total_b);
            }
            Number(num_total_b); //If you need it back as a Number
            tr.find('.Total').val(num_total_b);

            function upto3Decimal(num) {
                if (num > 0)
                    return Math.floor(num * 1000) / 1000;
                else
                    return Math.ceil(num * 1000) / 1000;
            }

            function upto2Decimal(num) {
                if (num > 0)
                    return Math.floor(num * 100) / 100;
                else
                    return Math.ceil(num * 100) / 100;
            }
        });

        Number.prototype.toMoney = function(decimals, decimal_sep, thousands_sep)
        {
            var n = this,
                c = isNaN(decimals) ? 2 : Math.abs(decimals),
                d = decimal_sep || '.',
                t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                sign = (n < 0) ? '-' : '',
                i = parseInt(n = Math.abs(n).toFixed(c)) + '',
                j = ((j = i.length) > 3) ? j % 3 : 0;
            return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
        };

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {

            $('#iconChange').find('i').addClass('fa-edit');

        }
        $('#purchase-order').on('click',".ResetPO", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.lpd.reset-po') }}';
            swal({
                title: 'Are you sure?',
                text: 'This booking po no will be reset permanently!',
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
    </script>
@endsection()


