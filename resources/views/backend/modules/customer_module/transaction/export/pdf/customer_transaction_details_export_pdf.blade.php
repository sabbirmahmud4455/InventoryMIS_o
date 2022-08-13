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
                <table class="table table-sm table-bordered">
                    <tbody>

                    {{-- Date and Code --}}
                    <tr>
                        <td>{{ __('Application.Date') }}</td>
                        <td>{{ $customer_transaction_details->date }}</td>

                        <td>{{ __('Transaction.TransactionCode') }}</td>
                        <td>{{ $customer_transaction_details->transaction_code }}</td>
                    </tr>

                    {{-- Amount and Status --}}
                    <tr>
                        <td>{{ __('Transaction.TransactionAmount') }}</td>
                        <td>
                            {{ $customer_transaction_details->cash_in ? number_format($customer_transaction_details->cash_in,0) : number_format($customer_transaction_details->cash_out,0) }}
                        </td>

                        <td>{{ __('Application.Status') }}</td>
                        <td>
                            @if ($customer_transaction_details->status == 'PENDING')
                                <span class="badge badge-warning">Pending</span>
                            @elseif ($customer_transaction_details->status == 'RECEIVED')
                                <span class="badge badge-success">Received</span>
                            @elseif ( $customer_transaction_details->status == 'SEND')
                                <span class="badge badge-info">Send</span>
                            @elseif ( $customer_transaction_details->status == 'CANCEL')
                                <span class="badge badge-danger">Cancel</span>
                            @elseif ( $customer_transaction_details->status == 'BOUNCE')
                                <span class="badge badge-primary">Bounce</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>{{ __('Transaction.Narration') }}</td>
                        <td colspan="3">{{ $customer_transaction_details->narration }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Application.Remarks') }}</td>
                        <td colspan="3">{{ $customer_transaction_details->remarks ? $customer_transaction_details->remarks : 'N/A' }}</td>
                    </tr>

                    {{-- Transaction Type Information --}}
                    <tr>
                        <td>{{ __('TransactionType.TransactionType') }}</td>
                        <td colspan="3">{{ $customer_transaction_details->bank_id ? __('Sale.Bank') : __('Sale.Cash') }}</td>
                    </tr>

                    @if ($customer_transaction_details->bank_id)
                        <tr>
                            <td>{{ __('Bank.BankName') }}</td>
                            <td>{{ $customer_transaction_details->bank->name }}</td>

                            <td>{{ __('Bank.AccountName') }}</td>
                            <td>{{ $customer_transaction_details->bank->account_name }}</td>
                        </tr>

                        <tr>
                            <td>{{ __('Bank.AccountNumber') }}</td>
                            <td>{{ $customer_transaction_details->bank->account_no }}</td>

                            <td>{{ __('Bank.ChequeNo') }}</td>
                            <td>{{ $customer_transaction_details->cheque_no }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                @if (!empty($customer_transaction_details->sale_id))
                    {{-- Sale Details --}}
                    <span class="badge badge-info">{{ __('Sale.ViewSaleInfo') }}</span>
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>{{ __('Application.SerialNo') }}</th>
                            <th>{{ __('Lot.LotName') }}</th>
                            <th>{{ __('Item.Item') }}</th>
                            <th>{{ __('Sale.Weight') }}</th>
                            <th>{{ __('Unit.Unit') }}</th>
                            <th>{{ __('Sale.UnitPrice') }}</th>
                            <th>{{ __('Sale.TotalPrice') }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($customer_transaction_details->sale->sale_details as $key => $sale_details)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sale_details->lot->name }}</td>
                                <td>{{ $sale_details->item->name }}</td>
                                <td>{{ $sale_details->variant->name }}</td>
                                <td>{{ $sale_details->unit->name }}</td>
                                <td>{{ $sale_details->unit_price }}</td>
                                <td>{{ $sale_details->total_price }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    <span class="badge badge-danger">No Data Found!!</span>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
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

