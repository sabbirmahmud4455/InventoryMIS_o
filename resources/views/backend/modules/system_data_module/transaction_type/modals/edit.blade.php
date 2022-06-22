<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $transaction_type->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('transaction.type.edit',$transaction_type->id) }}">
        @csrf

        <div class="row">

            <!-- name -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">{{ __('TransactionType.Name') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="name" value="{{ $transaction_type->name }}" required>
            </div>

            <!-- Cash Type -->
            <div class="col-md-6 col-12 form-group">
                <label for="cash_type">{{ __('TransactionType.CashType') }}</label>
                <select class="form-control select2" name="cash_type">
                    <option disabled>{{ __('TransactionType.SelectCashType') }}</option>
                    <option value="Cash In" @if( $transaction_type->cash_type == 'Cash In' ) selected @endif>{{ __('TransactionType.CashIn') }}</option>
                    <option value="Cash Out" @if( $transaction_type->cash_type == 'Cash Out' ) selected @endif>{{ __('TransactionType.CashOut') }}</option>
                </select>
            </div>

            

            <!-- Status -->
            <div class="col-md-12 col-12 form-group">
                <label for="is_active">{{ __('Application.Status') }}</label>
                <select class="form-control select2" name="is_active">
                    <option value="1" @if( $transaction_type->is_active == true ) selected @endif>{{ __('Application.Active') }}</option>
                    <option value="0" @if( $transaction_type->is_active == false ) selected @endif>{{ __('Application.Inactive') }}</option>
                </select>
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    {{ __('Application.Update') }}
                </button>
            </div>

        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Application.Close') }}</button>
</div>


<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#myModal')
        });
    });
</script>

