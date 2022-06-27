@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                        <li class="breadcrumb-item">
                            <a href="{{ route('purchase.index') }}">
                                {{ __('Purchase.AllPurchase') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                {{ __('Purchase.AddNewPurchase') }}
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
                            <h6>{{ __('Purchase.AddNewPurchase') }}</h6>
                        </div>
                        <div class="card-body">

                            {{-- Item Adding Start --}}
                            <div class="row">
                                {{-- Lot --}}
                                <div class="col-md-3">
                                    <label>{{ __('Lot.Lot') }}</label>
                                    <input type="text" class="form-control form-control-sm">
                                </div>

                                {{-- Supplier Name --}}
                                <div class="col-md-3">
                                    <label>{{ __('Supplier.SupplierName') }}</label>
                                    <select name="supplier_id" class="form-control form-control-sm select2">
                                        @forelse ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>

                                {{-- Item Name --}}
                                <div class="col-md-3">
                                    <label>{{ __('Item.Item') }}</label>
                                    <select name="item_id" class="form-control form-control-sm select2">
                                        @forelse ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>

                                {{-- Item Varient --}}
                                <div class="col-md-3">
                                    <label>{{ __('Item.ItemVariant') }}</label>
                                    <select name="item_id" class="form-control form-control-sm select2">
                                        @forelse ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                </div>

                                {{-- Item Weight --}}
                                <div class="col-md-3">
                                    <label>{{ __('Purchase.Beg') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="beg">
                                </div>

                                {{-- Item Price --}}
                                <div class="col-md-3">
                                    <label>{{ __('Purchase.Price') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="unit_price">
                                </div>

                                {{-- Total Price --}}
                                <div class="col-md-3">
                                    <label>{{ __('Purchase.TotalPrice') }}</label>
                                    <input type="text" class="form-control form-control-sm" name="total_price">
                                </div>

                                {{-- Add Button --}}
                                <div class="col-md-3">
                                    <button class="btn btn-info mt-4 btn-sm">{{ __('Application.Add') }}</button>
                                </div>
                            </div>
                            {{-- Item Adding End --}}
                            <br>

                            <div class="row">
                                {{-- Added Item List Start --}}
                                <div class="col-md-9 bg card">
                                    <span style="margin-top: 8px;"></span>
                                    <table width="100%" class="table table-sm table-bordered">
                                        <thead>
                                            <th>{{ __('Application.SerialNo') }}</th>
                                            <th>{{ __('Item.Item') }}</th>
                                            <th>{{ __('Purchase.Beg') }}</th>
                                            <th>{{ __('Purchase.Weight') }}</th>
                                            <th>{{ __('Purchase.Price') }}</th>
                                            <th>{{ __('Purchase.TotalPrice') }}</th>
                                            <th>{{ __('Application.Delete') }}</th>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>১</td>
                                                <td>মিনিকেট</td>
                                                <td>৫</td>
                                                <td>২৫</td>
                                                <td>১৯০০</td>
                                                <td>৯৫০০</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">X</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>১</td>
                                                <td>মিনিকেট</td>
                                                <td>৫</td>
                                                <td>২৫</td>
                                                <td>১৯০০</td>
                                                <td>৯৫০০</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">X</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>১</td>
                                                <td>মিনিকেট</td>
                                                <td>৫</td>
                                                <td>২৫</td>
                                                <td>১৯০০</td>
                                                <td>৯৫০০</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- Added Item List End --}}

                                {{-- Sub Total Information Start --}}
                                <div class="col-md-3 bg card">
                                    <span style="margin-top: 8px;"></span>

                                    <label>{{ __('Purchase.TotalPrice') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Purchase.PreviousBalance') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Purchase.InTotalAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Purchase.DepositeAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Purchase.DueAmount') }}</label>
                                    <input type="text" class="form-control form-control-sm">

                                    <label>{{ __('Purchase.PaymentBy') }}</label>
                                    <select name="payment_by" class="form-control form-control-sm">
                                        <option value="CASH">{{ __('Purchase.Cash') }}</option>
                                        <option value="CASH">{{ __('Purchase.Bank') }}</option>
                                    </select>

                                    <button class="btn btn-success btn-sm mt-3 ">
                                        {{ __('Application.Add') }}
                                    </button>

                                    <span style="margin-bottom: 8px;"></span>
                                </div>
                                {{-- Sub Total Information End --}}

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
<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    });
</script>

@endsection
