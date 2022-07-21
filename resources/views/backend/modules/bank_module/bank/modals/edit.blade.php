<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $bank->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('bank.edit',$bank->id) }}">
        @csrf

        <div class="row">

            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">{{ __('Bank.BankName') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="name" value="{{ $bank->name }}" required>
            </div>

            <!-- Account Name -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">{{ __('Bank.AccountName') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="account_name" value="{{ $bank->account_name }}" required>
            </div>

            <!-- Account Number -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">{{ __('Bank.AccountNumber') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="account_no" value="{{ $bank->account_no }}" required>
            </div>

            <!-- Branch Name -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">{{ __('Bank.BranchName') }}</label>
                <input type="text" class="form-control" name="branch_name" value="{{ $bank->branch_name }}" required>
            </div>

            @if (count($bank->transactions) === 0)
                <!-- Openning Banlance -->
                <div class="col-md-12 col-12 form-group">
                    <label for="name">{{ __('Bank.OpeningBalance') }}</label>
                    <input type="text" class="form-control" name="opening_balance" required>
                </div>
            @endif
            

            <!-- Status -->
            <div class="col-md-12 col-12 form-group">
                <label for="is_active">{{ __('Application.Status') }}</label>
                <select class="form-control select2" name="is_active">
                        <option value="1" @if( $bank->is_active == true ) selected @endif>{{ __('Application.Active') }}</option>
                        <option value="0" @if( $bank->is_active == false ) selected @endif>{{ __('Application.Inactive') }}</option>
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

