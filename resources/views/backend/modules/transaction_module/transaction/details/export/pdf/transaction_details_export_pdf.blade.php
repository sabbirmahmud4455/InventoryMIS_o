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
                            <th>{{ __('Application.CreatedBy') }}</th>
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

