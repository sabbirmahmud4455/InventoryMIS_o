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

                                <form action="{{ route('transaction.create') }}" method="post" class="ajax-form">
                                    @csrf
                                    <div class="row">

                                        <!-- date -->
                                        <div class="col-md-3 col-6 form-group">
                                            <label for="date">{{ __('Transaction.Date') }}</label><span class="require-span">*</span>
                                            <input type="date" value="<?php echo date('Y-m-d') ?>" class="form-control" name="date" id="date" required>
                                        </div>

                                        <!-- Transaction Type -->
                                        <div class="col-md-3 col-6 form-group">
                                            <label for="transaction_type_id">{{ __('TransactionType.TransactionType') }}</label><span class="require-span">*</span>
                                            <select class="form-control select2" name="transaction_type_id">
                                                <option value="" selected disabled>{{ __('Application.Select') }} {{ __('TransactionType.TransactionType') }} </option>
                                                @foreach ($transaction_types as $transaction_type)
                                                    <option value="{{ $transaction_type->id }}" >{{ $transaction_type->name . ' - ' . $transaction_type->cash_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- challan no -->
                                        <div class="col-md-3 col-6 form-group">
                                            <label for="transaction_type_id">{{ __('Application.ChallanNo') }}</label><span class="require-span">*</span>
                                            <select class="form-control select2" name="purchase_sale_id">
                                                <option value="" selected disabled>{{ __('Application.Select') }} {{ __('Application.ChallanNo') }}</option>
                                                @foreach ($purchases as $purchase)
                                                    <option value="{{ $purchase->id }}_purchase" >{{ $purchase->challan_no }} (purchase)</option>
                                                @endforeach
                                                @foreach ($sales as $sale)
                                                    <option value="{{ $sale->id }}_sale" >{{ $sale->challan_no }} (sale)</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Transaction Amount -->
                                        <div class="col-md-3 col-6 form-group">
                                            <label for="name">{{ __('Transaction.TransactionAmount') }}</label><span class="require-span">*</span>
                                            <input type="text" class="form-control" name="transaction_amount" required>
                                        </div>

                                        <!-- Payment Type -->
                                        <div class="col-md-3 col-6 form-group">
                                            <label for="payment_type">{{ __('Transaction.PaymentType') }}</label><span class="require-span">*</span>
                                            <select class="form-control select2" name="payment_type" id="payment_type">
                                                <option value="" selected disabled>Select Payment Type</option>
                                                    <option value="Cash">{{ __('Transaction.Cash') }}</option>
                                                    <option value="Bank">{{ __('Transaction.Bank') }}</option>
                                            </select>
                                        </div>



                                    </div>

                                    <div id="bank_info" class="row d-none">
                                        <!-- Bank -->
                                        <div class="col-md-4 col-6 form-group">
                                            <label for="bank_id">{{ __('TransactionType.TransactionType') }}</label><span class="require-span">*</span>
                                            <select class="form-control select2" name="bank_id" id="bank_id">
                                                <option value="0" selected disabled>Select Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}" >{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- cheque No -->
                                        <div class="col-md-4 col-6 form-group">
                                            <label for="name">{{ __('Bank.ChequeNo') }}</label><span class="require-span">*</span>
                                            <input type="text" class="form-control" name="cheque_no" id="cheque_no">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group text-right">
                                        <button type="submit" class="btn btn-outline-dark">
                                            {{ __('Application.Add') }}
                                        </button>
                                    </div>

                                </form>

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
                // dropdownParent: $('#myModal')
            });
        });
    </script>

    <script>
        $('#payment_type').on('change', () => {
            const paymentType = $('#payment_type').val() === 'Bank';
            if(paymentType) {
                $('#bank_info').removeClass('d-none');
            } else {
                $('#bank_info').addClass('d-none');
                $('#bank_id').val('');
                $('#cheque_no').val('');
            }
        })
    </script>

@endsection
