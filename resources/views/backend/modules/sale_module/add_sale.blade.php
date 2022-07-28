@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                {{ __('Application.Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('sale.index') }}">
                                {{ __('Sale.AllSale') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                {{ __('Sale.AddNewSale') }}
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-header">
                            <h6>{{ __('Sale.AddNewSale') }}</h6>
                        </div>
                        <div class="card-body">

                            {{-- Item Adding Start --}}
                            <div class="row">
                                {{-- Customer Name --}}
                                <div class="col-md-2">
                                    <label>{{ __('Customer.CustomerName') }}</label>
                                    <select name="customer_id" class="form-control form-control-sm select2">
                                        <option value="0">{{ __('Customer.GuestCustomer') }}</option>
                                        @forelse ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                {{-- Item Name --}}
                                <div class="col-md-2">
                                    <label>{{ __('Item.Item') }}</label>
                                    <select name="item_id" class="form-control form-control-sm select2" id="item_id">
                                        <option selected disabled>{{ __('Item.SelectItem') }}</option>
                                        @forelse ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>

                                {{-- Item Varient --}}
                                <div class="col-md-2">
                                    <label>{{ __('Item.ItemVariant') }}</label>
                                    <select name="variant_id" class="form-control form-control-sm select2" id="item_variant">
                                        <option selected disabled>{{ __('variant.SelectVarient') }}</option>
                                    </select>
                                </div>

                                {{-- Lot --}}
                                <div class="col-md-3">
                                    <label>{{ __('Lot.Lot') }}</label>
                                    <select class="form-control form-control-sm select2" name="lot_id" id="lot_id">
                                        <option selected disabled>{{ __('Lot.Lot') }}</option>
                                    </select>
                                </div>

                                {{-- Warehouse --}}
                                <div class="col-md-2">
                                    <label>{{ __('Warehouse.Warehouse') }}</label>
                                    <select class="form-control form-control-sm select2" name="warehouse_id" id="warehouse_id">
                                        <option selected disabled>{{ __('Warehouse.Warehouse') }}</option>
                                    </select>
                                </div>

                                {{-- Item Weight --}}
                                <div class="col-md-3">
                                    <label>{{ __('Sale.Beg') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="beg">
                                </div>

                                {{-- Item Price --}}
                                <div class="col-md-3">
                                    <label>{{ __('Sale.Price') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="unit_price">
                                </div>

                                {{-- Total Price --}}
                                <div class="col-md-3">
                                    <label>{{ __('Sale.TotalPrice') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="total_price">
                                </div>

                                {{-- Add Button --}}
                                <div class="col-md-3">
                                    <button class="btn btn-info mt-4 btn-sm">{{ __('Application.Add') }}</button>
                                </div>
                            </div>
                            {{-- Item Adding End --}}
                            <br>

                            <div class="row">
                                {{-- Added Item List Start --}}
                                <div class="col-md-9 bg card">
                                    <span style="margin-top: 8px;"></span>
                                    <table width="100%" class="table table-sm table-bordered">
                                        <thead>
                                            <th>{{ __('Application.SerialNo') }}</th>
                                            <th>{{ __('Item.Item') }}</th>
                                            <th>{{ __('Sale.Beg') }}</th>
                                            <th>{{ __('Sale.Weight') }}</th>
                                            <th>{{ __('Sale.Price') }}</th>
                                            <th>{{ __('Sale.TotalPrice') }}</th>
                                            <th>{{ __('Application.Delete') }}</th>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>১</td>
                                                <td>মিনিকেট</td>
                                                <td>৫</td>
                                                <td>২৫</td>
                                                <td>১৯০০</td>
                                                <td>৯৫০০</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">X</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>১</td>
                                                <td>মিনিকেট</td>
                                                <td>৫</td>
                                                <td>২৫</td>
                                                <td>১৯০০</td>
                                                <td>৯৫০০</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">X</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>১</td>
                                                <td>মিনিকেট</td>
                                                <td>৫</td>
                                                <td>২৫</td>
                                                <td>১৯০০</td>
                                                <td>৯৫০০</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- Added Item List End --}}

                                {{-- Sub Total Information Start --}}
                                <div class="col-md-3 bg card">
                                    <span style="margin-top: 8px;"></span>

                                    <label>{{ __('Sale.TotalPrice') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Sale.PreviousBalance') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Sale.InTotalAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Sale.DepositeAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Sale.DueAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Sale.PaymentBy') }}</label>
                                    <select name="payment_by" class="form-control form-control-sm">
                                        <option value="CASH">{{ __('Sale.Cash') }}</option>
                                        <option value="CASH">{{ __('Sale.Bank') }}</option>
                                    </select>

                                    <button class="btn btn-success btn-sm mt-3 ">
                                        {{ __('Application.Add') }}
                                    </button>

                                    <span style="margin-bottom: 8px;"></span>
                                </div>
                                {{-- Sub Total Information End --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

{{-- Lot Add Modal Start --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Lot.AddNewLot') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="ajax-form" method="post" action="{{ route('lot.store') }}">
                    @csrf

                    <div class="row">

                        <!-- name -->
                        <div class="col-md-12 col-12 form-group">
                            <label for="name">{{ __('Lot.LotName') }}</label><span class="require-span">*</span>
                            <input type="text" class="form-control" name="lot_name" required>
                        </div>

                        <div class="col-md-12 form-group text-right">
                            <button type="submit" class="btn btn-outline-dark">
                                {{ __('Application.Add') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Application.Close') }}</button>
            </div>

        </div>
    </div>
</div>
{{-- Lot Add Modal End --}}

@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>
<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    });
</script>


<script>
    $(document).ready(function(){
        // Get Item Varient Data
        $('#item_id').change(function () {
            var item_id = $(this).val();
            var variant_id = $('#item_variant');
            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.item_stock_variant') }}",
                data:{
                    item_id: item_id
                },
                method: 'GET',
                success: function(data){
                    $('.loading').hide();

                    variant_id.html('<option value="" selected disabled>Choose Variant</option>');
                    $.each(data, function(index, value){
                        variant_id.append('<option value = "'+ value.variant_id +'_'+ value.unit_id +'">'+ value.variant_name +'('+ value.unit_name +')' +'</option>')
                    });
                }
            });
        });

        // Get Avaialble Lots
        $('#item_variant').change(function(){
            const variat_unit_id = $(this).val();
            const item_id = $('#item_id').val();
            var lot_id = $('#lot_id');

            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.available_lots') }}",
                data:{
                    ids: variat_unit_id,
                    item_id : item_id
                },
                method: 'GET',
                success: function(data){
                    $('.loading').hide();
                    lot_id.html('<option value="" selected disabled>Choose Lot</option>');
                    $.each(data, function(index, value){
                        lot_id.append('<option value = "'+ value.lot_id +'">'+ value.lot_name +'('+ value.lot_code +')' +'</option>')
                    });
                }
            });
        });



        // Get Avaialble Lots
        $('#lot_id').change(function(){
            const variat_unit_id = $('#item_variant').val();
            const item_id = $('#item_id').val();
            const lot_id = $(this).val();

            var warehouse_id = $('#warehouse_id');

            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.get_warehouse_stock') }}",
                data:{
                    ids: variat_unit_id,
                    item_id : item_id,
                    lot_id : lot_id
                },
                method: 'GET',
                success: function(data){
                    $('.loading').hide();
                    warehouse_id.html('<option value="" selected disabled>Choose Warehouse</option>');
                    $.each(data, function(index, value){
                        warehouse_id.append('<option value = "'+ value.warehouse_id +'">'+ value.warehouse_name +'('+ value.available_stock +')' +'</option>')
                    });
                }
            });
        });




    });
</script>



{{-- Lot Functions --}}
<script>
    $(document).ready(function(){
        $('#lot_id').change(function(){
            const lot = $(this).val();
            // Getting Item for Selected Lot
            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.lot_items') }}",
                data:{
                    lot_id : lot
                },
                method: 'GET',
                success: function(data){
                    $('.loading').hide();
                    console.log(data);
                }
            });
        });
    });
</script>

@endsection
