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
                                <a href="{{ route('sale.index') }}">
                                    {{ __('Sale.AllSale') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Sale.SaleInvoice') }}
                                </a>
                            </li>
                        </ol>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <a href="{{ route('sale.invoice.export.pdf', ['id' => encrypt($sale_details['sale'][0]->id)]) }}" target="_blank" class="btn btn-sm btn-info float-right">{{ __("Application.Download") }}</a>
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <center>
                                            <h4 class="btn btn-info rounded-pill">নগদ/বাকী/মেমো</h4>
                                            <h1>মেসার্স মান্নান এন্টারপ্রাইজ</h1>
                                            <h4 class="btn btn-info rounded-pill">প্রোঃ মোঃ আওলাদ হোসেন</h4>
                                            <h6>প্রসিদ্ধ ধান, চাউল, ভূষা মালের আড়ৎ ও পাইকারী বিক্রেতা।</h6>
                                            <h6>বলিভদ্র বাজার, রপ্তানী এলাকা, আশুলিয়া, সাভার, ঢাকা।</h6>
                                            <p> <span style="float:left">নং- {{ $sale_details['sale'][0]->challan_no }} </span>  <span style="float:right">তারিখ- {{ $sale_details['sale'][0]->date }} </span> </p>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ক্রেতার নাম</span>
                                                </div>
                                                <input type="text" value="{{ $sale_details['sale'][0]->customer_name }}" class="form-control" readonly>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ঠিকানা</span>
                                                </div>
                                                <input type="text" value="{{ $sale_details['sale'][0]->customer_address }}" class="form-control" readonly>
                                            </div>
                                            <table class="table table-sm table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>লট নং</th>
                                                        <th>মালের বিবরণ</th>
                                                        <th>বস্তা</th>
                                                        <th>ওজন</th>
                                                        <th>দর</th>
                                                        <th>টাকা</th>
                                                    </tr>
                                                </thead>
                                                @php
                                                    $total_price = 0;
                                                    $total_quantity = 0;
                                                @endphp
                                                <tbody>
                                                    @foreach($sale_details['sale_details'] as $sale_detail)
                                                        <tr>
                                                            <td>{{ $sale_detail->lot_name }}</td>
                                                            <td>{{ $sale_detail->item_name }}</td>
                                                            <td>{{ $sale_detail->quantity }}</td>
                                                            @php
                                                            $total_quantity += $sale_detail->quantity;
                                                            @endphp
                                                            <td>{{ $sale_detail->variant_name }}</td>
                                                            <td>{{ '৳ ' . number_format($sale_detail->unit_price, 0) }}</td>
                                                            <td>{{ '৳ ' . number_format($sale_detail->total_price, 0) }}</td>
                                                        </tr>
                                                        @php
                                                            $total_price += $sale_detail->total_price;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfooter>
                                                    <tr>
                                                        <td colspan="4" rowspan="5"></td>
                                                        <th>মোট-</th>
                                                        <td>{{ '৳ ' . number_format($total_price, 0) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>সাবেক-</th>
                                                        <td>{{ '৳ ' . number_format($customer_previous_balance, 0) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>সর্বমোট-</th>
                                                        @php
                                                            $grand_total = $total_price + $customer_previous_balance;
                                                        @endphp
                                                        <td>{{ '৳ ' . number_format($grand_total, 0) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>জমা-</th>
                                                        @php
                                                            $deposit = count($sale_details['sale_transaction']) > 1 ? $sale_details['sale_transaction'][1]->cash_in : 0;
                                                        @endphp
                                                        <td>{{ '৳ ' . number_format($deposit, 0) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>বাকী-</th>
                                                        @php
                                                            $due = $grand_total - $deposit;
                                                        @endphp
                                                        <td>{{ '৳ ' . number_format($due, 0) }}</td>
                                                    </tr>
                                                </tfooter>
                                            </table>
                                            <p>বিঃ দ্রঃ উল্লেখিত সমস্ত মাল ওজনে সঠিক দরে নমুনা অনুযায়ী বুঝিয়া পাইলাম।</p>
                                            <p> <span style="float: left">ক্রেতার স্বাক্ষর</span> <span style="float: right">মেসার্স মান্নান এন্টারপ্রাইজ - এর পক্ষে</span></p>
                                            <br>
                                            <hr>
                                            <h1>মেসার্স মান্নান এন্টারপ্রাইজ</h1>
                                            <h6>রপ্তানি প্রমান পত্র</h6>
                                            <p> <span style="float:left">নং- {{ $sale_details['sale'][0]->challan_no }} </span>  <span style="float:right">তারিখ- {{ $sale_details['sale'][0]->date }} </span> </p>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ক্রেতার নাম</span>
                                                </div>
                                                <input type="text" value="{{ $sale_details['sale'][0]->customer_name }}" class="form-control" readonly>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">বস্তা পরিমান</span>
                                                </div>
                                                <input type="text" value="{{ $total_quantity }}" class="form-control" readonly>
                                            </div>
                                        </center>
                                    </div>
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
    <script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function domReady() {
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%',
                // matcher: matchStart
            });
        });
    </script>

@endsection
