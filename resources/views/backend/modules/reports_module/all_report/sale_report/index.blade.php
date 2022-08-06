@extends("backend.template.layout")

@section('per_page_css')
    <link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                                                <th>{{ __('Application.Status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($sales as $key => $sale)
                                            <tr>
                                                <td>{{ ++ $key }}</td>
                                                <td>{{ $sale->date }}</td>
                                                <td>{{ $sale->challan_no }}</td>
                                                <td>{{ $sale->customer_name }}</td>
                                                <td>{{ $sale->status }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
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

@endsection
