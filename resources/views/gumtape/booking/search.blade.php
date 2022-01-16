@extends('layouts.admin.admin-master')
@section('title')
    Gum Tape
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
    <div class="page page-dashboard">
        <div class="pageheader">
            <h2>Gum Tape <span>Booking</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"> Gum Tape</a>
                    </li>
                    <li>
                        <a href="{{route('gumtape.booking.search')}}"> Booking Search</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <!-- col -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- tile -->
                <form method="post" id="UserCreatForm" name="UserCreatForm" action="{{route('gumtape.booking.search-booking')}}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <section class="tile">
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Search </strong> Booking</h1>
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
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="BuyerPO" class="control-label">LPD PO No</label>
                                        <input id="BuyerPO" type="text" class="form-control @error('lpd_po_no') is-invalid @enderror" name="lpd_po_no" value="{{ old('lpd_po_no') }}">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="EmployeeJoiningDate" class="control-label">From Booking Date</label>
                                        <input id="EmployeeJoiningDate" type="date" class="form-control @error('from_date') is-invalid @enderror" name="from_date" value="{{ old('from_date', $currentDate) }}" >
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="EmployeeDDate" class="control-label">To Booking Date</label>
                                        <input id="EmployeeDDate" type="date" class="form-control @error('to_date') is-invalid @enderror" name="to_date" value="{{ old('to_date', $currentDate) }}">
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryName" class="control-label">Select Supplier</label>
                                        <select id="FactoryName" class="form-control select2 @error('supplier') is-invalid @enderror" name="supplier" style="width: 100%;">
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

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }
    </script>
@endsection()



