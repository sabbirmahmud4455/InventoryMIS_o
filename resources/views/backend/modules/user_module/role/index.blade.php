@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
    .sub_module_block ul {
        padding-left: 15px !important;
    }

    .sub_module_block ul p {
        margin-bottom: 5px !important;
    }

    .permission_block {
        width: 90%;
        border-right: 1px solid #e0d9d9;
    }
    .select2-container {
        z-index: 99999 !important;
    }
    .main-group{
        column-count: 3; 
        column-gap : 0
    }

    @media ( min-width : 320px ) and ( max-width : 768px ){
        .main-group{
            column-count: 1; 
            column-gap : 0
        }
        .permission_block {
            width: 100%;
        }
    }

    @media ( min-width : 768px ) and ( max-width : 1024px ){
        .main-group{
            column-count: 2; 
            column-gap : 0
        }
        .permission_block {
            width: 95%;
        }
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
                                {{ __('Role.AllRole') }}
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
                            <button type="button" data-content="{{ route('role.add.modal') }}" data-target="#largeModal"
                                class="btn btn-outline-dark" data-toggle="modal">
                                {{ __('Role.Add') }}
                            </button>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-striped dataTable dtr-inline role-datatable"
                                id="datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Role.Id') }}</th>
                                        <th>{{ __('Role.Role') }}</th>
                                        <th>{{ __('Role.Status') }}</th>
                                        <th>{{ __('Role.Action') }}</th>
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
        $('.role-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('role.data') }}",
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
