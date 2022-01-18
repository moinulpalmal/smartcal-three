@extends('layouts.admin.admin-master')
@section('title')
    Carton & Board
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
            <h2>Carton & Board <span>Setup</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"> Carton & Board</a>
                    </li>
                    <li>
                        <a href="{{route('cartoon.booking.search')}}"> Search Bookings</a>
                    </li>
                </ul>
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
                        <h1 class="custom-font"><strong>Carton & Board</strong> Booking List</h1>
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
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                <thead>
                                <tr style="background-color: #1693A5; color: white;">
                                    <th class="text-center">Sl No.</th>
                                    <th class="text-center">LPD PO NO</th>
                                    <th class="text-center">PO Date</th>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Buyer</th>
                                    <th class="text-center">Delivery Location</th>
                                    <th class="text-center">Delivery Date</th>
                                    <th class="text-center">TNA Start Date</th>
                                    <th class="text-center">TNA End Date</th>
                                    <th class="text-center">Delivery Complete Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($purchaseOrders as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-center">{{$item->lpd_po_no}}</td>
                                        <td class="text-center"> {{\Carbon\Carbon::parse($item->lpd_po_date)->format('d/m/Y')}}</td>
                                        <td class="text-left">{{(App\Helpers\Helper::IDwiseData('suppliers','id',$item->supplier_id))->name}}</td>
                                        <td class="text-left">{{(App\Helpers\Helper::IDwiseData('buyers','id',$item->buyer_id))->name}}</td>
                                        <td class="text-left">{{(App\Helpers\Helper::IDwiseData('delivery_locations','id',$item->delivery_location_id))->name}}</td>
                                        <td class="text-center"> {{\Carbon\Carbon::parse($item->delivery_date)->format('d/m/Y')}}</td>
                                        <td class="text-center">
                                            @if($item->tna_start_date != null)
                                                {{ \Carbon\Carbon::parse($item->tna_start_date)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->tna_end_date != null)
                                                {{ \Carbon\Carbon::parse($item->tna_end_date)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($item->delivery_complete_date != null)
                                                {{ \Carbon\Carbon::parse($item->delivery_complete_date)->format('d/m/Y') }}
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
                                           @elseif($item->status == 'DC')
                                                <span class="label label-info">Delivery Complete</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Detail" class="btn btn-info btn-xs" href="{{route('cartoon.booking.detail', ['id' => $item->id])}}"><i class="fa fa-eye"></i></a>


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr >
                                    <td class="text-center">Sl No.</td>
                                    <td class="text-center">LPD PO NO</td>
                                    <td class="text-center">PO Date</td>
                                    <td class="text-center">Supplier</td>
                                    <td class="text-center">Buyer</td>
                                    <td class="text-center">Delivery Location</td>
                                    <td class="text-center">Delivery Date</td>
                                    <td class="text-center">TNA Start Date</td>
                                    <td class="text-center">TNA End Date</td>
                                    <td class="text-center">Delivery Complete Date</td>
                                    <td class="text-center">Status</td>
                                    <td class="text-center">Action</td>
                                </tr>
                                </tfoot>
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

@endsection
@section('pageVendorScripts')

@endsection
@section('pageScripts')
    <script>
        /* $(window).load(function(){
             $('#advanced-usage').DataTable({
                 "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]]
             });
         });*/

        $(window).load(function(){
            $(document).ready(function() {
                // Setup - add a text input to each footer cell
                $('#advanced-usage tfoot td').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );

                // DataTable
                var table = $('#advanced-usage').DataTable({

                    initComplete: function () {
                        // Apply the search

                        this.api().columns().every( function () {
                            var that = this;
                            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );
                    }
                });

            } );
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#FactoryAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                //console.log(data);
                var url = '{{ route('cartoon.product.save') }}';
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
                            console.log(data);
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
            var url = '{{ route('cartoon.product.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=id]').val(data.id);
                    if (data.is_board == 1)
                    {
                        $('input[name=IsBoard]').prop('checked', true);
                    }
                    else if (data.is_board == 0)
                    {
                        $('input[name=IsBoard]').prop('checked', false);
                    }
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


        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');

        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }
    </script>
@endsection()




