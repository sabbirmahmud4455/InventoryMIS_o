@extends("backend.template.layout")

@section('per_page_css')
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

                        <li class="breadcrumb-item active">
                            <a href="{{ route('return.add') }}">
                                {{ __('Return.AddReturn') }}
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            <a href="£">
                                {{ __('Return.SaleReturnView') }}
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
                                    <h5>{{ __('Return.CustomerReturn') }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info btn-sm float-right">
                                        {{ __('Return.AddReturn') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            {{-- Sale Table Data Start --}}
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th>{{ __('Application.Date') }}</th>
                                    <td> {{ $sale_info['sale'][0]->date }} </td>

                                    <th>{{ __('Sale.InvoiceNo') }}</th>
                                    <td> {{ $sale_info['sale'][0]->challan_no }} </td>

                                    <th>{{ __('Application.Status') }}</th>
                                    <td> {{ $sale_info['sale'][0]->status }} </td>
                                </tr>

                                <tr>
                                    <th>{{ __('Customer.CustomerName') }}</th>
                                    <td> {{ $sale_info['sale'][0]->customer_name }} </td>

                                    <th>{{ __('Customer.CustomerPhone') }}</th>
                                    <td> {{ $sale_info['sale'][0]->customer_phone }} </td>

                                    <th>{{ __('Sale.InTotalAmount') }}</th>
                                    <td> {{ number_format($sale_info['sale'][0]->total_amount, 0) }} </td>
                                </tr>
                            </table>
                            {{-- Sale Table Data End --}}

                            <span class="badge badge-info mt-3 mb-3">{{ __('Sale.SoldItemList') }}</span>

                            <table class="table table-sm table-bordered">
                                <thead>
                                    <th>{{ __('Application.SerialNo') }}</th>
                                    <th>{{ __('Item.Item') }}</th>
                                    <th>{{ __('Variant.Variant') }}</th>
                                    <th>{{ __('Unit.Unit') }}</th>
                                    <th>{{ __('Sale.Quantity') }}</th>
                                    <th>{{ __('Sale.UnitPrice') }}</th>
                                    <th>{{ __('Return.ReturnQnty') }}</th>
                                    <th>{{ __('Return.ReturnPrice') }}</th>
                                </thead>

                                <tbody>
                                    @forelse ($sale_info['sale_details'] as $key => $detail)
                                    <tr>
                                        <td>
                                            <span> {{ $key + 1 }} </span>
                                        </td>
                                        <td>
                                            <span class="form-control form-control-sm">{{ $detail->item_name }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="form-control form-control-sm">{{ $detail->variant_name }}</span>
                                        </td>
                                        <td>
                                            <span class="form-control form-control-sm">{{ $detail->unit_name }}</span>
                                        </td>
                                        <td>
                                            <span class="form-control form-control-sm" >{{ $detail->quantity }}</span>
                                            <input type="hidden" id="quantity_{{ $key }}" value="{{ $detail->quantity }}">
                                        </td>
                                        <td>
                                            <span class="form-control form-control-sm">{{ $detail->unit_price }}</span>
                                            <input type="hidden" id="unit_price_{{ $key }}" value="{{ $detail->unit_price }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm"
                                                placeholder="{{ __('Return.ReturnQnty') }}" autofocus
                                                max="{{ $detail->quantity }}" id="return_qnty_{{ $key }}" onkeyup="return_qnty({{ $key }})">
                                        </td>
                                        <td>
                                            <input type="number" readonly name=""
                                                class="form-control form-control-sm" id="return_amount_{{ $key }}">
                                        </td>
                                    </tr>


                                    @empty
                                    <tr>
                                        <td colspan="8">{{ __('Application.NoDataFound') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="2" rowspan="2">
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                        id="flexRadioDefault1" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        {{ __('Return.AdjustWithStock') }}
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                        id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        {{ __('Return.Wastage') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </td>

                                        <td colspan="4" rowspan="2">
                                            <div>
                                                <textarea name="remarks"
                                                    class="form-control form-control-sm mt-2 mb-2 mr-2"
                                                    placeholder="{{ __('Application.Remarks') }}">

                                                </textarea>
                                            </div>
                                        </td>

                                        <td>
                                            <label class="float-right">{{ __('Return.TotalReturnItem') }}</label>
                                        </td>

                                        <td>
                                            <input type="number" class="form-control form-control-sm" id="return_item_qnty" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="float-right">{{ __('Return.TotalReturnItem') }}</label>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" id="return_item_amount" value="0" readonly>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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

        total_item_count = parseInt(total_item_count) + parseInt(qnty);

        if(parseInt(qnty) > parseInt(previous_qnty)) {
            alert('Return quantity can not be grater then sale quantity');
            return false;
        }

        const unit_price = $(`#unit_price_${key}`).val();

        const return_amount = qnty * unit_price;
        $(`#return_amount_${key}`).val(return_amount);
    }

    console.log(total_item_count);


    $(document).ready(function(){
        $('#return_item_qnty').val(total_item_count);
        $('#return_item_amount').val(total_item_amount);
    });

</script>

@endsection
