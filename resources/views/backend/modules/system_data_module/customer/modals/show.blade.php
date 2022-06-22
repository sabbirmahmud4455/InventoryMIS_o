<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('Customer.Customer')  }} {{ __('Application.View') }} </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <table class="table table-bordered table-sm">
        <tbody>
            <tr>
                <td>{{ __('Customer.CustomerName') }}</td>
                <td>{{ $customer->name }}</td>
            </tr>

            <tr>
                <td>{{ __('Customer.CustomerPhone') }}</td>
                <td>{{ $customer->contact_no }}</td>
            </tr>

            <tr>
                <td>{{ __('Customer.CustomerAddress') }}</td>
                <td>{{ $customer->address }}</td>
            </tr>

            <tr>
                <td>{{ __('Customer.CustomerRemarks') }}</td>
                <td>{{ $customer->remarks }}</td>
            </tr>

            <tr>
                <td>{{ __('Application.Status') }}</td>
                <td>
                    @if ($customer->is_active)
                        <p class="badge badge-success">{{ __('Application.Active') }}</p>
                    @else
                        <p class="badge badge-danger">{{ __('Application.Inactive') }}</p>
                    @endif
                </td>
            </tr>

        </tbody>
    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Application.Close') }}</button>
</div>
