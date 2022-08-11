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
                                    {{ __('Customer.Customer') }}
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
                            <div class="card-header text-right">
                                @if( can('add_customer') && \Illuminate\Support\Facades\URL::previous() != route('report.index'))
                                    <button type="button" data-content="{{ route('customer.add.modal') }}" data-target="#myModal"
                                            class="btn btn-outline-dark" data-toggle="modal">
                                        {{ __('Customer.CustomerAdd') }}
                                    </button>
                                @endif
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped dataTable dtr-inline datatable-data"
                                       id="datatable">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Application.Id') }}</th>
                                        <th>{{ __('Customer.CustomerName') }}</th>
                                        <th>{{ __('Customer.CustomerPhone') }}</th>
                                        <th>{{ __('Customer.Receivable') }}</th>
                                        <th>{{ __('Application.Status') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
                                    </tr>
                                    </thead>
                                    @php
                                        $total_transaction = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($customers as $key => $customer)
                                            <tr>
                                                <td>{{ $customer->id }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->contact_no }}</td>
                                                @php
                                                    $cash_in = $customer->transactions->sum('cash_in');
                                                    $cash_out = $customer->transactions->sum('cash_out');
                                                    $receivable = $cash_in - $cash_out;
                                                    $total_transaction += $receivable;
                                                @endphp
                                                <td>{{ '৳ ' . number_format($receivable, 0) }}</td>
                                                <td>
                                                    @if ($customer->is_active)
                                                        <p class="badge badge-success">{{ __('Application.Active') }}</p>
                                                    @else
                                                        <p class="badge badge-danger">{{ __('Application.Inactive') }}</p>
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{ $customer->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ __('Application.Action') }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdown{{ $customer->id }}">

                                                            <a class="dropdown-item" href="#" data-content="{{ route('customer.show', $customer->id) }}" data-target="#myModal" data-toggle="modal">
                                                                <i class="fas fa-eye"></i>
                                                                {{ __('Application.View') }}
                                                            </a>

                                                            @if (\Illuminate\Support\Facades\URL::previous() != route('report.index'))
                                                                <a class="dropdown-item" href="#" data-content="{{ route('customer.edit.modal',$customer->id) }}" data-target="#myModal" data-toggle="modal">
                                                                    <i class="fas fa-edit"></i>
                                                                    {{ __('Application.Edit') }}
                                                                </a>
                                                            @endif

                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfooter>
                                        <tr style="background-color: #9F9F9F">
                                            <th colspan="3">{{ __('Application.Total') }}</th>
                                            <td colspan="3">{{ '৳ ' . number_format($total_transaction, 0) }}</td>
                                        </tr>
                                    </tfooter>
                                </table>

                                <div class=" d-flex justify-content-center mt-3">
                                    {{ $customers->links() }}
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

@endsection
