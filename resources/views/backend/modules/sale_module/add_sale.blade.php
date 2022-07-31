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
                            {{-- <form onsubmit="add_new_item2(event)" action="" method="get"> --}}
                                {{-- Item Adding Start --}}
                                <div class="row">
                                    {{-- Customer Name --}}
                                    <div class="col-md-2">
                                        <label>{{ __('Customer.CustomerName') }}</label>
                                        <select name="customer_id" class="form-control form-control-sm select2"
                                            id="customer_id">
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
                                        <select name="item_id" class="form-control form-control-sm select2"
                                            id="item_id">
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
                                        <select name="variant_id" class="form-control form-control-sm select2"
                                            id="item_variant">
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
                                    <div class="col-md-3">
                                        <label>{{ __('Warehouse.Warehouse') }}</label>
                                        <select class="form-control form-control-sm select2" name="warehouse_id"
                                            id="warehouse_id">
                                            <option selected disabled>{{ __('Warehouse.Warehouse') }}</option>
                                        </select>
                                    </div>

                                    {{-- Item Weight --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Sale.Beg') }}</label>
                                        <input type="text" class="form-control form-control-sm" name="beg" id="beg">
                                    </div>

                                    {{-- Item Price --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Sale.Price') }}</label>
                                        <input type="text" class="form-control form-control-sm" name="unit_price"
                                            id="unit_price">
                                    </div>

                                    {{-- Total Price --}}
                                    <div class="col-md-3">
                                        <label>{{ __('Sale.TotalPrice') }}</label>
                                        <input type="text" class="form-control form-control-sm" name="total_price"
                                            id="total_price" readonly>
                                    </div>

                                    {{-- Add Button --}}
                                    <div class="col-md-3">
                                        <button class="btn btn-info mt-4 btn-sm" id="add_new_item"><i class="fa fa-plus"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                {{-- Item Adding End --}}
                                <br>
                            {{-- </form> --}}


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
                                    <input type="text" class="form-control form-control-sm" class="previous_balance"
                                        id="previous_balance" readonly>

                                    <label>{{ __('Sale.InTotalAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="intotal_amount"
                                        id="intotal_amount" value="0">

                                    <label>{{ __('Sale.DepositeAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Sale.DueAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Sale.PaymentBy') }}</label>
                                    <select name="payment_by" class="form-control form-control-sm">
                                        <option value="CASH">{{ __('Sale.Cash') }}</option>
                                        <option value="CASH">{{ __('Sale.Bank') }}</option>
                                    </select>

                                    <button class="btn btn-success btn-sm mt-3" id="add_sale">
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

    let added_items = [];

    $(document).ready(function () {
        $('#add_sale').hide();
        // Get Item Varient Data
        $('#item_id').change(function () {
            var item_id = $(this).val();
            var variant_id = $('#item_variant');
            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.item_stock_variant') }}",
                data: {
                    item_id: item_id
                },
                method: 'GET',
                success: function (data) {
                    $('.loading').hide();

                    variant_id.html(
                        '<option value="" selected disabled>Choose Variant</option>');
                    $.each(data, function (index, value) {
                        variant_id.append('<option value = "' + value.variant_id +
                            '_' + value.unit_id + '">' + value.variant_name +
                            '(' + value.unit_name + ')' + '</option>')
                    });
                }
            });
        });

        // Get Avaialble Lots
        $('#item_variant').change(function () {
            const variat_unit_id = $(this).val();
            const item_id = $('#item_id').val();
            var lot_id = $('#lot_id');

            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.available_lots') }}",
                data: {
                    ids: variat_unit_id,
                    item_id: item_id
                },
                method: 'GET',
                success: function (data) {
                    $('.loading').hide();
                    lot_id.html('<option value="" selected disabled>Choose Lot</option>');
                    $.each(data, function (index, value) {
                        lot_id.append('<option value = "' + value.lot_id + '">' +
                            value.lot_name + '(' + value.lot_code + ')' +
                            '</option>')
                    });
                }
            });
        });



        // Get Avaialble Lots
        $('#lot_id').change(function () {
            const variat_unit_id = $('#item_variant').val();
            const item_id = $('#item_id').val();
            const lot_id = $(this).val();

            var warehouse_id = $('#warehouse_id');

            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.get_warehouse_stock') }}",
                data: {
                    ids: variat_unit_id,
                    item_id: item_id,
                    lot_id: lot_id
                },
                method: 'GET',
                success: function (data) {
                    $('.loading').hide();
                    warehouse_id.html(
                        '<option value="" selected disabled>Choose Warehouse</option>');
                    $.each(data, function (index, value) {
                        warehouse_id.append('<option value = "' + value
                            .warehouse_id + '">' + value.warehouse_name + '(' +
                            value.available_stock + ')' + '</option>')
                    });
                }
            });
        });


        // Getting Customer Previous Balance
        $('#customer_id').change(function () {
            const customer_id = $(this).val();
            var previous_balance = $('#previous_balance');

            if (customer_id != 0) {
                $('.loading').show();
                $.ajax({
                    url: "{{ route('sale.customer_previuos_balance') }}",
                    data: {
                        customer_id: customer_id
                    },
                    method: 'GET',
                    success: function (data) {
                        $('.loading').hide();
                        previous_balance.val(data.previous_balance);
                    }
                });
            } else {
                previous_balance.val(0);
            }
        });


        // Total Price Calculation
        $('#unit_price').keyup(function () {
            const beg = $('#beg').val();
            const unit_price = $(this).val();
            if (unit_price != '') {
                const total_price = parseInt(beg) * parseInt(unit_price);
                $('#total_price').val(total_price);
            } else {
                $('#total_price').val(0);
            }

        });

        
        $('#add_new_item').click(function(){

            const customer_id = $('#customer_id').val();
            const item_id = $('#item_id').val();

            const item_variant = $('#item_variant').val();
            let variant_unit = item_variant.split("_");
            const variant_id = variant_unit[0];
            const unit_id = variant_unit[1];
            const lot_id = $('#lot_id').val();
            const warehouse = $('#warehouse_id').val();
            const warehouse_name = $('#warehouse_id').text();
            console.log(warehouse_name);


        });

    });

</script>


@endsection
