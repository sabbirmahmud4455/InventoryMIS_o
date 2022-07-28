@extends("backend.template.layout")

@section('per_page_css')

<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

<!-- DatePicker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- DatePicker CSS -->

<style>
    .select2-container {
        z-index: 9999 !important;
    }
    .button_margin_bottom{
        margin-bottom: 5px;
    }
</style>

@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                {{ __('Application.Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                {{ __('Report.AllReport') }}
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

                <!--System Data Report Start-->
                @if (can('system_data_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.SystemDataReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('unit_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.UnitReport') }}</a>
                                            @endif
                                            @if (can('variant_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.VariantReport') }}</a>
                                            @endif
                                            @if (can('item_type_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.ItemTypeReport') }}</a>
                                            @endif
                                            @if (can('warehouse_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.WarehouseReport') }}</a>
                                            @endif
                                            @if (can('transaction_type_report'))
                                                <a href="" class="btn btn-sm btn-outline-dark all-report button_margin_bottom">{{ __('Report.TransactionTypeReport') }}</a>
                                            @endif
                                            @if (can('payment_type_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.PaymentTypeReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--System Data Report End-->

                <!--Product Report Start-->
                @if (can('product_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.ProductReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('unit_wise_product_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.UnitWiseProductReport') }}</a>
                                            @endif
                                            @if (can('variant_wise_product_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.VariantWiseProductReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Product Report End-->.

                <!--Purchase Report Start-->
                @if (can('purchase_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.PurchaseReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('all_purchase_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllPurchaseReport') }}</a>
                                            @endif
                                            @if (can('date_wise_purchase_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.DateWisePurchaseReport') }}</a>
                                            @endif
                                            @if (can('supplier_wise_purchase_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.SupplierWisePurchaseReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Purchase Report End-->

                <!--Stock Report Start-->
                @if (can('stock_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.StockReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('current_stock_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.CurrentStockReport') }}</a>
                                            @endif
                                            @if (can('warehouse_wise_stock_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.WarehouseWiseStockReport') }}</a>
                                            @endif
                                            @if (can('date_wise_stock_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.DateWiseStockReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Stock Report End-->

                <!--Supplier Report Start-->
                @if (can('supplier_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.SupplierReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('all_supplier_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllSupplierReport') }}</a>
                                            @endif
                                            @if (can('supplier_transaction_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.SupplierTransactionReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Supplier Report End-->

                <!--Customer Report Start-->
                @if (can('customer_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.CustomerReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('all_customer_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllCustomerReport') }}</a>
                                            @endif
                                            @if (can('customer_transaction_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.CustomerTransactionReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Customer Report End-->

                <!--Sale Report Start-->
                @if (can('sale_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.SaleReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('all_sale_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllSaleReport') }}</a>
                                            @endif
                                            @if (can('date_wise_sale_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.DateWiseSaleReport') }}</a>
                                            @endif
                                            @if (can('customer_wise_sale_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.CustomerWiseSaleReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Sale Report End-->

                <!--Bank Report Start-->
                @if (can('bank_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.BankReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('all_bank_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllBankReport') }}</a>
                                            @endif
                                            @if (can('bank_transaction_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.BankTransactionReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Bank Report End-->

                <!--Transaction Report Start-->
                @if (can('transaction_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.TransactionReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('all_transaction_report'))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllTransactionReport') }}</a>
                                            @endif
                                            @if (can('type_wise_transaction_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.TypeWiseTransactionReport') }}</a>
                                            @endif
                                            @if (can('statement_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.StatementReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Transaction Report End-->


            </div>
        </div>
    </section>
</div>



@endsection



@section('per_page_js')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>

<script src="{{ asset('backend/js/datatable/jquery.validate.js') }}"></script>
<script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/datatable/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#myModal')
        });
    });

</script>

<script>
    $(function() {
        $('.all-report').on('click', function(e) {
            $(".loading").show()
        });
    });
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- DatePicker JS -->


@endsection
