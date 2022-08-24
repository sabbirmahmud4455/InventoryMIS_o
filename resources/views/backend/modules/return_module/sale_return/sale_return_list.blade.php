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
                            <a href="#">
                                {{ __('Return.SalesReturnList') }}
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
                                <div class="col-md-8">
                                    <h6>{{ __('Return.SalesReturnList') }}</h6>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" name="sale_return_search" placeholder="Search Here..." class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <th>{{ __('Application.SerialNo') }}</th>
                                    <th>{{ __('Application.Date') }}</th>
                                    <th>{{ __('Sale.InvoiceNo') }}</th>
                                    <th>{{ __('Customer.CustomerName') }}</th>
                                    <th>{{ __('Application.Total') }}</th>
                                    <th>{{ __('Application.Status') }}</th>
                                    <th>{{ __('Application.Action') }}</th>
                                </thead>

                                <tbody>
                                    @forelse ($sales_return as $key => $sale)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $sale->return_date }}</td>
                                            <td>{{ $sale->invoice_no }}</td>
                                            <td>{{ $sale->customer_name }}</td>
                                            <td>{{ $sale->return_amount }}</td>
                                            <td>
                                                @if ($sale->status == 'AdjustWithStock')
                                                    <span class="badge badge-success">Stock Adjust</span>
                                                @else
                                                    <span class="badge badge-danger">Wastage</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <center>
                                                    <span class="badge badge-danger">{{ __('Application.NoDataFound') }}</span>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
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
    }, function (start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

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

@endsection
