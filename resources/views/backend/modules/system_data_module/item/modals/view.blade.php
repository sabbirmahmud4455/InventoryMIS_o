<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> {{ $item->name }}, {{ __('Application.Information') }} </h5>
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
                        <td>{{ __('Item.Name') }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Item.ItemType') }}</td>
                        <td>{{ $item->item_type->name }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Item.ItemVarient') }}</td>
                        <td>
                            @foreach ($item->item_varients as $item_varient)
                                {{ $item_varient->varient->name }} ,
                            @endforeach
                        </td>
                    </tr>
                    
                    <tr>
                        <td>{{ __('Application.Status') }}</td>
                        <td>
                            @if($item->is_active == 1)
                                <span class="badge badge-success">{{ __('Application.Active') }}</span>
                            @else
                                <span class="badge badge-danger">{{ __('Application.Inactive') }}</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>{{ __('Application.CreatedDateTime') }}</td>
                        <td>{{ $item->created_at->toDayDateTimeString() }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('Application.LastUpdate') }}</td>
                        <td>{{ $item->updated_at->toDayDateTimeString() }}</td>
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