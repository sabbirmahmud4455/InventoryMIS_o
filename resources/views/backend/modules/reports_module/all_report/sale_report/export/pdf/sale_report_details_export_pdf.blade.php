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
    <div class="card-header">
        <div class="col-md-6" style="text-align: center;margin-top: 14px;">
            <img src="{{ public_path("images/company_info/".$company_info->reporting_logo) }}" height="50px" width="50px">
            <br>
            <span style="font-size: 20px;font-weight: bold">{{ $company_info->name }}</span><br>
            <span style="font-size: 15px;">{{ $company_info->address }}</span><br>
            <span style="font-size: 15px;">Conatct No : {{ $company_info->phone }}, Email : {{ $company_info->email }}</span><br>
            <hr>

            <h3 style="font-size: 15px">{{ $title }}</h3>
        </div>
    </div>
    <!-- Company Info End -->

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card card-primary card-outline table-responsive">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm table-bordered" style="margin-bottom: 10px;">
                                    <tbody>
                                    <tr>
                                        <th>{{ __('Application.Date') }}</th>
                                        <td>{{ $sale_details['sale'][0]->date }}</td>
                                        <th>{{ __('Application.ChallanNo') }}</th>
                                        <td>{{ $sale_details['sale'][0]->challan_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Customer.CustomerName') }}</th>
                                        <td>{{ $sale_details['sale'][0]->customer_name }}</td>
                                        <th>{{ __('Customer.CustomerPhone') }}</th>
                                        <td>{{ $sale_details['sale'][0]->customer_phone }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Item.Item') }}</th>
                                        <th>{{ __('Variant.Variant') }}</th>
                                        <th>{{ __('Unit.Unit') }}</th>
                                        <th>{{ __('Lot.Lot') }}</th>
                                        <th>{{ __('Sale.Quantity') }}</th>
                                        <th>{{ __('Sale.UnitPrice') }}</th>
                                        <td>{{ __('Sale.TotalPrice') }}</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sale_details['sale_details'] as $sale_detail)
                                        <tr>
                                            <td>{{ $sale_detail->item_name }}</td>
                                            <td>{{ $sale_detail->variant_name }}</td>
                                            <td>{{ $sale_detail->unit_name }}</td>
                                            <td>{{ $sale_detail->lot_name }}</td>
                                            <td>{{ $sale_detail->quantity }}</td>
                                            <td>{{ '৳ ' . number_format($sale_detail->unit_price, 0) }}</td>
                                            <td>{{ '৳ ' . number_format($sale_detail->total_price, 0) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
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

