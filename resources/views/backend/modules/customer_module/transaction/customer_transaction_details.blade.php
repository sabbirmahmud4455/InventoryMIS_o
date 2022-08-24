<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('Customer.TransactionDetails') }}</h5>
    <a href="{{ route('customer.transaction.details.export.pdf', ['id' => $id]) }}" class="btn btn-sm btn-info float-right" style="margin-left: 300px;" target="_blank">{{ __('Application.Download') }}</a>
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
                <td colspan="3">{{ $customer_transaction_details->bank_id ? __('Purchase.Bank') : __('Purchase.Cash') }}</td>
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
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __("Application.Close") }}</button>
</div>
