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
                @if ($transaction_types && count($transaction_types) > 0)
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>{{ __('Application.SerialNo') }}</th>
                                <th>{{ __('TransactionType.TransactionType') }}</th>
                                <th>{{ __('TransactionType.CashType') }}</th>
                                <th>{{ __('Transaction.TransactionAmount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction_types as $key => $transaction_type)
                                <tr>
                                    <td style="text-align: center">{{ ++ $key }}</td>
                                    <td style="text-align: center">{{ $transaction_type->name }}</td>
                                    <td style="text-align: center">{{ $transaction_type->cash_type }}</td>
                                    @php
                                        $cash_in = $transaction_type->transactions->sum('cash_in');
                                        $cash_out = $transaction_type->transactions->sum('cash_out');
                                    @endphp
                                    <td style="text-align: center">{{ '৳ ' . number_format($cash_in - $cash_out,) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class="text-center text-danger my-2 not-found-txt">{{ __('Application.NoDataFound') }}</h4>
                @endif

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

