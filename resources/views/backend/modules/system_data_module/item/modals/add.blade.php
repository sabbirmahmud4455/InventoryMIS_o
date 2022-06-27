<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('Item.AddNewItem') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('item.add') }}">
        @csrf

        <div class="row">

            <!-- Item Types -->
            <div class="col-md-12 col-12 form-group">
                <label for="item_type_id">{{ __('Item.ItemType') }}</label>
                <select class="form-control select2" name="item_type_id">
                        <option disabled selected>{{ __('Item.SelectItemType') }}</option>
                        @foreach ($item_types as $item_type)
                            <option value="{{ $item_type->id }}">{{ $item_type->name }}</option>
                        @endforeach
                </select>
            </div>

            <!-- name -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">{{ __('Item.Name') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="name" required>
            </div>

            <!-- Item Code -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">{{ __('Item.ItemCode') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="item_code" required>
            </div>

            <!-- Item Variant Chek -->
            <div class="col-md-12 col-12 form-group">
                <input type="checkbox" name="item_variant_check" id="item_variant_check">
                <label for="item_variant_check">{{ __('Item.ItemVariantCheck') }}</label>
            </div>

            <!-- Item Variant -->
            <div class="col-md-12 col-12 d-none" id="item_variant">
                <label for="">{{ __('Item.ItemVariant') }}</label>
                <div class="row" style="margin: auto">
                    @foreach ($variants as $variant)
                        <div class="form-group form-check col-md-4 col-4">
                            <input type="checkbox" class="form-check-input item_variant" id="{{ $variant->id }}" name="variant_id[]" value="{{ $variant->id }}">
                            <label class="form-check-label" for="{{ $variant->id }}"> {{ $variant->name }} </label>
                        </div>
                    @endforeach
                </div>
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

<script>

    $(document).ready(function(){
        $('input:checkbox#item_variant_check').click(function(){
            if($(this).is(":checked")){
                $('#item_variant').removeClass('d-none');
            }
            else if($(this).is(":not(:checked)")){
                $('#item_variant').addClass('d-none');
                $('input:checkbox.item_variant').prop('checked', false);
            }
        });
    });

</script>

