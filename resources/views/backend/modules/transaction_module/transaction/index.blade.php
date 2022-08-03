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
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Transaction.Transaction') }}
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
                                @if ($transactions && count($transactions) > 0)
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Application.SerialNo') }}</th>
                                                <th>{{ __('Application.Date') }}</th>
                                                <th>{{ __('Transaction.TransactionCode') }}</th>
                                                <th>{{ __('Transaction.Narration') }}</th>
                                                <th>{{ __('Application.Status') }}</th>
                                                <th>{{ __('Transaction.CashIn') }}</th>
                                                <th>{{ __('Transaction.CashOut') }}</th>
                                                <th>{{ __('Application.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $key => $transaction)
                                                <tr>
                                                    {{-- <td>{{ $transactions->firstItem() + $key }}</td> --}}
                                                    <td>{{ ++ $key }}</td>
                                                    <td>{{ \Carbon\Carbon::Parse($transaction->date)->format('d-M-Y') }}</td>
                                                    <td>{{ $transaction->transaction_code  }}</td>
                                                    <td>{{ $transaction->narration }}</td>
                                                    <td>{{ $transaction->status }}</td>
                                                    <td>{{ $transaction->cash_in != 0 ? '৳ '.$transaction->cash_in : '0.00' }}</td>
                                                    <td>{{ $transaction->cash_out != 0 ? '৳ '.$transaction->cash_out : '0.00' }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdown_{{ $transaction->id }}" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                {{ __('Application.Action') }}
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown_{{ $transaction->id }}">
                                                                @if (can('transaction_details'))
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('transaction.details', ['id' => encrypt($transaction->id)]) }}">
                                                                        <i class="fas fa-eye"></i>
                                                                        {{ __('Transaction.TransactionDetails') }}
                                                                    </a>
                                                                @endif
                                                                @if (can('transaction_status_change') && \Illuminate\Support\Facades\URL::previous() != route('report.index'))
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('transaction.status.change', ['id' => encrypt($transaction->id)]) }}">
                                                                        <i class="fas fa-edit"></i>
                                                                        {{ __('Transaction.ChangeStatus') }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h4 class="text-center text-danger my-2">No Data Found</h4>
                                @endif
                                {{-- <div class="mt-2">{{ $transactions->render() }}</div> --}}
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
