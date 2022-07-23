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

        <!-- Employee Details Start -->
        <div class="row">
            <div class="col-md-12">
                @if ($supplier_transactions && count($supplier_transactions) > 0)
                    <table class="table table-bordered table-sm">
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
                            @forelse ($supplier_transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ $transaction->transaction_code }}</td>
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

                @else
                    <h4 class="not-found-txt">No data found</h4>
                @endif
            </div>
        </div>
        <!-- Employee Details End -->




    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->getFont("helvetica", "regular");
            $pdf->page_text(50, 816, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
        }
    </script>

</body>
</html>

