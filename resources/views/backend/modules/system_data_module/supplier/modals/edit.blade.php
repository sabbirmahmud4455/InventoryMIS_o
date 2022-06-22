<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('Supplier.Supplier')  }} {{ __('Application.Edit') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('supplier.update', $supplier->id) }}">
        @csrf

        <div class="row">
           <!-- name -->
           <div class="col-md-6 col-12 form-group">
                <label for="name">{{ __('Supplier.SupplierName') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="name" value="{{ $supplier->name }}" >
            </div>

            <!-- phone number -->
            <div class="col-md-6 col-12 form-group">
                <label for="phone">{{ __('Supplier.SupplierPhone') }}</label><span class="require-span">*</span>
                <input id="phone" type="text" class="form-control" name="phone"  value="{{ $supplier->contact_no }}">
            </div>

            <div class="col-12 form-group">
                <label for="Address">{{ __('Supplier.SupplierAddress') }}</label>
                <textarea class="form-control" name="address" id="Address" cols="30" rows="2">{{ $supplier->address }}</textarea>
            </div>

            <div class="col-12 form-group">
                <label for="Remarks">{{ __('Supplier.SupplierRemarks') }}</label>
                <textarea class="form-control" name="remarks" id="Remarks" cols="30" rows="2">{{ $supplier->remarks }}</textarea>
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
