<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> {{ $bank->name }}, {{ __('Application.Information') }} </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td>{{ __('Bank.BankName') }}</td>
                        <td>{{ $bank->name }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Bank.AccountName') }}</td>
                        <td>{{ $bank->account_name }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Bank.AccountNumber') }}</td>
                        <td>{{ $bank->account_no }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Bank.BranchName') }}</td>
                        <td>{{ $bank->branch_name }}</td>
                    </tr>
                    
                    <tr>
                        <td>{{ __('Application.Status') }}</td>
                        <td>
                            @if($bank->is_active == 1)
                                <span class="badge badge-success">{{ __('Application.Active') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('Application.Inactive') }}</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>{{ __('Application.CreatedDateTime') }}</td>
                        <td>{{ $bank->created_at->toDayDateTimeString() }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Application.LastUpdate') }}</td>
                        <td>{{ $bank->updated_at->toDayDateTimeString() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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
