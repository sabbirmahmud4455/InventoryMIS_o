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
                                <a href="{{ route('report.index') }}">
                                    {{ __('Report.AllReport') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#">
                                    {{ __('Report.StockReport') }}
                                </a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        {{-- <a href="{{ route('all.item.report.export.pdf') }}" target="_blank" class="btn btn-sm btn-info float-right">{{ __("Application.Download") }}</a> --}}
                    </div>
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
                            </div>
                            <div class="card-body">
                                @if ($stocks && count($stocks) > 0)
                                <table class="table table-bordered table-sm table-striped dataTable dtr-inline datatable-data"
                                    id="datatable">
                                <thead>
                                    <tr>
                                        {{-- <th>{{ __('Application.SerialNo') }}</th> --}}
                                        <th>{{ __('Item.Item') }}</th>
                                        <th>{{ __('Variant.Variant') }}</th>
                                        <th>{{ __('Unit.Unit') }}</th>
                                        <th>{{ __('Stock.AvailableStock') }}</th>
                                        {{-- <th>{{ __('Application.Status') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_row = 0;
                                    @endphp
                                    @forelse ($stocks as $key => $stock)
                                        <tr>
                                            
                                            @foreach ($stock->groupBy('variant_id') as $stock_by_variant)
                                                @php
                                                    $total_row += count($stock_by_variant);
                                                @endphp
                                                @foreach ($stock_by_variant->groupBy('unit_id') as $stock_by_unit)
                                                    @php
                                                        $total_row += count($stock_by_unit) + 1;
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                            <td rowspan="{{ $total_row + 1 }}">{{ $stock[0]->item->name }}</td>
                                            @foreach ($stock->groupBy('variant_id') as $stock_by_variant)
                                                
                                                <tr>
                                                    <td rowspan="{{ count($stock_by_variant) + 3 }}">{{ $stock_by_variant[0]->variant->name }}</td>
                                                    @foreach ($stock_by_variant->groupBy('unit_id') as $stock_by_unit)
                                                    
                                                        <tr>
                                                            <td rowspan="{{ count($stock_by_unit) + 1 }}">{{ $stock_by_unit[0]->unit->name }}</td>
                                                            @foreach ($stock_by_unit as $item)
                                                            
                                                                <tr>
                                                                    <td>{{  $item->in_quantity }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tr>
                                                        
                                                    @endforeach
                                                </tr>
                                                
                                            @endforeach
                                            
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
                                @else
                                    <h4 class="text-center text-danger my-2">{{ __('Application.NoDataFound') }}</h4>
                                @endif
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
