@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{ __('Stock.StockList') }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- <a href="{{ route('stock.list.export.pdf', ['warehouse' => request('warehouse_id')? request('warehouse_id') : '', 'stock_date' => "adf"]) }}" target="_blank" class="btn btn-sm btn-info float-right">{{ __("Application.Download") }}</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <form action="" method="get">

                                    <div class="row pb-2">
                                        <div class="col-md-2">
                                            <label>{{ __('Item.Item') }}</label>
                                            <select name="item_id" class="form-control form-control-sm select2" onchange="item_change()"
                                                id="item_id">
                                                <option value="" selected >{{ __('Item.SelectItem') }}</option>
                                                @foreach ($active_items as $item)
                                                    <option {{ request("item_id") == $item->id ? "selected" : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="variant_unit" class="col-md-2 d-none">
                                            <label>{{ __('Item.ItemVariant') }}</label>
                                            <select name="item_variant_unit" class="form-control form-control-sm select2 "
                                                id="item_variant_unit" >
                                                <option value="" selected >{{ __('variant.SelectVarient') }}</option>
                                            </select>
                                        </div>


                                        {{-- Item Varient --}}
                                        <div id="variant" class="col-md-2">
                                            <label>{{ __('Item.ItemVariant') }}</label>
                                            <select name="item_varient" class="form-control form-control-sm select2" id="item_varient">
                                                <option value="" selected>{{ __('variant.SelectVariant') }}</option>
                                                @foreach ($variants as $variant)
                                                    <option {{ request('item_varient') == $variant->id ? "selected" : '' }} value="{{ $variant->id }}">{{ $variant->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Unit --}}

                                        <div id="unit" class="col-md-2">
                                            <label>{{ __('Unit.Unit') }}</label>
                                            <select name="item_unit" class="form-control form-control-sm select2" id="item_unit">
                                                <option value="" selected>{{ __('Unit.SelectUnit') }}</option>
                                                @foreach ($units as $unit)
                                                    <option {{ request('item_unit') == $unit->id ? "selected" : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>{{ __('Warehouse.Warehouse') }}</label>
                                            <select name="warehouse_id" class="form-control form-control-sm select2" id="warehouse_id">
                                                <option value="" selected>{{ __('Warehouse.SelectWarehouse') }}</option>

                                                @foreach ($active_warehouses as $warehouse)
                                                    <option {{ request('warehouse_id') == $warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 text-left d-flex align-items-end">
                                            <a href="{{ route('stock.list') }}" type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-undo" ></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-outline-dark ml-1 ">
                                                {{ __('Application.Filter') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>


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
                                    @php
                                        $total_stock = 0;
                                    @endphp
                                    <tbody>
                                        @forelse ($stock_lists as $key => $stock)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $stock->item_name }}</td>
                                                <td>{{ $stock->variant_name }}</td>
                                                <td>{{ $stock->unit_name }}</td>
                                                {{-- <td>{{ $stock->lot_name }}</td> --}}
                                                @php
                                                    $total_stock += $stock->available_stock;
                                                @endphp
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
                                    <tfooter>
                                        <tr style="background-color: #9F9F9F">
                                            <th colspan="4">{{ __('Application.Total') }}</th>
                                            <td colspan="2">{{ $total_stock }}</td>
                                        </tr>
                                    </tfooter>
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

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>
<script>


    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });


    });


    function item_change(){
        const select = "{{ request("item_variant_unit") }}";

        const item_id = $("#item_id").val();
        const variant_id = $('#item_variant_unit');

        if (item_id) {
            $('#variant_unit').removeClass('d-none');
            $('#variant').addClass('d-none');
            $('#unit').addClass('d-none');

        } else {
            $('#variant_unit').addClass('d-none');
            $('#variant').removeClass('d-none');
            $('#unit').removeClass('d-none');
            variant_id.val('');
        }

        if (item_id) {
            $('.loading').show();
            $.ajax({
                url: "{{ route('sale.item_stock_variant') }}",
                data: {
                    item_id: item_id
                },
                method: 'GET',
                success: function (data) {
                    $('.loading').hide();

                    variant_id.html(
                        '<option value="" selected disabled>Choose Variant</option>');
                    $.each(data, function (index, value) {

                        const id = `${value.variant_id}_${value.unit_id}`;

                        const adf = select == id ? 'selected' : '';

                        variant_id.append(`<option ${adf} value = "${id}"> ${value.variant_name}
                            ( ${value.unit_name} )</option>`)
                    });
                }
            });
        }
    }

    item_change();


</script>








@endsection
