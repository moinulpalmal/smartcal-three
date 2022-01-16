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
        tfoot input {
            width: 100%;
            padding: 1px;
            box-sizing: border-box;
        }
    </style>
    <div class="page page-profile">
        <div class="pageheader">
            <h2>Arrow Sticker <span>// Detail</span></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"> Arrow Sticker</a>
                    </li>
                    <li>
                        <a href="{{route('asticker.product')}}"> Product Setup</a>
                    </li>
                    <li>
                        <a href="{{route('asticker.product.detail', ['id' => $product->id])}}"> {{$product->name}}</a>
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
                            <h5 class="mb-0"><strong>{{$product->name}}</strong></h5>
{{--                            <span class="text-muted">{{$unit->short_unit}}</span>--}}
                        </div>
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
                                    <li role="presentation" class="active"><a href="#itemList" aria-controls="itemList" role="tab" data-toggle="tab">Price Setup</a></li>
                                </ul>
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
                                                                <h1 class="custom-font"><strong>Price Setup</strong> Insert/Update Form</h1>
                                                                <a><button id="iconChange" class="pull-right btn-info btn-xs" type="submit"><i class="fa fa-check"></i></button></a>
                                                            </div>
                                                            <!-- /tile header -->
                                                            <!-- tile body -->
                                                            <div class="tile-body">
                                                                <div class="row" style="padding: 0px 15px;">
                                                                    <input type="hidden" id="PSetupID" name="a_sticker_product_setup_id" value="{{old('a_sticker_product_setup_id', $product->id)}}">
                                                                    <input type="hidden" id="ID" name="id" value="{{old('id')}}">
                                                                    <div class="col-md-6 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="RoleID" class="control-label">Supplier Name</label>
                                                                            <select class="form-control select2" name="supplier"  id="RoleID" style="width: 100%;" required>
                                                                                <option value="" selected="selected">- - - Select - - -</option>
                                                                                @if(!empty($supplierByGroup))
                                                                                    @foreach($supplierByGroup as $type)
                                                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 no-padding">
                                                                        <div class="form-group">
                                                                            <label for="UnitPrice" class="control-label">Per Lac Unit Price (USD)</label>
                                                                            <input type="number" step="any" class="form-control" name="unit_price" id="UnitPrice" required="">
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
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                        <section class="tile">
                                                            <!-- tile header -->
                                                            <div class="tile-header dvd dvd-btm">
                                                                <h1 class="custom-font"><strong>Supplier Wise</strong> Price List</h1>
                                                                </div>
                                                            <!-- /tile header -->
                                                            <!-- tile body -->
                                                            <div class="tile-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-bordered table-condensed table-responsive" id="advanced-usage">
                                                                        <thead>
                                                                        <tr style="background-color: #1693A5; color: white;">
                                                                            <th class="text-center">Sl No.</th>
                                                                            <th class="text-center">Supplier Name</th>
{{--                                                                            <th class="text-center">Color + Sl. No</th>--}}
                                                                            <th class="text-center">Per Lac Unit Price</th>
                                                                            <th class="text-center">Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @php($i = 1)
                                                                            @foreach($productPriceSetups as $item)
                                                                                <tr>
                                                                                    <td class="text-center">{{$i++}}</td>
                                                                                    <td class="text-left">{{(App\Helpers\Helper::IDwiseData('suppliers','id',$item->supplier_id))->name}}</td>
{{--                                                                                    <td class="text-left">{{$item->article_no}}</td>--}}
                                                                                    <td class="text-right">$ {{$item->unit_price}}</td>
                                                                                    <td class="text-center">
{{--                                                                                        <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>--}}
                                                                                        <a title="Delete" class="DeleteDetail btn btn-danger btn-xs" data-id = "{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            <!-- /tile body -->
                                                            </div>
                                                        </section>
                                                        <!-- /tile -->
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

@endsection

@section('pageScripts')
    <script>
        $(window).load(function(){
            $('#advanced-usage').DataTable({
                "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]]
            });

            $('.select2').select2();
            //sessionStorage.clear();
        });

        function refresh()
        {
            window.location.href = window.location.href.replace(/#.*$/, '');
        }

        function iconChange() {
            $('#iconChange').find('i').addClass('fa-edit');
        }

        //product.get-article-list

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ItemAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                //console.log(data);
                //return;

                var id = $('#ConvID').val();
                //var masterId = $('#MasterID').val();
                //console.log(masterId);
                //return;
                var url = '{{ route('asticker.product.save-price-setup') }}';
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


        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);
            var FactoryID = button.attr("data-id");
            //$('body').animate({scrollTop:0}, 400);
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            var url = '{{ route('asticker.product.edit-price-setup') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=a_sticker_product_setup_id]').val(data.a_sticker_product_setup_id);
                    $('input[name=article_no]').val(data.article_no);
                    //$('input[name=supplier]').val(data.supplier_id);
                    $("#RoleID option[value = '" + data.supplier + "']").attr('selected', 'selected').change();

                    $('input[name=unit_price]').val(data.unit_price);
                    $('input[name=id]').val(data.id);
                    // $('input[name=gross_form_factor]').val(data.gross_form_factor);

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

        $('#advanced-usage').on('click',".DeleteDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('asticker.product.delete-price-setup') }}';
            swal({
                title: 'Are you sure?',
                text: 'This price setup will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{item_id: id, _token: '{{csrf_token()}}'},
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


