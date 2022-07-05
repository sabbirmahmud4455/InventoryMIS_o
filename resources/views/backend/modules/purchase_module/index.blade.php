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
                                {{ __('Purchase.AllPurchase') }}
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
                        <div class="row">

                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline datatable-data"
                                id="datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Application.Id') }}</th>
                                        <th>{{ __('Supplier.SupplierName') }}</th>
                                        <th>{{ __('Supplier.SupplierPhone') }}</th>
                                        <th>{{ __('Purchase.TotalAmount') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($purchases as $key => $purchase)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $purchase->supplier->contact_no }}</td>
                                            <td>{{ $purchase->total_amount }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{ $purchase->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ __('Application.Action') }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown{{ $purchase->id }}">

                                                        <a class="dropdown-item" href="{{ route('purchase.view', encrypt($purchase->id)) }}">
                                                            <i class="fas fa-eye"></i>
                                                            {{ __('Application.View') }}

                                                        </a>

                                                        <a class="dropdown-item" href="#" data-content="{{ route('customer.edit.modal',$purchase->id) }}" data-target="#myModal" data-toggle="modal">
                                                            <i class="fas fa-edit"></i>
                                                            {{ __('Application.Edit') }}
                                                        </a>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <span class="badge badge-danger">{{ __('Purchase.NoPurchaseFound') }}</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class=" d-flex justify-content-center mt-3">
                                {{-- {{ $suppliers->links() }} --}}
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
