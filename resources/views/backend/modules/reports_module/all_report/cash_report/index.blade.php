@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

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
                                {{ __('Report.CashReport') }}
                            </a>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('all.item.report.export.pdf') }}" target="_blank"
                        class="btn btn-sm btn-info float-right">{{ __("Application.Download") }}</a>
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
                                    <h5>{{__('Report.CashReport')}}</h5>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="search" class="form-control" placeholder="Search Here...">
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="card balance-card">
                                        <span style="margin-top: 15%">{{ __('Transaction.TotalCashTransactions') }}</span>
                                        {{ $total_cash_transaction[0]->total_cash_transactions }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card balance-card">
                                        <span style="margin-top: 15%">{{ __('Transaction.TodayCashInTransaction') }}</span>
                                        {{ $today_cash_in_amount[0]->today_cash_in }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card balance-card">
                                        <span style="margin-top: 15%">{{ __('Transaction.TodayCashOutTransaction') }}</span>
                                        {{ $today_cash_out_amount[0]->today_cash_out }}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card balance-card">
                                        <span style="margin-top: 15%">{{ __('Transaction.TotalCashAmount') }}</span>
                                        @if ($current_cash_balance[0]->cash_balance < 100)
                                            <strong class="text-danger">{{ $current_cash_balance[0]->cash_balance }}</strong>
                                        @else
                                            <strong class="text-success">{{ $current_cash_balance[0]->cash_balance }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <center>
                                <span class="badge badge-info mb-1">{{ __('Transaction.CashTransactionsList') }}</span>
                            </center>

                            <table class="table table-sm table-bordered">
                                <thead>
                                    <th>{{ __('Application.SerialNo') }}</th>
                                    <th>{{ __('Application.Date') }}</th>
                                    <th>{{ __('Transaction.TransactionCode') }}</th>
                                    <th>{{ __('Transaction.Narration') }}</th>
                                    <th>{{ __('Application.Status') }}</th>
                                    <th>{{ __('Transaction.CashIn') }}</th>
                                    <th>{{ __('Transaction.CashOut') }}</th>
                                </thead>

                                <tbody>
                                    @forelse ($cash_transactions as $key => $cash)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $cash->date }}</td>
                                        <td>{{ $cash->transaction_code }}</td>
                                        <td>{{ $cash->narration }}</td>
                                        <td>{{ $cash->status }}</td>
                                        <td>{{ $cash->cash_in }}</td>
                                        <td>{{ $cash->cash_out }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">
                                            <center>
                                                {{__('Application.NoDataFound')}}
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

@endsection
