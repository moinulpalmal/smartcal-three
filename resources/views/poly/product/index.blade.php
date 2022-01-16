@extends('layouts.admin.admin-master')
@section('title')
    Poly
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
            <h2>Poly <span>Setup</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"> Poly</a>
                    </li>
                    <li>
                        <a href="{{route('poly.product')}}"> Poly Setup</a>
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
                            <h1 class="custom-font"><strong>Poly</strong> Insert/Update Form</h1>
                            <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                        </div>
                        <!-- /tile header -->
                        <!-- tile body -->
                        <div class="tile-body">
                            <input type="hidden" id="HiddenFactoryID" name="id">
                            <div class="row" style="padding: 0px 15px;">
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="FactoryName" class="control-label">Select Poly Type</label>
                                        <select id="FactoryName" class="form-control select2" name="poly_type" required style="width: 100%;">
                                            <option value="" selected ="selected">- - - Select - - -</option>
                                            <option value="APC" >Adhesive Poly (Common)</option>
                                            <option value="APH&M">Adhesive Poly (H&M)</option>
                                            <option value="APR" >Adhesive Poly (Recycled)</option>
                                            <option value="GP">General Poly</option>
                                            <option value="H&MG">H&M Gusset Poly</option>
                                            <option value="H&MB">H&M Band Poly</option>
                                            <option value="LP">LBS Poly</option>
                                            <option value="NPP">Non Printed Poly</option>
                                            <option value="PP">Perforated Poly</option>
                                            <option value="SP">Special Poly</option>
                                            <option value="ZWP">Zip & Wash Poly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9 no-padding">
                                    <div class="form-group">
                                        <label for="FullUnit" class="control-label">Product Name</label>
                                        <input type="text" class="form-control" name="name" id="FullUnit" placeholder="Enter full unit" required="">
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
                        <h1 class="custom-font"><strong>Product</strong> List</h1>
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
                                    <th class="text-center">Poly Type</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($products as $item)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-left">
                                            @if($item->poly_type == 'APC')
                                                Adhesive Poly (Common)
                                            @elseif($item->poly_type == 'APH&M')
                                                Adhesive Poly (H&M)
                                            @elseif($item->poly_type == 'APR')
                                                Adhesive Poly (Recycled)
                                            @elseif($item->poly_type == 'GP')
                                                General Poly
                                            @elseif($item->poly_type == 'H&MG')
                                                H&M Gusset Poly
                                            @elseif($item->poly_type == 'H&MB')
                                                H&M Band Poly
                                            @elseif($item->poly_type == 'LP')
                                                LBS Poly
                                            @elseif($item->poly_type == 'NPP')
                                                Non Printed Poly
                                            @elseif($item->poly_type == 'PP')
                                                Perforated Poly
                                            @elseif($item->poly_type == 'SP')
                                                Special Poly
                                            @elseif($item->poly_type == 'ZWP')
                                                Zip & Wash Poly
                                                @else

                                            @endif

                                        </td>
                                        <td class="text-left">{{$item->name}}</td>
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
                                            <a title="Detail Setup" class="btn btn-info btn-xs" href="{{route('poly.product.detail', ['id' => $item->id])}}"><i class="fa fa-eye"></i></a>

                                            <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                            @if($item->status == 'I')
                                                <a title="Activate" class="ActivateBuyer btn btn-success btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-up"></i></a>
                                            @else
                                                @if($item->status == 'A')
                                                    <a title="De-Activate" class="DeActivateBuyer btn btn-warning btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-arrow-circle-down"></i></a>
                                                    {{--                                                    <a title="Block" class="BlockActivateBuyer btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-times"></i></a>--}}
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
                                <tfoot>
                                <tr >
                                    <td class="text-center">Sl No.</td>
                                    <td class="text-center">Name</td>
                                    <td class="text-center">Per Con Length (meter)</td>
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

       $('.select2').select2();

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
                var url = '{{ route('poly.product.save') }}';
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
            var url = '{{ route('poly.product.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=id]').val(data.id);
                    //$('input[name=per_con_length]').val(data.per_con_length);
                    $("#FactoryName option[value = '" + data.poly_type + "']").attr('selected', 'selected').change();

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


