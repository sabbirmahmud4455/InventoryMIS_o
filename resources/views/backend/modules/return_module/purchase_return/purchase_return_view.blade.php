@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

<style>
    .disable_input{
        background-color: #ffff!important;
    }
</style>
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

                        <li class="breadcrumb-item active">
                            <a href="{{ route('return.add') }}">
                                {{ __('Return.AddReturn') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            <a href="#">
                                {{ __('Return.PurchaseReturn') }}
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>{{ __('Return.PurchaseReturn') }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('return.add') }}" class="btn btn-info btn-sm float-right">
                                        {{ __('Return.AddReturn') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('return.purchase_return_store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="purchase_id" value="{{ $purchase_info['purchase']->purchase_id }}" required>
                            <input type="hidden" name="invoice_no" value="{{ $purchase_info['purchase']->challan_no }}" required>
                            <input type="hidden" name="supplier_id" value="{{ $purchase_info['purchase']->supplier_id }}" required>

                            <div class="card-body table-responsive">
                                {{-- Sale Table Data Start --}}
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <th>{{ __('Application.Date') }}</th>
                                        <td> {{ $purchase_info['purchase']->date }} </td>

                                        <th>{{ __('Sale.InvoiceNo') }}</th>
                                        <td> {{ $purchase_info['purchase']->challan_no }} </td>

                                        <th>{{ __('Application.Status') }}</th>
                                        <td> {{ $purchase_info['purchase']->purchase_status }} </td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('Supplier.SupplierName') }}</th>
                                        <td> {{ $purchase_info['purchase']->supplier_name }} </td>

                                        <th>{{ __('Supplier.SupplierPhone') }}</th>
                                        <td> {{ $purchase_info['purchase']->supplier_contact }} </td>

                                        <th>{{ __('Purchase.TotalAmount') }}</th>
                                        <td> {{ number_format($purchase_info['purchase']->total_amount, 0) }} </td>
                                    </tr>
                                </table>
                                {{-- Sale Table Data End --}}

                                <span class="badge badge-info mt-3 mb-3">{{ __('Sale.SoldItemList') }}</span>

                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <th>{{ __('Application.SerialNo') }}</th>
                                        <th>{{ __('Lot.LotName') }}</th>
                                        <th>{{ __('Item.Item') }}</th>
                                        <th>{{ __('Variant.Variant') }}</th>
                                        <th>{{ __('Unit.Unit') }}</th>
                                        <th>{{ __('Sale.Quantity') }}</th>
                                        <th>{{ __('Sale.UnitPrice') }}</th>
                                        <th>{{ __('Warehouse.Warehouse') }}</th>
                                        <th>{{ __('Return.ReturnQnty') }}</th>
                                        <th>{{ __('Return.ReturnPrice') }}</th>
                                    </thead>

                                    <tbody>
                                        @forelse ($purchase_info['purchase_details'] as $key => $detail)
                                        <tr>
                                            <td>
                                                <span> {{ $key + 1 }} </span>
                                            </td>

                                            <!-- Lot Name -->
                                            <td>
                                                <span class="form-control form-control-sm">{{ $detail->lot_name }}</span>
                                                <input type="hidden" name="lot_id[]" readonly value="{{ $detail->lot_id }}">
                                            </td>

                                            <!-- Item Name -->
                                            <td>
                                                <span class="form-control form-control-sm"> {{ $detail->item_name }} </span>
                                                <input type="hidden" name="item_id[]" readonly value="{{ $detail->item_id }}">
                                            </td>

                                            <!-- Variant Name -->
                                            <td>
                                                <span class="form-control form-control-sm"> {{ $detail->variant_name }} </span>
                                                <input type="hidden" name="variant_id[]" readonly value="{{ $detail->variant_id }}">
                                            </td>

                                            <!-- Unit Name -->
                                            <td>
                                                <span class="form-control form-control-sm"> {{ $detail->unit_name }} </span>
                                                <input type="hidden" name="unit_id[]" readonly value="{{ $detail->unit_id }}">
                                            </td>

                                            <!-- Quantity -->
                                            <td>
                                                <span class="form-control form-control-sm"> {{ $detail->quantity }} </span>
                                                <input type="hidden"  id="quantity_{{ $key }}" name="quantity[]" readonly value="{{ $detail->quantity }}">
                                            </td>

                                            <!-- Unit Price -->
                                            <td>
                                                <span class="form-control form-control-sm"> {{ $detail->unit_price }} </span>
                                                <input type="hidden" id="unit_price_{{ $key }}" readonly name="unit_price[]" value="{{ $detail->unit_price }}">
                                            </td>

                                            <!-- Warehouse -->
                                            <td>
                                                <span class="form-control form-control-sm"> {{ $detail->warehouse_name }} </span>
                                                <input type="hidden" readonly name="warehouse_id[]" value="{{ $detail->warehouse_id }}">
                                            </td>

                                            <!-- Return Quantity -->
                                            <td>
                                                <input type="number" class="form-control form-control-sm return_qnty" name="return_quantity[]" placeholder="{{ __('Return.ReturnQnty') }}" autofocus
                                                max="{{ $detail->quantity }}"  id="return_qnty_{{ $key }}" onkeyup="return_qnty({{ $key }})" required>
                                            </td>

                                            <!-- Return Amount -->
                                            <td>
                                                <input type="number" readonly name="return_amount[]" class="form-control form-control-sm disable_input return_amount"
                                                id="return_amount_{{ $key }}">
                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="8">{{ __('Application.NoDataFound') }}</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-md-8 bg card mt-3">
                                        <div class="row">
                                            <!-- Stock Adjust -->
                                            <div class="col-md-3">
                                                <!-- Adjust With Stock Radio Button -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="adjust"
                                                    id="stock" checked value="1">

                                                    <label class="form-check-label" for="stock">
                                                        {{ __('Return.AdjustWithStock') }}
                                                    </label>
                                                </div>

                                                <!-- Wastage Radio Button -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="adjust"
                                                    id="wastage" value="0">
                                                    <label class="form-check-label" for="wastage">
                                                        {{ __('Return.Wastage') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Remarks -->
                                            <div class="col-md-9">
                                                <textarea name="remarks"
                                                    class="form-control form-control-sm mt-2 mb-2 mr-2" name="remarks"
                                                    placeholder="{{ __('Application.Remarks') }}">

                                                </textarea>
                                            </div>
                                        </div>

                                        <!-- Total Cash In and Bank Balance -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6>{{ __('Transaction.TotalCashInHandBalance') }}</h6>
                                                        <span class="badge badge-primary">{{ number_format($total_amount['cash_in_hand_balance'][0]->cash_balance,0) }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6>{{ __('Transaction.TotalBankBalance') }}</h6>
                                                        <span class="badge badge-primary">{{ number_format($total_amount['bank_balance'][0]->bank_balance,0) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Summation DIV -->
                                    <div class="col-md-4 bg card mt-3">
                                        <div class="row mt-2">

                                            <!-- Total Item Count -->
                                            <div class="col-md-4">
                                                <label class="float-right">{{ __('Return.TotalReturnAmount') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control form-control-sm disable_input" id="return_item_qnty" readonly>
                                            </div>

                                            <!-- Total Item Amount -->
                                            <div class="col-md-4">
                                                <label class="float-right">{{ __('Return.TotalReturnAmount') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" name="return_amount" class="form-control form-control-sm disable_input" id="return_item_amount" readonly>
                                            </div>

                                            <!-- Total Payble Amount -->
                                            <div class="col-md-4 ">
                                                <label class="float-right">{{ __('Purchase.DepositeAmount') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="deposit_amount" id="deposit_amount" class="form-control form-control-sm">
                                            </div>

                                            <!-- Balance or Due -->
                                            <div class="col-md-4">
                                                <label class="float-right">{{ __('Purchase.DueAmount') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="due_amount" id="due_amount" class="form-control form-control-sm disable_input" readonly>
                                            </div>

                                            <!-- Payment By -->
                                            <div class="col-md-4">
                                                <label class="float-right"> {{ __('Sale.PaymentBy') }} </label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="payment_by" id="payment_by" class="form-control form-control-sm">
                                                    <option value="CASH">Cash</option>
                                                    <option value="BANK">Bank</option>
                                                </select>
                                            </div>

                                            <!-- Bank List with Balance -->
                                            <div class="col-md-4 bank_div">
                                                <label class="float-right"> {{ __('Bank.BankName') }} </label>
                                            </div>
                                            <div class="col-md-8 bank_div">
                                                <select name="bank_id" id="bank_id" class="form-control form-control-sm">
                                                    @forelse ($banks as $bank)
                                                        <option value="{{ $bank->bank_id }}">{{ $bank->bank_name }} [{{ number_format($bank->balance,0) }}]</option>
                                                    @empty
                                                        <option disabled>{{ __('Application.NoDataFound') }}</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-info float-right mt-3" type="submit">
                                    {{ __('Application.Add') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('per_page_js')

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>


<script>
    $('input[name="purchase_date"]').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,

        locale: {
            cancelLabel: 'Clear',
        }
    }, function (start, end, label) {});

    $('input[name="purchase_date"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="purchase_date"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%',
        // dropdownParent: $('#myModal')
    });

</script>

<script>

    var total_item_count = 0;
    var total_item_amount = 0;

    function return_qnty(key) {
        const qnty = $(`#return_qnty_${key}`).val();
        const previous_qnty = $(`#quantity_${key}`).val();

        // IF Given Quantity is Larger Then Sale Quantity.
        if(parseInt(qnty) > parseInt(previous_qnty)) {
            alert('Return quantity can not be grater then sale quantity');
            $(`#return_qnty_${key}`).val(0);
            $(`#return_amount_${key}`).val(0);
            return false;
        }

        const unit_price = $(`#unit_price_${key}`).val();
        const return_amount = qnty * unit_price;
        $(`#return_amount_${key}`).val(return_amount);

        AddTotalItemAmount();
    }

    function AddTotalItemAmount() {
        let return_qnty = $('.return_qnty');
        let return_amount = $('.return_amount');

        total_item_count = 0;
        total_item_amount = 0;

        return_qnty.each((index, element) => {
            const item_qnty = parseInt(element.value);

            if(item_qnty && item_qnty >= 0){
              total_item_count  += item_qnty
            }
        });

        return_amount.each((index, element) => {
            const return_amount = parseInt(element.value);

            if(return_amount && return_amount >= 0){
                total_item_amount  += return_amount
            }
        });

        $(`#return_item_qnty`).val(total_item_count);
        $(`#return_item_amount`).val(total_item_amount);

        if(total_item_amount < 0){
            $('#deposit_amount').attr('disabled','disabled');
        } else {
            $('#deposit_amount').removeAttr('disabled');
        }
    }

    $(document).ready(function(){
        $('.bank_div').hide();
        $('#return_item_qnty').val(total_item_count);
        $('#return_item_amount').val(total_item_amount);
        $('#deposit_amount').attr('disabled','disabled');

        // Deposit Amount
        $('#deposit_amount').keyup(function(){
            const deposit_amount = $(this).val();
            const return_amount = $('#return_item_amount').val();
            if(deposit_amount && deposit_amount > 0){
                const due_amount = parseInt(return_amount) - parseInt(deposit_amount);
                $('#due_amount').val(due_amount);
            }else {
                $('#due_amount').val(0);
            }

        })

        // Payment By Bank
        $('#payment_by').change(function(){
            if($(this).val() === 'BANK'){
                $('.bank_div').show();
            } else {
                $('.bank_div').hide();
                $('#bank_id').val('');
            }
        })
    });

</script>

@endsection
