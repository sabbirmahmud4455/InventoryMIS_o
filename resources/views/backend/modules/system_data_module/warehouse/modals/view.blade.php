<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"> {{ $unit->name }}, Information </h5>
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
                    <td>Name</td>
                    <td>{{ $unit->name }}</td>
                </tr>
                
                <tr>
                    <td>Status</td>
                    <td>
                        @if($unit->is_active == 1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">Inactive</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>Created Date & Time</td>
                    <td>{{ $unit->created_at->toDayDateTimeString() }}</td>
                </tr>

                <tr>
                    <td>Last Update</td>
                    <td>{{ $unit->updated_at->toDayDateTimeString() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
