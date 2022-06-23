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

            <!-- Item Varient Chek -->
            <div class="col-md-12 col-12 form-group">
                <input type="checkbox" name="item_varient_check" id="item_varient_check">
                <label for="item_varient_check">{{ __('Item.ItemVarientCheck') }}</label>
            </div>

            <!-- Item Varient -->
            <div class="col-md-12 col-12 d-none" id="item_varient">
                <label for="">{{ __('Item.ItemVarient') }}</label>
                <div class="row" style="margin: auto">
                    @foreach ($varients as $varient)
                        <div class="form-group form-check col-md-4 col-4">
                            <input type="checkbox" class="form-check-input item_varient" id="{{ $varient->id }}" name="varient_id[]" value="{{ $varient->id }}">
                            <label class="form-check-label" for="{{ $varient->id }}"> {{ $varient->name }} </label>
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
        $('input:checkbox#item_varient_check').click(function(){
            if($(this).is(":checked")){
                $('#item_varient').removeClass('d-none');
            }
            else if($(this).is(":not(:checked)")){
                $('#item_varient').addClass('d-none');
                $('input:checkbox.item_varient').prop('checked', false);
            }
        });
    });

</script>

