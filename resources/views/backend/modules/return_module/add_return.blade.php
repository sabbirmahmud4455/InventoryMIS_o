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
                                {{ __('Return.AddReturn') }}
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('return.customer_return_view') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>{{ __('Return.CustomerReturn') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <label> {{ __('Sale.InvoiceNo') }} </label>

                                                <select name="customer_sale_id" class="form-control select2">
                                                    <option selected disabled>{{ __('Application.Select') }}</option>
                                                    @forelse ($sale_challan_no as $challan_no)
                                                    <option value="{{ $challan_no->id }}">{{ $challan_no->challan_no }}
                                                    </option>
                                                    @empty
                                                    <option disabled>{{ __('Application.NoDataFound') }}</option>
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class="card-footer">
                                                <center>
                                                    <button class="btn btn-primary">
                                                        {{ __('Application.Submit') }}
                                                    </button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>{{ __('Return.SupplierReturn') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <label> {{ __('Sale.InvoiceNo') }} </label>

                                            <select name="" class="form-control select2">
                                                <option selected disabled>{{ __('Application.Select') }}</option>
                                                @forelse ($purchase_challan_no as $challan)
                                                <option value="{{ $challan->id }}">{{ $challan->challan_no }}</option>
                                                @empty
                                                <option disabled>{{ __('Application.NoDataFound') }}</option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="card-footer">
                                            <center>
                                                <button class="btn btn-primary">
                                                    {{ __('Application.Submit') }}
                                                </button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
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
