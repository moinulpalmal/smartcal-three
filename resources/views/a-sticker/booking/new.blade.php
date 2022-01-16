@extends('layouts.admin.admin-master')
@section('title')
    Arrow Sticker
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
    </style>
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>Arrow Sticker <span>New Booking</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"> Arrow Sticker</a>
                    </li>
                    <li>
                        <a href="{{route('asticker.booking.new')}}"> New Booking</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="UserCreatForm" name="UserCreatForm" action="{{route('asticker.booking.save')}}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Create </strong>New Booking</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
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
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="EmployeeJoiningDate" class="control-label">Booking Date</label>
                                                <input id="EmployeeJoiningDate" type="date" class="form-control @error('booking_date') is-invalid @enderror" name="booking_date" value="{{ old('booking_date') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="EmployeeDDate" class="control-label">Delivery Date</label>
                                                <input id="EmployeeDDate" type="date" class="form-control @error('delivery_date') is-invalid @enderror" name="delivery_date" value="{{ old('delivery_date') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="FactoryName" class="control-label">Select Supplier</label>
                                                <select id="FactoryName" class="form-control select2 @error('supplier') is-invalid @enderror" name="supplier" required style="width: 100%;">
                                                    <option value="" selected ="selected">- - - Select - - -</option>
                                                    @if(!empty($suppliers))
                                                        @foreach($suppliers as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 0px 15px;">
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="DepartmentName" class="control-label">Select Delivery Location</label>
                                                <select id="DepartmentName" class="form-control select2 @error('delivery_location') is-invalid @enderror" name="delivery_location" required style="width: 100%;" onchange="javascript:getConvUnitList(this)">
                                                    <option value="" selected ="selected">- - - Select - - -</option>
                                                    @if(!empty($deliveryLocations))
                                                        @foreach($deliveryLocations as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="ContactPerson" class="control-label">Select Contact Person Info</label>
                                                <select id="ContactPerson" class="form-control select2 @error('delivery_location_detail_id') is-invalid @enderror" name="delivery_location_detail_id" required style="width: 100%;">
                                                    <option value="" selected ="selected">- - - Select - - -</option>
                                                    {{-- @if(!empty($deliveryLocations))
                                                         @foreach($deliveryLocations as $item)
                                                             <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                         @endforeach
                                                     @endif--}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group">
                                                <label for="BuyerName" class="control-label">Select Buyer</label>
                                                <select id="BuyerName" class="form-control select2 @error('buyer') is-invalid @enderror" name="buyer" required style="width: 100%;">
                                                    <option value="" selected ="selected">- - - Select - - -</option>
                                                    @if(!empty($buyers))
                                                        @foreach($buyers as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row" style="padding: 0px 15px;">
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="BuyerPO" class="control-label">Buyer PO No</label>
                                            <input id="BuyerPO" type="text" class="form-control @error('buyer_po_no') is-invalid @enderror" name="buyer_po_no" value="{{ old('buyer_po_no') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="Styles" class="control-label">Styles</label>
                                            <input id="Styles" type="text" maxlength="5000" class="form-control @error('style') is-invalid @enderror" name="style" value="{{ old('style') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="Consumption" class="control-label">Consumption / DZ / INCH/ PCS</label>
                                            <input id="Consumption" type="text" class="form-control @error('consumption_per_dz') is-invalid @enderror" name="consumption_per_dz" value="{{ old('consumption_per_dz') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group">
                                            <label for="GarmentsQty" class="control-label">Garments Quantity</label>
                                            <input id="GarmentsQty" type="number" min="1" class="form-control @error('garments_quantity') is-invalid @enderror" name="garments_quantity" value="{{ old('garments_quantity') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding: 0px 15px;">
                                    {{--<div class="col-md-6 no-padding">
                                        <div class="form-group">
                                            <label for="Description" class="control-label">Description</label>
                                            <input id="Description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
                                        </div>
                                    </div>--}}
                                    <div class="col-md-12 no-padding">
                                        <div class="form-group">
                                            <label for="Remarks" class="control-label">Special Remarks</label>
                                            <input id="Remarks" type="text" class="form-control @error('remarks') is-invalid @enderror" name="remarks" value="{{ old('remarks') }}">
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
        </div>
        <!-- /row -->
    </div>
@endsection

@section('page-modals')

@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    <script>
        $('.select2').select2();
        //$('.ddlDepartment').select2();
        function getConvUnitList(_category) {
            var categoryId = _category.value;

            var url = '{{ route('admin.delivery-location.get-contact-list') }}';
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            if (categoryId) {
                $.ajax({
                    url: url,
                    data: {delivery_location_id: categoryId},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        //document.forms["ItemAddForm"]["unit_per_square_meter_price"].value = data.unit_per_square_meter_price;
                        //document.forms["ItemAddForm"]["is_board"].value = data.is_board;
                        defaultKey = " ";
                        defaultValue = "- - - Select - - -";
                        $('select[id= "ContactPerson"]').empty();

                        $('select[id= "ContactPerson"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                        $.each(data, function(key,value){
                            //console.log(data);
                            $('select[id= "ContactPerson"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        //$('#YarnCountName').trigger('chosen:updated');
                        $('.select2').select2();
                        //document.forms["ItemAddForm"]["unit_conversion_rate"].value = "";
                    }
                });
            } else {
                //document.forms["ItemAddForm"]["unit_per_square_meter_price"].value = 0;
                //document.forms["ItemAddForm"]["is_board"].value = 0;
                defaultKey = " ";
                defaultValue = "- - - Select - - -";

                $('select[id= "ContactPerson"]').empty();
                $('select[id= "ContactPerson"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                $('.select2').select2();
                //document.forms["ItemAddForm"]["unit_conversion_rate"].value = "";
            }
        }
    </script>
@endsection()


