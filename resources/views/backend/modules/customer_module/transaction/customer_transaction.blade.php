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
                            @if (\Illuminate\Support\Facades\URL::previous() == route('report.index'))
                                <li class="breadcrumb-item active">
                                    <a href="{{ route('report.index') }}">
                                        {{ __('Report.AllReport') }}
                                    </a>
                                </li>
                            @endif
                            <li class="breadcrumb-item">
                                <a href="{{ route('customer.all') }}">
                                     {{ __('Customer.Customer') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Application.Transaction') }}
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('customer.transaction.export.pdf', ['id' => encrypt($customer->id)]) }}" class="btn btn-sm btn-info float-right" target="_blank">{{ __('Application.Download') }}</a>
                    </div>
                </div>
            </div>
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
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th>{{ __('Customer.CustomerName') }}</th>
                                                <td>{{ $customer->name }}</td>
                                                <th>{{ __('Customer.CustomerPhone') }}</th>
                                                <td>{{ $customer->contact_no }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Customer.CustomerAddress') }}</th>
                                                <td colspan="3">{{ $customer->address }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-sm table-striped dataTable dtr-inline datatable-data">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Application.SerialNo') }}</th>
                                            <th>{{ __('Application.Date') }}</th>
                                            <th>{{ __('Transaction.TransactionCode') }}</th>
                                            <th>{{ __('Transaction.Narration') }}</th>
                                            <th>{{ __('Application.Status') }}</th>
                                            <th>{{ __('Transaction.CashIn') }}</th>
                                            <th>{{ __('Transaction.CashOut') }}</th>
                                        </tr>
                                    </thead>

                                    @php
                                        $total_cash_in = 0;
                                        $total_cash_out = 0;
                                        $balance = 0;
                                    @endphp

                                    <tbody>
                                        @forelse ($customer_transactions as $key => $transaction)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $transaction->date }}</td>
                                                <td>
                                                    <a style="color: rgb(8, 8, 255)" class="dropdown-item" href="#" data-content="{{ route('customer.transaction.details', encrypt($transaction->id)) }}" data-target="#largeModal" data-toggle="modal">
                                                        {{ $transaction->transaction_code }}
                                                    </a>
                                                </td>
                                                <td>{{ $transaction->narration }}</td>
                                                <td>
                                                    @if ($transaction->status == 'PENDING')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($transaction->status == 'RECEIVED')
                                                        <span class="badge badge-success">Received</span>
                                                    @elseif ( $transaction->status == 'SEND')
                                                        <span class="badge badge-info">Send</span>
                                                    @elseif ( $transaction->status == 'CANCEL')
                                                        <span class="badge badge-danger">Cancel</span>
                                                    @elseif ( $transaction->status == 'BOUNCE')
                                                        <span class="badge badge-primary">Bounce</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($transaction->cash_in)
                                                        {{ '৳ ' .number_format($transaction->cash_in,0) }}

                                                        @php
                                                            $total_cash_in += $transaction->cash_in;
                                                        @endphp
                                                    @else
                                                        0.00
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($transaction->cash_out)
                                                        {{ '৳ ' .number_format($transaction->cash_out,0) }}
                                                        @php
                                                            $total_cash_out += $transaction->cash_out;
                                                        @endphp
                                                    @else
                                                        0.00
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <span class="badge badge-danger">
                                                        {{ __('Application.NoDataFound') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforelse

                                        <tr>
                                            <th colspan="5" class="text-right"> {{ __('Application.Total') }} </th>
                                            <td>{{ '৳ ' .number_format($total_cash_in,0) }}</td>
                                            <td>{{ '৳ ' .number_format($total_cash_out,0) }}</td>
                                        </tr>

                                        <tr>
                                            <th colspan="5" class="text-right">{{ __('Transaction.Balance') }}</th>
                                            <td colspan="2" class="text-center">
                                                <button class="btn btn-info btn-sm">
                                                    {{ '৳ ' .number_format($total_cash_in - $total_cash_out, 0) }}
                                                </button>
                                            </td>
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
