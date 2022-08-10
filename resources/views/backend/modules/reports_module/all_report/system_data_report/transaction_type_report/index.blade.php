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
                                    {{ __('Report.TransactionTypeReport') }}
                                </a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <a href="{{ route('transaction.type.report.export.pdf') }}" target="_blank" class="btn btn-sm btn-info float-right">{{ __("Application.Download") }}</a>
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
                            <div class="card-header text-right">
                            </div>
                            <div class="card-body">
                                @if ($transaction_types && count($transaction_types) > 0)
                                    <table class="table table-sm table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Application.SerialNo') }}</th>
                                                <th>{{ __('TransactionType.TransactionType') }}</th>
                                                <th>{{ __('TransactionType.CashType') }}</th>
                                                <th>{{ __('Transaction.TransactionAmount') }}</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $total_transaction = 0;
                                        @endphp
                                        <tbody>
                                            @foreach ($transaction_types as $key => $transaction_type)
                                                <tr>
                                                    <td>{{ ++ $key }}</td>
                                                    <td>{{ $transaction_type->name }}</td>
                                                    <td>{{ $transaction_type->cash_type }}</td>
                                                    @php
                                                        $cash_in = $transaction_type->transactions->sum('cash_in');
                                                        $cash_out = $transaction_type->transactions->sum('cash_out');
                                                        $total_transaction += $cash_in - $cash_out;
                                                    @endphp
                                                    @if($transaction_type->cash_type === 'Cash In')
                                                        <td>{{ '৳ ' . number_format($cash_in, 0) }}</td>
                                                    @elseif($transaction_type->cash_type === 'Cash Out')
                                                        <td>{{ '৳ ' . number_format($cash_out, 0) }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <tr style="background-color: #9F9F9F">
                                                <th colspan="3">{{ __('Application.Total') }}</th>
                                                <td>{{ '৳ ' . number_format($total_transaction, 0) }}</td>
                                            </tr>
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
