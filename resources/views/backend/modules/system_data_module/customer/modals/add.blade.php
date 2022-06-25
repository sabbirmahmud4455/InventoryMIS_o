<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ __('Customer.CustomerAdd') }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('customer.add') }}">
        @csrf

        <div class="row">

            <!-- name -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">{{ __('Customer.CustomerName') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="name" >
            </div>

            <!-- phone number -->
            <div class="col-md-6 col-12 form-group">
                <label for="phone">{{ __('Customer.CustomerPhone') }}</label><span class="require-span">*</span>
                <input id="phone" type="text" class="form-control" name="phone">
            </div>

            <div class="col-12 form-group">
                <label for="Address">{{ __('Customer.CustomerAddress') }}</label>
                <textarea class="form-control" name="address" id="Address" cols="30" rows="2"></textarea>
            </div>

            <div class="col-12 form-group">
                <label for="Remarks">{{ __('Customer.CustomerRemarks') }}</label>
                <textarea class="form-control" name="remarks" id="Remarks" cols="30" rows="2"></textarea>
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    {{ __('Application.Add') }}
                </button>
            </div>

        </div>
    </form>
</div>
<div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __("Application.Close") }}</button>
 </div>



