@extends("backend.template.layout")

@section('per_page_css')

<!-- Data Table CSS -->
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Select2 CSS -->
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

<!-- DatePicker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Barcumber Start -->
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
                                {{ __('Supplier.Supplier') }}
                            </a>
                        </li>
                    </ol>
                </div>
                <!-- Barcumber End -->

                <!-- Add Supplier Button Start -->
                <div class="col-sm-6">
                    @if( can('add_supplier') && \Illuminate\Support\Facades\URL::previous() != route('report.index'))
                    <button type="button" data-content="{{ route('supplier.add.modal') }}" data-target="#myModal"
                        class="btn btn-outline-dark float-right" data-toggle="modal">
                        {{ __('Supplier.SupplierAdd') }}
                    </button>
                    @endif
                </div>
                <!-- Add Supplier Button End -->

            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline table-responsive">
                        <!-- Filtering Start -->
                        <div class="card-header">
                            @php
                                $header_total_transaction = 0;
                            @endphp
                            @foreach ($suppliers as $key => $supplier)
                                @php
                                    $header_total_transaction += $supplier->balance;
                                @endphp
                            @endforeach
                            <form action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="search" class="form-control"
                                               placeholder="{{ __('Application.SearchHere') }}" value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-2">
                                        <select name="supplier_id" class="form-control select2">
                                            <option selected disabled>{{ __('Supplier.SelectSupplier') }}</option>
                                            @forelse ($supplier_list as $supplier)
                                                <option value="{{ $supplier->id }}" @if(request()->supplier_id == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                                            @empty
                                                <option disabled>{{ __('Application.NoDataFound') }}</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="col-md-1">
                                        <input type="text" class="form-control" name="purchase_date" value="{{ request()->purchase_date }}" placeholder="{{ __('Application.Date') }}">

                                    </div>

                                    <div class="col-md-1">
                                        <button class="btn btn-success" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>


                                    <div class="col-md-2">

                                        <h5 class="mt-2">{{ __('Supplier.TotalPayable') }} : {{ '৳' . number_format($header_total_transaction, 0) }}</h5>
                                    </div>

                                    <div class="col-md-2">
                                        <a href="{{ route('supplier.all') }}" class="btn btn-danger">
                                            <i class="fa fa-retweet" aria-hidden="true"></i>
                                        </a>

                                        <button class="btn btn-primary float-right">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- Filtering End -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline datatable-data"
                                id="datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Application.Id') }}</th>
                                        <th>{{ __('Supplier.SupplierName') }}</th>
                                        <th>{{ __('Supplier.SupplierPhone') }}</th>
                                        <th>{{ __('Supplier.Payable') }}</th>
                                        <th>{{ __('Application.Status') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
                                    </tr>
                                </thead>
                                @php
                                $total_transaction = 0;
                                @endphp
                                <tbody>
                                    @foreach ($suppliers as $key => $supplier)
                                    <tr>
                                        <td>{{ ++ $key }}</td>
                                        {{-- <td>{{ $suppliers->firstItem() + $key }}</td>--}}
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->contact_no }}</td>
                                        @php
                                        $total_transaction += $supplier->balance;
                                        @endphp
                                        <td class="text-right">{{ '৳' . number_format($supplier->balance, 0) }}</td>
                                        <td>
                                            @if ($supplier->is_active == 1)
                                            <p class="badge badge-success">{{ __('Application.Active') }}</p>
                                            @else
                                            <p class="badge badge-danger">{{ __('Application.Inactive') }}</p>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdown{{ $supplier->supplier_id }}" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    {{ __('Application.Action') }}
                                                </button>
                                                <div class="dropdown-menu"
                                                    aria-labelledby="dropdown{{ $supplier->supplier_id }}">

                                                    <a class="dropdown-item" href="#"
                                                        data-content="{{ route('supplier.show', $supplier->supplier_id) }}"
                                                        data-target="#myModal" data-toggle="modal">
                                                        <i class="fas fa-eye"></i>
                                                        {{ __('Application.View') }}
                                                    </a>

                                                    @if (\Illuminate\Support\Facades\URL::previous() !=
                                                    route('report.index'))
                                                    <a class="dropdown-item" href="#"
                                                        data-content="{{ route('supplier.edit.modal',$supplier->supplier_id) }}"
                                                        data-target="#myModal" data-toggle="modal">
                                                        <i class="fas fa-edit"></i>
                                                        {{ __('Application.Edit') }}
                                                    </a>
                                                    @endif

                                                    <form action="{{ route('supplier.transactions') }}">
                                                        <button class="dropdown-item p-2">
                                                            <i class="fa fa-exchange-alt" aria-hidden="true"></i>
                                                            <input type="hidden" name="supplier_id"
                                                                value="{{ $supplier->supplier_id }}">
                                                            {{ __('Application.Transaction') }}
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfooter>
                                    <tr style="background-color: #9F9F9F">
                                        <th colspan="3">{{ __('Application.Total') }}</th>
                                        <td colspan="3">{{ '৳' . number_format($total_transaction, 0) }}</td>
                                    </tr>
                                </tfooter>
                            </table>

                            <div class=" d-flex justify-content-center mt-3">
                                {{--                                    {{ $suppliers->links() }}--}}
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>
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
