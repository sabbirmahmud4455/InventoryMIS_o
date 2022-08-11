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
                                    {{ __('Report.UnitWiseItemReport') }}
                                </a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <a href="{{ route('unit.wise.item.report.export.pdf') }}" target="_blank" class="btn btn-sm btn-info float-right">{{ __("Application.Download") }}</a>
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
                                @if ($unit_wise_item_group && count($unit_wise_item_group) > 0)
                                    <table class="table table-sm table-bordered text-center">
                                        <thead>
                                            <tr>
                                                {{-- <th>{{ __('Application.SerialNo') }}</th> --}}
                                                <th>{{ __('Unit.Unit')0 }}</th>
                                                <th>{{ __('Item.Item') }}</th>
{{--                                                <th>{{ __('Application.Date') }}</th>--}}
                                                <th>{{ __('Report.InQuantity') }}</th>
                                                <th>{{ __('Report.OutQuantity') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_row = 0;
                                                $total_quantity = 0;
                                                $in_quantity = 0;
                                                $out_quantity = 0;
                                            @endphp
                                            @foreach ($unit_wise_item_group as $key => $unit_wise_items)

                                                @foreach ($unit_wise_items->groupBY('item_id') as $unit_wise_item)
                                                    @php
                                                        $total_row += count($unit_wise_item) +1;
                                                    @endphp
                                                @endforeach

                                                <tr>
                                                    <td rowspan="{{ $total_row + 1 }}" style="vertical-align: middle">{{ $unit_wise_items[0]->unit->name }}</td>

                                                    @foreach ($unit_wise_items->groupBY('item_id') as $unit_wise_item)
                                                        <tr>
                                                            <td rowspan="{{ count($unit_wise_item) + 1 }}" style="vertical-align: middle">{{ $unit_wise_item[0]->item->name }}</td>
                                                            @foreach ($unit_wise_item as $item)
                                                                <tr>
{{--                                                                    <td>{{ \Carbon\Carbon::Parse($item->created_at)->format('d-M-Y') }}</td>--}}
{{--                                                                    <td>{{ $item->in_quantity - $item->out_quantity }}</td>--}}
                                                                    @php
                                                                        $in_quantity += $item->in_quantity;
                                                                        $out_quantity += $item->out_quantity;
                                                                    @endphp
                                                                    <td>{{ $item->in_quantity }}</td>
                                                                    <td>{{ $item->out_quantity }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfooter>
                                            <tr style="background-color: #9F9F9F">
                                                <th colspan="2">{{ __('Application.Total') }}</th>
                                                <td>{{ $in_quantity }}</td>
                                                <td>{{ $out_quantity }}</td>
                                            </tr>
                                        </tfooter>
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
