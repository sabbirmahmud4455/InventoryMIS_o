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
                            @if (\Illuminate\Support\Facades\URL::previous() == route('report.index'))
                                <li class="breadcrumb-item active">
                                    <a href="{{ route('report.index') }}">
                                        {{ __('Report.AllReport') }}
                                    </a>
                                </li>
                            @endif
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Stock.StockList') }}
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
                               <h5>{{ __('Stock.StockList') }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm table-striped dataTable dtr-inline datatable-data"
                                       id="datatable">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Application.SerialNo') }}</th>
                                        <th>{{ __('Item.Item') }}</th>
                                        <th>{{ __('Variant.Variant') }}</th>
                                        <th>{{ __('Unit.Unit') }}</th>
                                        {{-- <th>{{ __('Lot.LotName') }}</th> --}}
                                        <th>{{ __('Stock.AvailableStock') }}</th>
                                        <th>{{ __('Application.Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($stock_lists as $key => $stock)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $stock->item_name }}</td>
                                                <td>{{ $stock->variant_name }}</td>
                                                <td>{{ $stock->unit_name }}</td>
                                                {{-- <td>{{ $stock->lot_name }}</td> --}}
                                                <td>{{ $stock->available_stock }}</td>
                                                <td>
                                                    @if ($stock->available_stock > 3)
                                                       <span class="badge badge-success">{{ __('Stock.AvailableStock') }}</span>
                                                    @elseif ($stock->available_stock > 0 && $stock->available_stock <= 3)
                                                       <span class="badge badge-warning">{{ __('Stock.LowStock') }}</span>
                                                    @else
                                                       <span class="badge badge-danger">{{ __('Stock.OutOfStock') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <center>
                                                        <span class="badge badge-danger">
                                                            {{ __('Application.NoDataFound') }}
                                                        </span>
                                                    </center>
                                                </td>
                                            </tr>
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
