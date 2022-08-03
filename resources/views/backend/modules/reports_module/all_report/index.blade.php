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
                                                <a href="{{ route('unit.report.index') }}" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.UnitReport') }}</a>
                                            @endif
                                            @if (can('variant_report'))
                                                <a href="{{ route('variant.report.index') }}" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.VariantReport') }}</a>
                                            @endif
                                            @if (can('item_type_report'))
                                                <a href="{{ route('item.type.report.index') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.ItemTypeReport') }}</a>
                                            @endif
                                            @if (can('warehouse_report'))
                                                <a href="{{ route('warehouse.report.index') }}" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.WarehouseReport') }}</a>
                                            @endif
                                            @if (can('transaction_type_report'))
                                                <a href="{{ route('transaction.type.report.index') }}" class="btn btn-sm btn-outline-dark all-report button_margin_bottom">{{ __('Report.TransactionTypeReport') }}</a>
                                            @endif
                                            @if (can('payment_type_report'))
                                                <a href="{{ route('payment.type.report.index') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.PaymentTypeReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--System Data Report End-->

                <!--Item Report Start-->
                @if (can('item_report'))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>{{ __('Report.ItemReport') }}</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can('all_item_report'))
                                                <a href="{{ route('all.item.report') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllItemReport') }}</a>
                                            @endif
                                            @if (can('unit_wise_item_report'))
                                                <a href="{{ route('unit.wise.item.report') }}" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">{{ __('Report.UnitWiseItemReport') }}</a>
                                            @endif
                                            @if (can('variant_wise_item_report'))
                                                <a href="{{ route('variant.wise.item.report') }}" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">{{ __('Report.VariantWiseItemReport') }}</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Item Report End-->

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
                                                <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllPurchaseReport') }}</a>
                                            @endif
                                            @if (can('date_wise_purchase_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary button_margin_bottom" data-toggle="modal" data-target="#dateWisePurchaseModal">{{ __('Report.DateWisePurchaseReport') }}</a>
                                            @endif
                                            @if (can('supplier_wise_purchase_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary button_margin_bottom" data-toggle="modal" data-target="#supplierWisePurchaseModal">{{ __('Report.SupplierWisePurchaseReport') }}</a>
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
                                                <a href="{{ route('stock.list') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.CurrentStockReport') }}</a>
                                            @endif
                                            @if (can('warehouse_wise_stock_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary button_margin_bottom" data-toggle="modal" data-target="#warehouseWiseStockModal">{{ __('Report.WarehouseWiseStockReport') }}</a>
                                            @endif
                                            @if (can('date_wise_stock_report'))
                                                <a href="" class="btn btn-sm btn-outline-primary button_margin_bottom" data-toggle="modal" data-target="#dateWiseStockModal">{{ __('Report.DateWiseStockReport') }}</a>
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
                                                <a href="{{ route('supplier.all') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllSupplierReport') }}</a>
                                            @endif
                                            @if (can('supplier_transaction_report'))
                                                <a href="" class="btn btn-sm btn-outline-secondary button_margin_bottom" data-toggle="modal" data-target="#supplierTransactionModal">{{ __('Report.SupplierTransactionReport') }}</a>
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
                                                <a href="{{ route('customer.all') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllCustomerReport') }}</a>
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
                                                <a href="{{ route('bank_report.all_bank') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllBankReport') }}</a>
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
                                                <a href="{{ route('transaction.all') }}" class="btn btn-sm btn-outline-success all-report button_margin_bottom">{{ __('Report.AllTransactionReport') }}</a>
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


<!-- Date wise purchase Report Modal Start -->
<div class="modal fade" id="dateWisePurchaseModal" role="dialog" aria-labelledby="dateWisePurchaseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dateWisePurchaseLabel">Select Date for Purchase Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <form action="{{ route('purchase.index') }}">
                    <!-- Date -->
                    <div class="col-md-12 col-12 form-group">
                        <center>
                            <input type="text" class="form-control" name="purchase_date">
                        </center>
                    </div>

                    <div class="col-md-12 form-group text-right">
                        <button type="submit" class="btn btn-sm btn-outline-dark">
                            {{ __('Application.Submit') }}
                        </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
</div>
<!-- Date wise purchase Report Modal Start -->

<!-- Supplier wise purchase Report Modal Start -->
<div class="modal fade" id="supplierWisePurchaseModal" role="dialog" aria-labelledby="supplierWisePurchaseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="supplierWisePurchaseLabel">Select Supplier for Purchase Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <form action="{{ route('purchase.index') }}">
                    <!-- supplier -->
                    <div class="col-md-12 col-12 form-group">
                        <label for="supplier_id">{{ __('Supplier.SupplierName') }}</label><span class="require-span">*</span>
                        <select class="form-control select2" name="supplier_id">
                            <option disabled selected>Select Supplier</option>
                            @if ( count($suppliers) > 0 )
                                @foreach ($suppliers as $supplier)
                                @php
                                @endphp
                                    <option value="{{ $supplier->id }}">{{ $supplier->name . ' - ' . $supplier->address }}</option>
                                @endforeach
                            @else
                                <option disabled>No Data Found</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-12 form-group text-right">
                        <button type="submit" class="btn btn-sm btn-outline-dark">
                            {{ __('Application.Submit') }}
                        </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
</div>
<!-- Supplier wise purchase Report Modal Start -->

<!-- Warehouse wise stock Report Modal Start -->
<div class="modal fade" id="warehouseWiseStockModal" role="dialog" aria-labelledby="warehouseWiseStockLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="warehouseWiseStockLabel">Select Warehouse for Stock Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <form action="{{ route('stock.list') }}">
                    <!-- supplier -->
                    <div class="col-md-12 col-12 form-group">
                        <label for="warehouse_id">{{ __('Warehouse.Warehouse') }}</label><span class="require-span">*</span>
                        <select class="form-control select2" name="warehouse_id">
                            <option disabled selected>Select Warehouse</option>
                            @if ( count($warehouses) > 0 )
                                @foreach ($warehouses as $warehouse)
                                @php
                                @endphp
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name . ' - ' . $warehouse->location }}</option>
                                @endforeach
                            @else
                                <option disabled>No Data Found</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-12 form-group text-right">
                        <button type="submit" class="btn btn-sm btn-outline-dark">
                            {{ __('Application.Submit') }}
                        </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
</div>
<!-- Warehouse wise stock Report Modal Start -->


<!-- Date wise stock Report Modal Start -->
<div class="modal fade" id="dateWiseStockModal" role="dialog" aria-labelledby="dateWiseStockLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dateWiseStockLabel">Select Date for Stock Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <form action="{{ route('stock.list') }}">
                    <!-- Date -->
                    <div class="col-md-12 col-12 form-group">
                        <center>
                            <input type="text" class="form-control" name="stock_date">
                        </center>
                    </div>

                    <div class="col-md-12 form-group text-right">
                        <button type="submit" class="btn btn-sm btn-outline-dark">
                            {{ __('Application.Submit') }}
                        </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
</div>
<!-- Date wise stock Report Modal Start -->

<!-- Supplier Transaction Report Modal Start -->
<div class="modal fade" id="supplierTransactionModal" role="dialog" aria-labelledby="supplierTransactionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="supplierTransactionLabel">Select Supplier for Transaction Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <div class="modal-body">
                <form action="{{ route('supplier.transactions', encrypt($supplier->id)) }}">
                    <!-- supplier -->
                    <div class="col-md-12 col-12 form-group">
                        <label for="supplier_id">{{ __('Supplier.SupplierName') }}</label><span class="require-span">*</span>
                        <select class="form-control select2" name="supplier_id">
                            <option disabled selected>Select Supplier</option>
                            @if ( count($suppliers) > 0 )
                                @foreach ($suppliers as $supplier)
                                @php
                                @endphp
                                    <option value="{{ $supplier->id }}">{{ $supplier->name . ' - ' . $supplier->address }}</option>
                                @endforeach
                            @else
                                <option disabled>No Data Found</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-12 form-group text-right">
                        <button type="submit" class="btn btn-sm btn-outline-dark">
                            {{ __('Application.Submit') }}
                        </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
</div>
<!-- Supplier Transaction Report Modal Start -->



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
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#supplierWisePurchaseModal')
        });
    });

    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#warehouseWiseStockModal')
        });
    });

    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#supplierTransactionModal')
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

<!-- DatePicker JS -->
<script>
    $(function() {
        $('input[name="purchase_date"]').daterangepicker({
        opens: 'left'
        }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
<script>
    $(function() {
        $('input[name="stock_date"]').daterangepicker({
        opens: 'left'
        }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- DatePicker JS -->


@endsection
