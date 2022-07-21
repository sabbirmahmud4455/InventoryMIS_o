<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: FreeSerif;
        }
        body{
            font-family: FreeSerif;
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
            
                        {{-- Date and Code --}}
                        <tr>
                            <td>{{ __('Application.Date') }}</td>
                            <td>{{ $transaction_details['transactions']->transaction_date }}</td>
            
                            <td>{{ __('Transaction.TransactionCode') }}</td>
                            <td>{{ $transaction_details['transactions']->transaction_code }}</td>
                        </tr>
            
                        {{-- Amount and Status --}}
                        <tr>
                            <td>{{ __('Transaction.TransactionAmount') }}</td>
                            <td>
                                {{ $transaction_details['transactions']->cash_in ? number_format($transaction_details['transactions']->cash_in,0) : number_format($transaction_details['transactions']->cash_out,0) }}
                            </td>
            
                            <td>{{ __('Application.Status') }}</td>
                            <td>
                                @if ($transaction_details['transactions']->transaction_status == 'PENDING')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($transaction_details['transactions']->transaction_status == 'RECEIVED')
                                    <span class="badge badge-success">Received</span>
                                @elseif ( $transaction_details['transactions']->transaction_status == 'SEND')
                                    <span class="badge badge-info">Send</span>
                                @elseif ( $transaction_details['transactions']->transaction_status == 'CANCEL')
                                    <span class="badge badge-danger">Cancel</span>
                                @elseif ( $transaction_details['transactions']->transaction_status == 'BOUNCE')
                                    <span class="badge badge-primary">Bounce</span>
                                @endif
                            </td>
                        </tr>
            
                        <tr>
                            <td>{{ __('Transaction.Narration') }}</td>
                            <td colspan="3">{{ $transaction_details['transactions']->narration }}</td>
                        </tr>
            
                        <tr>
                            <td>{{ __('Application.Remarks') }}</td>
                            <td colspan="3">{{ $transaction_details['transactions']->transaction_remarks ? $transaction_details['transactions']->transaction_remarks : 'N/A' }}</td>
                        </tr>
            
                        {{-- Transaction Type Information --}}
                        <tr>
                            <td>{{ __('TransactionType.TransactionType') }}</td>
                            <td colspan="3">{{ $transaction_details['transactions']->bank_name ? __('Purchase.Bank') : __('Purchase.Cash') }}</td>
                        </tr>
            
                        @if ($transaction_details['transactions']->bank_name)
                        <tr>
                            <td>{{ __('Bank.BankName') }}</td>
                            <td>{{ $transaction_details['transactions']->bank_name }}</td>
            
                            <td>{{ __('Bank.AccountName') }}</td>
                            <td>{{ $transaction_details['transactions']->bank_account_name }}</td>
                        </tr>
            
                        <tr>
                            <td>{{ __('Bank.AccountNumber') }}</td>
                            <td>{{ $transaction_details['transactions']->bank_account_no }}</td>
            
                            <td>{{ __('Bank.ChequeNo') }}</td>
                            <td>{{ $transaction_details['transactions']->cheque_no }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            
                @if (!empty($transaction_details['purchase_details']))
                      {{-- Purchase Details --}}
                      <span class="badge badge-info">{{ __('Purchase.ViewPurchaseInfo') }}</span>
                      <table class="table table-sm table-bordered">
                          <thead>
                              <th>{{ __('Application.SerialNo') }}</th>
                              <th>{{ __('Lot.LotName') }}</th>
                              <th>{{ __('Item.Item') }}</th>
                              <th>{{ __('Purchase.Weight') }}</th>
                              <th>{{ __('Unit.Unit') }}</th>
                              <th>{{ __('Purchase.Price') }}</th>
                              <th>{{ __('Purchase.TotalPrice') }}</th>
                          </thead>
            
                          <tbody>
                              @forelse ($transaction_details['purchase_details'] as $key => $purchase_details)
                                  <tr>
                                      <td>{{ $key + 1 }}</td>
                                      <td>{{ $purchase_details->lot_name }}</td>
                                      <td>{{ $purchase_details->item_name }}</td>
                                      <td>{{ $purchase_details->varient_name }}</td>
                                      <td>{{ $purchase_details->unit_name }}</td>
                                      <td>{{ $purchase_details->unit_price }}</td>
                                      <td>{{ $purchase_details->total_price }}</td>
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

