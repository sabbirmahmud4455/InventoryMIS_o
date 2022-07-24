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
                                    {{ __('Stock.AddToStock') }}
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
                            <div class="card-header">
                               <h5>{{ __('Stock.AddToStock') }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <th>{{ __('Application.SerialNo') }}</th>
                                        <th>{{ __('Application.Date') }}</th>
                                        <th>{{ __('Supplier.SupplierName') }}</th>
                                        <th>{{ __('Supplier.ChallanNo') }}</th>
                                        <th>{{ __('Purchase.TotalAmount') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
                                    </thead>

                                    <tbody>
                                        @forelse ($purchases as $key => $purchase)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $purchase->date }}</td>
                                                <td>{{ $purchase->supplier->name }}</td>
                                                <td>{{ $purchase->challan_no }}</td>
                                                <td>{{ $purchase->total_amount }}</td>
                                                <td>
                                                    @if (can('add_to_stock'))
                                                        <a href="{{ route('stock.add_to_stock', encrypt($purchase->id)) }}" class="btn btn-info btn-sm">
                                                            {{ __('Stock.AddToStock') }}
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
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
    <script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

@endsection
