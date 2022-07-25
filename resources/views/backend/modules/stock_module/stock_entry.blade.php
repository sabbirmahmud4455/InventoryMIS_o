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
                                        <input type="checkbox" name="one_wearhouse" id="one_wearhouse">
                                        <label for="one_wearhouse">{{ __('Warehouse.OneWearhouse') }}</label>
                                    </div>

                                    <div class="col-md-6" id="single_wearhouse">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>{{ __('Warehouse.Warehouse') }}</label>
                                            </div>

                                            <div class="col-md-10">
                                                <select name="warehouse_id" class="form-control form-control-sm">
                                                    <option value="null" selected disabled>{{ __('Warehouse.Warehouse') }}</option>
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

                                {{-- Purchase Details Start --}}
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <th>{{ __('Application.SerialNo') }}</th>
                                        <th>{{ __('Item.Item') }}</th>
                                        <th>{{ __('Variant.Variant') }}</th>
                                        <th>{{ __('Unit.Unit') }}</th>
                                        <th>{{ __('Purchase.Beg') }}</th>
                                        <th>{{ __('Warehouse.Warehouse') }}</th>
                                    </thead>

                                    <tbody>
                                        @forelse ($purchase_details as $key => $stock)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $stock->item->name }}</td>
                                                <td>{{ $stock->variant->name }}</td>
                                                <td>{{ $stock->unit->name }}</td>
                                                <td>{{ $stock->quantity }}</td>
                                                <td>
                                                    <select name="warehouse_id">
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

                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- Purchase Details End --}}
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
