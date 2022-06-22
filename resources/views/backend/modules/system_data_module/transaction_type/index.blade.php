@extends("backend.template.layout")

@section('per_page_css')
    <link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                                    {{ __('TransactionType.TransactionType') }}
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
                                @if( can('add_transaction_type') )
                                    <button type="button" data-content="{{ route('transaction.type.add.modal') }}" data-target="#myModal"
                                            class="btn btn-outline-dark" data-toggle="modal">
                                        {{ __('TransactionType.AddTransactionType') }}
                                    </button>
                                @endif
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped dataTable dtr-inline datatable-data"
                                       id="datatable">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Application.Id') }}</th>
                                        <th>{{ __('TransactionType.Name') }}</th>
                                        <th>{{ __('Application.Status') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
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
            $('.datatable-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transaction.type.data') }}",
                order : [[0,"Desc"]],
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
