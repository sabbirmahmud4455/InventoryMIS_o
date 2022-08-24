@extends("backend.template.layout")


@section('per_page_css')

    <link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

    <!-- DatePicker CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- DatePicker CSS -->
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
                                {{ __('Purchase.AllPurchase') }}
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

                        <form action="" method="get" class="px-3 pt-1">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">{{ __('Application.Select') }} {{ __('Supplier.Supplier') }}</label>
                                      <select class="form-control select2" name="supplier_id">
                                        <option value="" selected>{{ __('Supplier.SelectSupplier') }}</option>
                                        @foreach ($suppliers as $supplier)
                                            <option {{ request('supplier_id') == $supplier->id ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-3 form-group">
                                    <label for="">{{ __('Application.Select') }} {{ __('Application.Date') }}</label>
                                    <input type="text" class="form-control" name="purchase_date" value="{{ request()->purchase_date }}">
                                </div>

                                <div class="col-md-2 text-left d-flex align-items-center">
                                    <a href="{{ route('purchase.index') }}" type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-undo" ></i>
                                    </a>
                                    <button type="submit" class="btn btn-sm btn-outline-dark ml-1">
                                        {{ __('Application.Filter') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline datatable-data"
                                id="datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Application.Id') }}</th>
                                        <th>{{ __('Application.Date') }}</th>
                                        <th>{{ __('Supplier.SupplierName') }}</th>
                                        <th>{{ __('Supplier.SupplierPhone') }}</th>
                                        <th>{{ __('Purchase.TotalAmount') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
                                    </tr>
                                </thead>
                                @php
                                    $total_transaction = 0;
                                @endphp
                                <tbody>
                                    @forelse ($purchases as $key => $purchase)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ Carbon\Carbon::parse($purchase->date)->toFormattedDateString() }}</td>
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $purchase->supplier->contact_no }}</td>
                                            @php
                                                $total_transaction += $purchase->total_amount;
                                            @endphp
                                            <td>{{ $purchase->total_amount }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{ $purchase->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ __('Application.Action') }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown{{ $purchase->id }}">

                                                        <a class="dropdown-item" href="{{ route('purchase.view', encrypt($purchase->id)) }}">
                                                            <i class="fas fa-eye"></i>
                                                            {{ __('Application.View') }}

                                                        </a>

                                                        @if (\Illuminate\Support\Facades\URL::previous() != route('report.index'))
                                                            <a class="dropdown-item" href="#" data-content="{{ route('customer.edit.modal',$purchase->id) }}" data-target="#myModal" data-toggle="modal">
                                                                <i class="fas fa-edit"></i>
                                                                {{ __('Application.Edit') }}
                                                            </a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <span class="badge badge-danger">{{ __('Purchase.NoPurchaseFound') }}</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfooter>
                                    <tr style="background-color: #9F9F9F">
                                        <th colspan="4">{{ __('Application.Total') }}</th>
                                        <td colspan="2">{{ $total_transaction }}</td>
                                    </tr>
                                </tfooter>
                            </table>

                            <div class=" d-flex justify-content-center mt-3">
                                {{-- {{ $suppliers->links() }} --}}
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- DatePicker JS -->

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

<script>
    $('input[name="purchase_date"]').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,

        locale: {
            cancelLabel: 'Clear',
        }
    }, function(start, end, label) {
        // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

    $('input[name="purchase_date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="purchase_date"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%',
        // dropdownParent: $('#myModal')
    });
</script>

@endsection
