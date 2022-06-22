<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('ItemType.EditItemType') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('item_type.update', encrypt($item_type->id)) }}">
        @csrf

        <div class="row">

            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                <label for="name">{{ __('ItemType.ItemName') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="name" value="{{ $item_type->name }}" required>
            </div>

            {{-- Status --}}
            <div class="col-md-12 col-12 form-group">
                <label for="is_active">{{ __('Application.Status') }}</label>
                <select name="is_active" class="form-control select2">
                    <option {{ $item_type->is_active == 1 ? 'selected' : '' }} value="1"> {{ __('Application.Active') }} </option>
                    <option {{ $item_type->is_active == 0 ? 'selected' : '' }} value="0"> {{ __('Application.Inactive') }} </option>
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

