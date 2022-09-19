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
                            <form onsubmit="add_new_item(event)" action="" method="get">
                                {{-- Item Adding Start --}}
                                <div class="row">

                                    <!-- date -->
                                    <div class="col-md-2">
                                        <label for="date">{{ __('Application.Date') }}</label>
                                        <input type="date" value="<?php echo date('Y-m-d') ?>" class="form-control" name="date" id="date" required>
                                    </div>

                                    {{-- Customer Name --}}
                                    <div class="col-md-2">
                                        <label>{{ __('Customer.CustomerName') }}</label>
                                        <select required name="customer_id" class="form-control form-control-sm select2"
                                            id="customer_id">
                                            <option value="">{{ __('Customer.GuestCustomer') }}</option>
                                            @forelse ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Item Name --}}
                                    <div class="col-md-2">
                                        <label>{{ __('Item.Item') }}</label>
                                        <select required name="item_id" class="form-control form-control-sm select2"
                                            id="item_id">
                                            <option value="" selected disabled>{{ __('Item.SelectItem') }}</option>
                                            @forelse ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>

                                    {{-- Item Varient --}}
                                    <div class="col-md-2">
                                        <label>{{ __('Item.ItemVariant') }}</label>
                                        <select required name="variant_id" class="form-control form-control-sm select2"
                                            id="item_variant_unit">
                                            <option value="" selected disabled>{{ __('variant.SelectVarient') }}</option>
                                        </select>
                                    </div>

                                    {{-- Lot --}}
                                    <div class="col-md-2">
                                        <label>{{ __('Lot.Lot') }}</label>
                                        <select required class="form-control form-control-sm select2" name="lot_id" id="lot_id">
                                            <option value="" selected disabled>{{ __('Lot.Lot') }}</option>
                                        </select>
                                    </div>

                                    {{-- Warehouse --}}
                                    <div class="col-md-2">
                                        <label>{{ __('Warehouse.Warehouse') }}</label>
                                        <select class="form-control form-control-sm select2" name="warehouse_id"
                                            id="warehouse_id">
                                            <option selected disabled>{{ __('Warehouse.Warehouse') }}</option>
                                        </select>
                                    </div>

                                    {{-- Item Weight --}}
                                    <div class="col-md-1">
                                        <label>{{ __('Sale.Beg') }}</label>
                                        <input required type="number" class="form-control form-control-sm" name="beg" id="beg">
                                    </div>

                                    {{-- Item Price --}}
                                    <div class="col-md-1">
                                        <label>{{ __('Sale.Price') }}</label>
                                        <input required type="text" class="form-control form-control-sm" name="unit_price"
                                            id="unit_price">
                                    </div>

                                    {{-- Total Price --}}
                                    <div class="col-md-2">
                                        <div class="row">
                                            <div class="col-10">
                                                 <label>{{ __('Sale.TotalPrice') }}</label>
                                                <input required type="text" class="form-control form-control-sm" name="total_price"
                                            id="total_price" readonly>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-info mt-4 btn-sm" ><i class="fa fa-plus"
                                                aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Add Button --}}
                                    {{-- <div class="col-md-2">

                                    </div> --}}
                                </div>
                                {{-- Item Adding End --}}
                                <br>
                            </form>


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

                                        <tbody id="added_items_list"></tbody>

                                        {{-- <tbody>
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
                                        </tbody> --}}
                                    </table>
                                </div>
                                {{-- Added Item List End --}}

                                {{-- Sub Total Information Start --}}
                                <div class="col-md-3 bg card">
                                    <span style="margin-top: 8px;"></span>

                                    <label>{{ __('Sale.TotalPrice') }}</label>
                                    <input id="sale_total_price" type="text" value="0" class="form-control form-control-sm">

                                    <label>{{ __('Sale.PreviousBalance') }}</label>
                                    <input type="text" class="form-control form-control-sm" class="previous_balance" value="0"
                                        id="previous_balance" readonly>

                                    <label>{{ __('Sale.InTotalAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="intotal_amount"
                                        id="intotal_amount" value="0" readonly>

                                    <label>{{ __('Sale.DepositeAmount') }}</label>
                                    <input id="sale_deposite_amount" type="text" onkeyup="due_amount_calculation()" value="0" class="form-control form-control-sm">

                                    <label>{{ __('Sale.DueAmount') }}</label>
                                    <input type="text" id="sale_due_amount" value="0" class="form-control form-control-sm">

                                    <label>{{ __('Sale.PaymentBy') }}</label>
                                    <select name="payment_by" id="sale_payment_by" class="form-control form-control-sm">
                                        <option value="CASH">{{ __('Sale.Cash') }}</option>
                                        <option value="BANK">{{ __('Sale.Bank') }}</option>
                                    </select>

                                    {{-- Bank Information --}}
                                    <div id="bank_div" class="d-none">
                                        <label>{{ __('Bank.BankName') }}</label>
                                        <select name="bank_id" class="form-control form-control-sm" id="bank_id">
                                            <option value="" selected disabled>{{ __('Bank.SelectBank') }}</option>
                                            @forelse ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @empty
                                                <option value="">No Banks Found</option>
                                            @endforelse
                                        </select>

                                        <label> {{ __('Bank.ChequeNo') }} </label>
                                        <input type="text" name="cheque_no" class="form-control form-control-sm" id="cheque_no">
                                    </div>

                                    <form onsubmit="submit_sale(event)" id="sale_store_form" action="{{ route("sale.store") }}" method="post">
                                        @csrf

                                        <input type="hidden" name="data" id="sale_data">
                                        <button class="btn btn-success btn-block mt-3 " id="add_sale" disabled>
                                            {{ __('Application.Add') }}
                                        </button>
                                    </form>

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
    const items = {!! json_encode($items) !!};
    const variants = {!! json_encode($variants) !!};
    const units = {!! json_encode($units) !!};

    $(document).ready(function () {
        // Get Item Varient Data
        $('#item_id').change(function () {
            var item_id = $(this).val();
            var variant_id = $('#item_variant_unit');
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
        $('#item_variant_unit').change(function () {
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
            const variat_unit_id = $('#item_variant_unit').val();
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
                    warehouse_id.html('<option value="" selected disabled>Choose Warehouse</option>');

                    $.each(data, function (index, value) {
                        warehouse_id.append(`<option value ="${value.warehouse_id}_${value.available_stock}"> ${value.warehouse_name} ( ${value.available_stock} )</option>`)
                    });
                }
            });
        });


        $("#warehouse_id").change(function(){
            const val = $(this).val();
            const val_arr = val.split("_");

            $("#beg").attr('max', val_arr[1]);
            $("#beg").attr('min', "1");
        })


        // Getting Customer Previous Balance
        $('#customer_id').change(function () {
            const customer_id = $(this).val();
            const previous_balance = $('#previous_balance');

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

        $('#sale_payment_by').change(function(){

            $('#bank_id').val('');
            $('#cheque_no').val('');

            if($(this).val() == 'BANK'){
                $('#bank_div').removeClass('d-none');
            } else {
                $('#bank_div').addClass('d-none');
            }
        });

    });


    function add_new_item(event) {
        event.preventDefault();

        const warehouse = $('#warehouse_id').val();
        const warehouse_arr = warehouse.split("_");

        const split_varient_unit = $("#item_variant_unit").val().split("_");
        const item_id = $("#item_id").val();
        const item_varient = split_varient_unit[0];
        const item_unit = split_varient_unit[1];
        const lot_id = $("#lot_id").val();
        const beg = $("#beg").val();
        const warehouse_id = warehouse_arr[0];
        const warehouse_stock_qty = warehouse_arr[1];
        const unit_price = $("#unit_price").val();
        const total_price = $("#total_price").val();

        const variant_name = variants.find(e => e.id == item_varient).name;
        const unit_name = units.find(e => e.id == item_unit).name;


        const find_index = added_items.findIndex(item => item.item_id == item_id && item.item_varient_id == item_varient && item.item_unit_id == item_unit && item.lot_id == lot_id && item.warehouse_id == warehouse_id && item.unit_price == unit_price);

        if (find_index >= 0 && added_items[find_index]) {

            const qty = parseFloat(added_items[find_index].beg) + parseFloat(beg);

            if (qty < parseFloat(added_items[find_index].warehouse_stock_qty)) {
                added_items[find_index].beg = qty
            } else{
                alert("stock not available")
                return false;
            }

        } else {
            const item_obj = {
                "item_id": item_id,
                "item_varient_id": item_varient,
                "item_varient_name": variant_name,
                "item_unit_id": item_unit,
                "item_unit_name": unit_name,
                "lot_id": lot_id,
                "warehouse_id" : warehouse_id,
                "warehouse_stock_qty" : warehouse_stock_qty,
                "beg": beg,
                "unit_price": unit_price,
                "total_price": total_price,
            }
            added_items.push(item_obj)
        }

        show_items()
    }

    function show_items() {
        $("#added_items_list").html('');
        $("#add_sale").attr('disabled', added_items.length > 0 ? false : true);
        let total_amount = 0;

        added_items.forEach((element, index) => {
            total_amount += parseFloat(element.total_price);

            const item_name = items.find(e => e.id == element.item_id).name;

            $("#added_items_list").append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${item_name}</td>
                    <td>${element.beg}</td>
                    <td>${element.item_varient_name} ${element.item_unit_name}</td>
                    <td>${element.unit_price}</td>
                    <td>${element.total_price}</td>
                    <td>
                        <button type="button" onclick="remove_item(${index})" class="btn btn-danger btn-sm">X</button>
                    </td>
                </tr>
            `)
        });

        $('#sale_total_price').val(total_amount);

        due_amount_calculation()
    }

    function due_amount_calculation(){

        const sale_total_price = $('#sale_total_price').val();
        const previous_balance = $("#previous_balance").val();
        const intotal_amount = parseFloat(sale_total_price) + parseFloat(previous_balance)

        $('#intotal_amount').val(intotal_amount);

        const sale_deposite_amount = $('#sale_deposite_amount').val();
        $("#sale_due_amount").val(parseFloat(intotal_amount ? intotal_amount : 0) - parseFloat(sale_deposite_amount ? sale_deposite_amount : 0))
    }

    function remove_item(index){
        added_items.splice(index, 1)
        show_items()
    }



    function submit_sale(event){
        const sale_data =
        {
            "date" : $("#date").val(),
            "customer_id" : $("#customer_id").val(),
            "sale_total_price" : $("#sale_total_price").val(),
            "previous_balance" : $("#previous_balance").val(),
            "intotal_amount" : $("#intotal_amount").val(),
            "sale_deposite_amount" : $("#sale_deposite_amount").val(),
            "sale_due_amount" : $("#sale_due_amount").val(),
            "sale_payment_by" : $("#sale_payment_by").val(),
            "added_items": added_items,
            "bank_id" : $('#bank_id').val(),
            "cheque_no" : $('#cheque_no').val()
        }

        $("#sale_data").val(JSON.stringify(sale_data));

        $("#sale_store_form").submit();
    }

</script>


@endsection
