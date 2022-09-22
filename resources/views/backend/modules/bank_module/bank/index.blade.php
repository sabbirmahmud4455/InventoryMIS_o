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
                                <a href="#">
                                    {{ __('Bank.Bank') }}
                                </a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-md-6 text-md-right">
                        @if( can('add_bank') )
                        <button type="button" data-content="{{ route('bank.add.modal') }}" data-target="#myModal"
                                class="btn btn-outline-dark" data-toggle="modal">
                            {{ __('Bank.AddBank') }}
                        </button>
                    @endif
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



                                <form action="">
                                    <div class="row">

                                        <div class="col-md-3 col-3 form-group">
                                            <input type="text" class="form-control" name="bank_search" value="{{ request()->bank_search }}" placeholder="{{__( 'Customer.SearchCustomer' )}}">
                                        </div>
                                        <div class="col-md-2 form-group text-left">
                                            <button type="submit" class="btn btn-sm btn-outline-dark">
                                                {{ __('Application.Submit') }}
                                            </button>
                                            <a href="{{ route('customer.all') }}" type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-undo" ></i>
                                            </a>
                                        </div>
                                        <div class="col-md-7 form-group text-md-right">

                                            <h5 class="">
                                                @php
                                                    $curent_balance = 0;

                                                    foreach ($banks as $bank) {
                                                        // echo $bank;
                                                        $curent_balance += $bank->balance;
                                                    }
                                                @endphp


                                                {{ __('Bank.BankBalance') }} : {{ '৳' . $curent_balance }}

                                            </h5>

                                        </div>
                                    </div>

                                </form>






                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped dataTable dtr-inline datatable-data"
                                       id="datatable">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Application.SerialNo') }}</th>
                                        <th>{{ __('Bank.BankName') }}</th>
                                        <th>{{ __('Bank.BankBalance') }}</th>
                                        <th>{{ __('Application.Status') }}</th>
                                        <th>{{ __('Application.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($banks as $key => $bank)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $bank->bank_name }}</td>
                                                <td>৳ {{ $bank->balance }}</td>
                                                <td>
                                                    @if ($bank->status)
                                                        <span class=" text-success"> {{ __('Application.Active') }}</span>
                                                    @else
                                                        <span class=" text-danger">{{ __('Application.Inactive') }}</span>
                                                    @endif

                                                </td>
                                                <td>

                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown{{ $bank->bank_id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ __('Application.Action') }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdown{{ $bank->bank_id }}">

                                                            @if (can("view_bank"))
                                                                <a class="dropdown-item" href="#" data-content="{{ route('bank.view.modal',$bank->bank_id) }}" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                                                                    <i class="fas fa-eye"></i>
                                                                    {{ __('Bank.ViewBank') }}
                                                                </a>
                                                            @endif


                                                            @if (can("edit_bank"))
                                                                <a class="dropdown-item" href="#" data-content="{{ route('bank.edit.modal',$bank->bank_id) }}" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                                                                    <i class="fas fa-edit"></i>
                                                                    {{ __('Bank.EditBank') }}
                                                                </a>
                                                            @endif


                                                            @if (can("bank_transaction"))
                                                                <a class="dropdown-item" href="{{ route('bank.transaction', ['id' => encrypt($bank->bank_id)]) }}" class="btn btn-outline-dark">
                                                                    <i class="fas fa-exchange-alt"></i>
                                                                    {{ __('Bank.Transaction') }}
                                                                </a>
                                                            @endif

                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('backend/js/custom-script.min.js') }}"></script>

    <script src="{{ asset('backend/js/datatable/jquery.validate.js') }}"></script>
    <script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatable/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>

    <script>
        $(function () {
            // $('.datatable-data').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: "{{ route('bank.data') }}",
            //     order : [[0,"Desc"]],
            //     columns: [{
            //         data: 'id',
            //         name: 'id'
            //         },
            //         {
            //             data: 'name',
            //             name: 'name'
            //         },
            //         {
            //             data: 'is_active',
            //             name: 'is_active'
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: false,
            //         },
            //     ]
            // });
        });

    </script>
@endsection
