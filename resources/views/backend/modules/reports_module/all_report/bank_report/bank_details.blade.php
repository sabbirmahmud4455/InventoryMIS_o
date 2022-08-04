@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    * {
        margin: 0;
        padding: 0;
    }

    #wrap {
        text-align: center;
        z-index: 10;
    }

    h1 {
        position: relative;
        color: #fff;
        font-size: 40px;
        padding: 70px 0px 30px;
    }

    p {
        font-family: "Lato";
        font-weight: 300;
        font-size: 24px;
        color: #fff;
    }

    .fa {
        font-size: 19px;
        width: 20px;
    }

    .btn-slide {
        position: relative;
        display: inline-block;
        height: 31px;
        width: 244px;
        line-height: 50px;
        padding: 0px;
        margin-top: 23px;
        border-radius: 25px;
        box-shadow: 0 10px 20px -8px rgb(0 0 0 / 70%);
        background: linear-gradient(135deg, #121012 0%, #261a1a 100%);
    }

    .btn-slide:active {
        box-shadow: 0 8px 16px -8px rgba(0, 0, 0, 0.7);
        -webkit-transform: scale(0.98);
        transform: scale(0.96);
    }

    .btn-slide:hover {
        background: linear-gradient(-135deg, #e570e7 0%, #79f1fc 100%);
    }

    .btn-slide span.circle {
        display: block;
        background-color: #fff;
        color: #2e252e;
        position: absolute;
        margin: 0px;
        height: 31px;
        width: 31px;
        top: 0;
        left: 0;
        border-radius: 50%;
        transition: all 1.5s ease;
    }

    .btn-slide:hover span.circle {
        left: 100%;
        margin-left: -45px;
        background-color: #fff;
        color: #79f1fc;
    }

    .btn-slide span.title {
        position: absolute;
        left: 80px;
        font-size: 17px;
        font-weight: bold;
        margin-top: -8px;
        color: #fff;
        transition: all 1.5s linear;
    }

    .btn-slide span.title-hover {
        opacity: 0;
    }

    .btn-slide:hover span.title {
        opacity: 0;
    }

    .btn-slide:hover span.title-hover {
        opacity: 1;
        left: 60px;
    }

</style>
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
                            <a href="{{ route('bank_report.all_bank') }}">
                                {{ __('Report.BankReport') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $bank->name }}
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
                            <h5>{{ __('Bank.BankDetails') }}</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <tr>
                                        <td>{{ __('Bank.BankName') }}</td>
                                        <td>{{ $bank->name }}</td>

                                        <td>{{ __('Bank.BranchName') }}</td>
                                        <td>{{ $bank->branch_name }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Bank.AccountName') }}</td>
                                        <td>{{ $bank->account_name }}</td>

                                        <td>{{ __('Bank.AccountNumber') }}</td>
                                        <td>{{ $bank->account_no }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <span class="badge badge-info mt-1">{{ __('Transaction.TransactionFiltering') }}</span>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label>{{ __('Application.Date') }}</label>
                                    <input type="text" name="transaction_date" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-3">
                                    <label>{{ __('Application.Status') }}</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="PENDING">PENDING</option>
                                        <option value="RECEIVE">RECEIVE</option>
                                        <option value="CANCEL">CANCEL</option>
                                        <option value="BOUNCE">BOUNCE</option>
                                        <option value="SEND">SEND</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>{{ __('Application.Filtering') }}</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="desc">{{ __('Application.OldToLatest') }}</option>
                                        <option value="asc">{{ __('Application.LatestToOld') }}</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <div> <a class="btn-slide" href="#">
                                            <span class="circle">
                                                <i class="fa fa-usd" aria-hidden="true"></i>
                                            </span>

                                            <span class="title">{{ __('Bank.BankBalance') }}</span>
                                            <span class="title title-hover">1204555</span>
                                        </a> </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped ">
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
                                        @forelse ($bank_transactions as $key => $transaction)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $transaction->transaction_date }}</td>
                                            <td>{{ $transaction->transaction_code }}</td>
                                            <td>{{ $transaction->narration }}</td>
                                            <td>{{ $transaction->status }}</td>
                                            <td>
                                                @if ($transaction->cash_in)
                                                {{ $transaction->cash_in }}
                                                @else
                                                00
                                                @endif
                                            </td>
                                            <td>
                                                @if ($transaction->cash_out)
                                                {{ $transaction->cash_out }}
                                                @else
                                                00
                                                @endif
                                            </td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(function () {
        $('input[name="transaction_date"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {

        });
    });

</script>

@endsection
