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
            <form method="POST" action="{{ route('stock.store_to_stock') }}">
                @csrf
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
                                        <td>{{ $purchase->date }}</td>

                                        <td>{{ __('Supplier.ChallanNo') }}</td>
                                        <td>{{ $purchase->challan_no }}</td>

                                        <td>{{ __('Application.Status') }}</td>
                                        <td>
                                            @if ($purchase->status == 'PENDING')
                                            <span class="badge badge-info">Ready To Stock</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Supplier.SupplierName') }}</td>
                                        <td>{{ $purchase->supplier->name }}</td>

                                        <td>{{ __('Application.CreatedBy') }}</td>
                                        <td>{{ $purchase->created_by_user->name }}</td>

                                        <td>{{ __('Purchase.TotalAmount') }}</td>
                                        <td>{{ $purchase->total_amount }}</td>
                                    </tr>
                                </table>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="one_wearhouse" id="one_wearhouse_check">
                                        <label for="one_wearhouse">{{ __('Warehouse.OneWearhouse') }}</label>
                                    </div>

                                    <div class="col-md-6" id="single_wearhouse">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{ __('Warehouse.Warehouse') }}</label>
                                            </div>

                                            <div class="col-md-10">
                                                <select name="one_warehouse_id" id="one_warehouse_id"
                                                    class="form-control form-control-sm">
                                                    <option value="null" selected disabled>
                                                        {{ __('Warehouse.Warehouse') }}</option>
                                                    @forelse ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                    @empty
                                                    <option disabled>No Warehouse Found</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">
                                {{-- Purchase Details Start --}}
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <th>{{ __('Application.SerialNo') }}</th>
                                        <th>{{ __('Item.Item') }}</th>
                                        <th>{{ __('Variant.Variant') }}</th>
                                        <th>{{ __('Unit.Unit') }}</th>
                                        <th>{{ __('Purchase.Beg') }}</th>
                                        <th class="warehouse_clmn">{{ __('Warehouse.Warehouse') }}</th>
                                    </thead>

                                    <tbody>
                                        @forelse ($purchase_details as $key => $stock)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $stock->item->name }}</td>
                                            <input type="hidden" name="item_id[]" value="{{ $stock->item_id }}">

                                            <td>{{ $stock->variant->name }}</td>
                                            <input type="hidden" name="variant_id[]" value="{{ $stock->variant_id }}">

                                            <td>{{ $stock->unit->name }}</td>
                                            <input type="hidden" name="unit_id[]" value="{{ $stock->unit_id }}">

                                            <td>{{ $stock->quantity }}</td>
                                            <input type="hidden" name="in_quantity[]" value="{{ $stock->quantity }}">

                                            <input type="hidden" name="lot_id[]" value="{{ $stock->lot_id }}">

                                            <td class="warehouse_clmn">
                                                <select name="warehouse_id[]" id="multi_warehouse">
                                                    <option disabled selected>{{ __('Warehouse.Warehouse') }}</option>
                                                    @forelse ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                    @empty
                                                    <option disabled>No Warehouse Found</option>
                                                    @endforelse
                                                </select>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">
                                                <span
                                                    class="badge badge-danger">{{ __('Application.NoDataFound') }}</span>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- Purchase Details End --}}
                                <button class="btn btn-success float-right mt-3">
                                    {{__('Stock.AddToStock')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </section>

</div>
@endsection

@section('per_page_js')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#single_wearhouse').addClass('d-none');

        $('input:checkbox#one_wearhouse_check').click(function () {
            if ($(this).is(":checked")) {
                $('#single_wearhouse').removeClass('d-none');

                $('.warehouse_clmn').hide();
            } else if ($(this).is(":not(:checked)")) {
                $('#single_wearhouse').addClass('d-none');
                $('.warehouse_clmn').show();

                $('#one_warehouse_id').val('');
                $('£multi_warehouse').val('');
                $('input:checkbox.single_wearhouse').prop('checked', false);
            }
        });
    });

</script>

@endsection
