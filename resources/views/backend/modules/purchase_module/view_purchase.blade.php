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
                            <h6>{{ __('Purchase.ViewPurchaseInfo') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <th>{{ __('Supplier.SupplierName') }}</th>
                                            <td>{{ $purchase->supplier->name }}</td>

                                            <th>{{ __('Supplier.SupplierPhone') }}</th>
                                            <td>{{ $purchase->supplier->contact_no }}</td>

                                        </tr>

                                        <tr>
                                            <th>{{ __('Application.Date') }}</th>
                                            <td>{{ Carbon\Carbon::parse($purchase->date)->toFormattedDateString() }}</td>

                                            <th>{{ __('Purchase.TotalAmount') }}</th>
                                            <td>{{ $purchase->total_amount }}</td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- Purchase Details Information --}}
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-sm table-bordered">
                                        {{-- <thead>
                                            <th>{{ __('Application.SerialNo') }}</th>
                                            <th>{{ __('Lot.LotName') }}</th>
                                            <th>{{ __('ItemType.ItemName') }}</th>
                                            <th>{{ __('variant.Name') }}</th>
                                            <th>{{ __('Unit.Name') }}</th>
                                            <th>{{ __('Purchase.Beg') }}</th>
                                        </thead> --}}
                                        <tbody>
                                            @forelse ($purchase_details as $key => $detail)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $detail->lot->name }}</td>
                                                    <td>{{ $detail->item->name }}</td>
                                                    <td>{{ $detail->variant->name }}</td>
                                                    <td>{{ $detail->unit->name }}</td>
                                                    <td>{{ $detail->total_price / $detail->unit_price }}</td>
                                                    <td>{{ $detail->unit_price }}</td>
                                                    <td>{{ $detail->total_price }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-danger">No Data Found!!</span>
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
            width: '100%',
            // matcher: matchStart
        });
    });
</script>

@endsection
