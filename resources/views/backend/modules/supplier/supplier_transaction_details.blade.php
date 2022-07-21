<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('Supplier.SupplierTransactionDetails') }}</h5>
    <a href="{{ route('supplier.transaction.details.export.pdf', ['id' => $id]) }}" class="btn btn-sm btn-info float-right" style="margin-left: 300px;" target="_blank">{{ __('Application.Download') }}</a>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
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
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __("Application.Close") }}</button>
</div>
