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
                            <li class="breadcrumb-item active">
                                <a href="{{ route('report.index') }}">
                                    {{ __('Report.AllReport') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('sale.report.index') }}">
                                    {{ __('Report.SaleReport') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Application.Details') }}
                                </a>
                            </li>
                        </ol>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <a href="{{ route('sale.report.details.export.pdf', ['id' => encrypt($sale_details['sale'][0]->id)]) }}" target="_blank" class="btn btn-sm btn-info float-right">{{ __("Application.Download") }}</a>
                    </div>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-sm table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>{{ __('Application.Date') }}</th>
                                                    <td>{{ $sale_details['sale'][0]->date }}</td>
                                                    <th>{{ __('Application.ChallanNo') }}</th>
                                                    <td>{{ $sale_details['sale'][0]->challan_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Customer.CustomerName') }}</th>
                                                    <td>{{ $sale_details['sale'][0]->customer_name }}</td>
                                                    <th>{{ __('Customer.CustomerPhone') }}</th>
                                                    <td>{{ $sale_details['sale'][0]->customer_phone }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Item.Item') }}</th>
                                                    <th>{{ __('Variant.Variant') }}</th>
                                                    <th>{{ __('Unit.Unit') }}</th>
                                                    <th>{{ __('Lot.Lot') }}</th>
                                                    <th>{{ __('Sale.Quantity') }}</th>
                                                    <th>{{ __('Sale.UnitPrice') }}</th>
                                                    <td>{{ __('Sale.TotalPrice') }}</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sale_details['sale_details'] as $sale_detail)
                                                    <tr>
                                                        <td>{{ $sale_detail->item_name }}</td>
                                                        <td>{{ $sale_detail->variant_name }}</td>
                                                        <td>{{ $sale_detail->unit_name }}</td>
                                                        <td>{{ $sale_detail->lot_name }}</td>
                                                        <td>{{ $sale_detail->quantity }}</td>
                                                        <td>{{ '৳ ' . number_format($sale_detail->unit_price, 0) }}</td>
                                                        <td>{{ '৳ ' . number_format($sale_detail->total_price, 0) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
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


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
    <script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>
    <script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function domReady() {
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%',
                // matcher: matchStart
            });
        });
    </script>

@endsection
