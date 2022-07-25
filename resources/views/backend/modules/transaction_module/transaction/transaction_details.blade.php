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
                                <a href="{{ route('transaction.all') }}">
                                    {{ __('Transaction.Transaction') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="">
                                    {{ __('Transaction.TransactionDetails') }}
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
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('Application.Date') }}</th>
                                            <td>{{ \Carbon\Carbon::Parse($transaction->date)->format('d-M-Y') }}</td>
                                            <th>{{ __('Transaction.TransactionCode') }}</th>
                                            <td>{{ $transaction->transaction_code  }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Transaction.Narration') }}</th>
                                            <td>{{ $transaction->narration ? $transaction->narration : 'N/A' }}</td>
                                            <th>{{ __('Transaction.InvoiceNo') }}</th>
                                            <td>{{ $transaction->invoice_no ? $transaction->invoice_no : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('TransactionType.TransactionType') }}</th>
                                            <td>{{ $transaction->transaction_type_id ? $transaction->transaction_type->name : 'N/A' }}</td>    
                                            <th>{{ __('Supplier.SupplierName') }}</th>
                                            <td>{{ $transaction->supplier_id ? $transaction->supplier->name : 'N/A' }}</td>      
                                        </tr>
                                        <tr>
                                            <th>{{ __('Bank.BankName') }}</th>
                                            <td>{{ $transaction->bank_id ? $transaction->bank->name : 'N/A' }}</td>    
                                            <th>{{ __('Bank.ChequeNo') }}</th>
                                            <td>{{ $transaction->cheque_no ? $transaction->cheque_no : 'N/A' }}</td>      
                                        </tr>
                                        <tr>
                                            <th>{{ __('Transaction.CashIn') }}</th>
                                            <td>{{ $transaction->cash_in != 0 ? '৳ '.$transaction->cash_in : '-' }}</td>
                                            <th>{{ __('Transaction.CashOut') }}</th>
                                            <td>{{ $transaction->cash_out != 0 ? '৳ '.$transaction->cash_out : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Application.Remarks') }}</th>
                                            <td>{{ $transaction->remarks ? $transaction->remarks : 'N/A' }}</td>
                                            <th>{{ __('Application.CreadtedBy') }}</th>
                                            <td>{{ $transaction->created_by_user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Application.Status') }}</th>
                                            <td colspan="3">{{ $transaction->status }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                @if (!empty($transaction->purchase_id))
                                    {{-- Purchase Details --}}
                                    <span class="badge badge-info mt-2">{{ __('Purchase.ViewPurchaseInfo') }}</span>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Application.SerialNo') }}</th>
                                                <th>{{ __('Lot.LotName') }}</th>
                                                <th>{{ __('Item.Item') }}</th>
                                                <th>{{ __('Purchase.Weight') }}</th>
                                                <th>{{ __('Unit.Unit') }}</th>
                                                <th>{{ __('Purchase.Price') }}</th>
                                                <th>{{ __('Purchase.TotalPrice') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($transaction->purchase->purchase_details as $key => $purchase_details)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $purchase_details->lot->name }}</td>
                                                    <td>{{ $purchase_details->item->name }}</td>
                                                    <td>{{ $purchase_details->variant->name }}</td>
                                                    <td>{{ $purchase_details->unit->name }}</td>
                                                    <td>{{ $purchase_details->unit_price }}</td>
                                                    <td>{{ $purchase_details->total_price }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-danger">No Purchase Data Found!!</span>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
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
