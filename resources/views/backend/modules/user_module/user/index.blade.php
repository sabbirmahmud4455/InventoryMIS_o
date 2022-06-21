@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
    .password-box{
        position: relative;
    }
    .password-box .hide-password{
        display: none;
    }
    .password-box .fas{
        position: absolute;
        top: 57%;
        right: 15px;
        z-index : 10;
        cursor : pointer;
    }
</style>
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                {{ __('Application.Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                {{ __('User.AllUser') }}
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-header text-right">
                            @if( can('add_user') )
                            <button type="button" data-content="{{ route('user.add.modal') }}" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                                {{ __('User.Add') }}
                            </button>
                            @endif
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline user-datatable" id="datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('User.Id') }}</th>
                                        <th>{{ __('User.User') }}</th>
                                        <th>{{ __('Role.Role') }}</th>
                                        <th>{{ __('User.Status') }}</th>
                                        <th>{{ __('User.Action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>

<script src="{{ asset('backend/js/datatable/jquery.validate.js') }}"></script>
<script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/datatable/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

<script>
    $(function () {
        $('.user-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.data') }}",
            order: [
                [0, 'Desc']
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'is_active',
                    name: 'is_active'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    });
    
</script>
@endsection
