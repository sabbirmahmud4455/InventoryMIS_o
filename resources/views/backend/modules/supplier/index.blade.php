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
                                    {{ __('Supplier.Supplier') }}
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
                                @if( can('add_supplier') )
                                    <button type="button" data-content="{{ route('supplier.add.modal') }}" data-target="#myModal"
                                            class="btn btn-outline-dark" data-toggle="modal">
                                        {{ __('Supplier.SupplierAdd') }}
                                    </button>
                                @endif
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped dataTable dtr-inline datatable-data"
                                       id="datatable">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Application.Id') }}</th>
                                        <th>{{ __('Supplier.SupplierName') }}</th>
                                        <th>{{ __('Supplier.SupplierPhone') }}</th>
                                        <th>{{ __('Application.Status') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $key => $supplier)
                                            <tr>
                                                <td>{{ $supplier->id }}</td>
                                                <td>{{ $supplier->name }}</td>
                                                <td>{{ $supplier->contact_no }}</td>
                                                <td>
                                                    @if ($supplier->is_active)
                                                        <p class="badge badge-success">{{ __('Application.Active') }}</p>
                                                    @else
                                                        <p class="badge badge-danger">{{ __('Application.Inactive') }}</p>
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{ $supplier->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ __('Application.Action') }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdown{{ $supplier->id }}">

                                                            <a class="dropdown-item" href="#" data-content="{{ route('supplier.show', $supplier->id) }}" data-target="#myModal" data-toggle="modal">
                                                                <i class="fas fa-eye"></i>
                                                                {{ __('Application.View') }}
                                                            </a>

                                                            <a class="dropdown-item" href="#" data-content="{{ route('supplier.edit.modal',$supplier->id) }}" data-target="#myModal" data-toggle="modal">
                                                                <i class="fas fa-edit"></i>
                                                                {{ __('Application.Edit') }}
                                                            </a>

                                                            <a class="dropdown-item" href="{{ route('supplier.transactions', encrypt($supplier->id)) }}">
                                                                <i class="fa fa-exchange-alt" aria-hidden="true"></i>
                                                                {{ __('Application.Transaction') }}
                                                            </a>

                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class=" d-flex justify-content-center mt-3">
                                    {{ $suppliers->links() }}
                                </div>

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
    <script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

@endsection
