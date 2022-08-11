@extends("backend.template.layout")

@section('per_page_css')
    <link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

    <!-- DatePicker CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- DatePicker CSS -->
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
                                <a href="{{ route('report.index') }}">
                                    {{ __('Report.AllReport') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Report.SaleReport') }}
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
                            <div class="card-header text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="">
                                            <div class="row">
                                                <!-- Customer -->
                                                <div class="col-md-3 col-3 form-group">
                                                    <select class="form-control select2" name="customer_id">
                                                        <option disabled selected>Select Customer</option>
                                                        @if ( count($customers) > 0 )
                                                            @foreach ($customers as $customer)
                                                                @php
                                                                    @endphp
                                                                <option value="{{ $customer->id }}" @if(request()->customer_id == $customer->id) selected @endif>{{ $customer->name . ' - ' . $customer->address }}</option>
                                                            @endforeach
                                                        @else
                                                            <option disabled>No Data Found</option>
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="col-md-3 col-3 form-group">
                                                    <input type="text" class="form-control" name="sale_date" value="{{ request()->sale_date }}">
                                                </div>

                                                <div class="col-md-3 col-3 form-group">
                                                    <input type="text" class="form-control" name="sale_search" value="{{ request()->sale_search }}" placeholder="Search Sale">
                                                </div>
                                                <div class="col-md-2 form-group text-left">
                                                    <button type="submit" class="btn btn-sm btn-outline-dark">
                                                        {{ __('Application.Submit') }}
                                                    </button>
                                                </div>
                                                <div class="col-md-1 form-group text-right">
                                                    <a href="{{ route('sale.report.index') }}" type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-undo" ></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($sales && count($sales) > 0)
                                    <table class="table table-sm table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Application.SerialNo') }}</th>
                                                <th>{{ __('Application.Date') }}</th>
                                                <th>{{ __('Sale.ChallanNo') }}</th>
                                                <th>{{ __('Customer.CustomerName') }}</th>
                                                <th>{{ __('Customer.CustomerPhone') }}</th>
                                                <td>{{ __('Sale.TotalPrice') }}</td>
                                                <th>{{ __('Application.Action') }}</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $total_sale = 0;
                                        @endphp
                                        <tbody>
                                        @foreach ($sales as $key => $sale)
                                            <tr>
                                                <td>{{ ++ $key }}</td>
                                                <td>{{ $sale->date }}</td>
                                                <td>{{ $sale->challan_no }}</td>
                                                <td>{{ $sale->customer_name }}</td>
                                                <td>{{ $sale->customer_phone }}</td>
                                                @php
                                                    $total_sale += $sale->total_amount;
                                                @endphp
                                                <td>{{ '৳ ' . number_format($sale->total_amount, 0) }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{ $sale->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ __('Application.Action') }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdown{{ $sale->id }}">

                                                            <a class="dropdown-item" href="{{ route('sale.report.details', ['id' => encrypt($sale->id)]) }}">
                                                                <i class="fas fa-eye"></i>
                                                                {{ __('Application.Details') }}

                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('sale.report.invoice', ['id' => encrypt($sale->id)]) }}">
                                                                <i class="fas fa-file-invoice"></i>
                                                                {{ __('Sale.SaleInvoice') }}

                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfooter>
                                            <tr style="background-color: #9F9F9F">
                                                <th colspan="5">{{ __('Application.Total') }}</th>
                                                <td colspan="2">{{ '৳ ' . number_format($total_sale, 0) }}</td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                @else
                                    <h4 class="text-center text-danger my-2">{{ __('Application.NoDataFound') }}</h4>
                                @endif
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

    <!-- DatePicker JS -->
    <script>
        $(function() {
            $('input[name="sale_date"]').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            }, function(start, end, label) {
                // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });

            $('input[name="sale_date"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="sale_date"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- DatePicker JS -->

    <script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function domReady() {
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%',
                // dropdownParent: $('#myModal')
            });
        });

    </script>

@endsection
