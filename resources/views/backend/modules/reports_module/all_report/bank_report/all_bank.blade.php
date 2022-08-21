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
                                {{ __('Report.AllBankReport') }}
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
                                    <h5>{{__('Bank.AllBankReport')}}</h5>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="search" class="form-control" placeholder="Search Here...">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <th>{{ __('Application.SerialNo') }}</th>
                                    <th>{{ __('Bank.BankName') }}</th>
                                    <th>{{ __('Bank.AccountName') }}</th>
                                    <th>{{ __('Bank.AccountNumber') }}</th>
                                    <th>{{ __('Bank.BranchName') }}</th>
                                    <th>{{ __('Bank.BankBalance') }}</th>
                                    <th>{{ __('Application.Action') }}</th>
                                </thead>

                                @php
                                    $total_balance = 0;
                                @endphp
                                <tbody>
                                    @forelse ($all_banks as $key => $bank)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $bank->bank_name }}</td>
                                        <td>{{ $bank->account_name }}</td>
                                        <td>{{ $bank->account_no }}</td>
                                        <td>{{ $bank->branch_name }}</td>
                                        <td>{{ $bank->balance }}</td>
                                        @php
                                            $total_balance += $bank->balance;
                                        @endphp
                                        <td>
                                            <a href="{{ route('bank_report.bank_details', encrypt($bank->bank_id) ) }}" class="btn btn-primary btn-sm">
                                                {{ __('Bank.BankDetails') }}
                                            </a>
                                        </td>
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
                                    <tr style="background-color: #9F9F9F">
                                        <th colspan="5">{{ __('Application.Total') }}</th>
                                        <td colspan="2">{{ $total_balance }}</td>
                                    </tr>
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
