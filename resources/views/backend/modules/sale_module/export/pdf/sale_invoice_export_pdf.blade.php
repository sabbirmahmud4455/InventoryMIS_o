<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: nikosh;
        }
        body{
            font-family: nikosh;
        }
        /* table {
            border:none;
        } */
        /* table tr, table tr td{
            border:none;
        } */

        table, tr, tr{
            width: 100%;
        }

        .table,.table td, .table th, .table tr {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 3px;
            /* width:100%; */
        }

        .w-25{
            width: 25%
        }

        .lbl {
            text-align: left;
            margin-left: 4px !important;
            /* font-size: 15px !important; */
        }

        .space {
            margin-left: 6px !important;
        }

        .margin_up {
            margin-top: 0px;
            margin-left: 32% !important;
        }

        .sl-no {
            width: 15% !important;
        }

        .not-found-txt {
            color: red;
            /* font-size: 10px; */
            text-align: center;
        }

        .mrg{
            margin-left: 50% !important;
        }

    </style>
</head>

<body style="width: 90%;margin: auto;">
<div class="card">
    <!-- Company Info Start -->
    {{--<div class="card-header">
        <div class="col-md-6" style="text-align: center;margin-top: 14px;">
            <img src="{{ public_path("images/company_info/".$company_info->reporting_logo) }}" height="50px" width="50px">
            <br>
            <span style="font-size: 20px;font-weight: bold">{{ $company_info->name }}</span><br>
            <span style="font-size: 15px;">{{ $company_info->address }}</span><br>
            <span style="font-size: 15px;">Conatct No : {{ $company_info->phone }}, Email : {{ $company_info->email }}</span><br>
            <hr>

            <h3 style="font-size: 15px">{{ $title }}</h3>
        </div>
    </div>--}}
    <!-- Company Info End -->

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-primary card-outline table-responsive">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <center>
                                    <h4 class="btn btn-info rounded-pill">নগদ/বাকী/মেমো</h4>
                                    <h1>মেসার্স মান্নান এন্টারপ্রাইজ</h1>
                                    <h4 class="btn btn-info rounded-pill">প্রোঃ মোঃ আওলাদ হোসেন</h4>
                                    <h5>প্রসিদ্ধ ধান, চাউল, ভূষা মালের আড়ৎ ও পাইকারী বিক্রেতা।</h5>
                                    <h5>বলিভদ্র বাজার, রপ্তানী এলাকা, আশুলিয়া, সাভার, ঢাকা।</h5>
                                    <p> <span style="margin-right: 100px;">নং- {{ $sale_details['sale'][0]->challan_no }} </span>  <span style="margin-left: 100px;">তারিখ- {{ $sale_details['sale'][0]->date }} </span> </p>
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
                                        @endphp
                                        <tbody>
                                        @foreach($sale_details['sale_details'] as $sale_detail)
                                            <tr>
                                                <td>{{ $sale_detail->lot_name }}</td>
                                                <td>{{ $sale_detail->item_name }}</td>
                                                <td>{{ $sale_detail->quantity }}</td>
                                                <td>{{ $sale_detail->variant_name }}</td>
                                                <td>{{ '৳ ' . number_format($sale_detail->unit_price, 0) }}</td>
                                                <td>{{ '৳ ' . number_format($sale_detail->total_price, 0) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="4" rowspan="5"></td>
                                                <td>মোট-</td>
                                                <td>{{ '৳ ' . number_format($total_price, 0) }}</td>
                                            </tr>
                                            <tr>
                                                <td>সাবেক-</td>
                                                <td>{{ '৳ ' . number_format($customer_previous_balance, 0) }}</td>
                                            </tr>
                                            <tr>
                                                <td>সর্বমোট-</td>
                                                @php
                                                    $grand_total = $total_price + $customer_previous_balance;
                                                @endphp
                                                <td>{{ '৳ ' . number_format($grand_total, 0) }}</td>
                                            </tr>
                                            <tr>
                                                <td>জমা-</td>
                                                @php
                                                    $deposit = $sale_details['sale_transaction'][1]->cash_in;
                                                @endphp
                                                <td>{{ '৳ ' . number_format($deposit, 0) }}</td>
                                            </tr>
                                            <tr>
                                                <td>বাকী-</td>
                                                @php
                                                    $due = $grand_total - $deposit;
                                                @endphp
                                                <td>{{ '৳ ' . number_format($due, 0) }}</td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




</div>

<script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->getFont("helvetica", "regular");
            $pdf->page_text(50, 816, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
        }
    </script>

</body>
</html>

