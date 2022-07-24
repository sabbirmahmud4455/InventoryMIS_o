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
                                <a href="{{ route('stock.add') }}">
                                    {{ __('Stock.AddToStock') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Stock.StockEntry') }}
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
                               <h5>{{ __('Stock.StockEntry') }}</h5>
                            </div>
                            <div class="card-body">

                                {{-- Purchase Information --}}
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <td>{{ __('Application.Date') }}</td>
                                        <td>{{ $purchase_to_stock->purchase_info->date }}</td>

                                        <td>{{ __('Supplier.ChallanNo') }}</td>
                                        <td>{{ $purchase_to_stock->purchase_info->challan_no }}</td>

                                        <td>{{ __('Application.Status') }}</td>
                                        <td>
                                            @if ($purchase_to_stock->purchase_info->status == 'PENDING')
                                                <span class="badge badge-info">Ready To Stock</span>
                                            @endif
                                        </td>
                                    </tr>
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
