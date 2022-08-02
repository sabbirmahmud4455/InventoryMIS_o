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
                            <li class="breadcrumb-item active">
                                <a href="{{ route('transaction.all') }}">
                                    {{ __('Transaction.Transaction') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="">
                                    {{ __('Transaction.ChangeStatus') }}
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
                            </div>
                            <div class="card-body">

                                <form action="{{ route('transaction.status.update', ['id' => encrypt($transaction->id)]) }}" method="post" class="ajax-form">
                                    @csrf
                                    <div class="row">

                                        <!-- status -->
                                        <div class="col-md-6 col-6 form-group">
                                            <label for="status">{{ __('Transaction.PaymentType') }}</label><span class="require-span">*</span>
                                            <select class="form-control select2" name="status">
                                                <option value="" selected disabled>Select Status</option>
                                                    <option value="PENDING" @if($transaction->status === "PENDING") selected @endif>PENDING</option>
                                                    <option value="RECEIVED" @if($transaction->status === "RECEIVED") selected @endif>RECEIVED</option>
                                                    <option value="SEND" @if($transaction->status === "SEND") selected @endif>SEND</option>
                                                    <option value="BOUNCE" @if($transaction->status === "BOUNCE") selected @endif>BOUNCE</option>
                                                    <option value="CANCEL" @if($transaction->status === "CANCEL") selected @endif>CANCEL</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 col-6 form-group ">
                                            <button type="submit" class="btn btn-outline-dark form-control" style="    margin-top: 22px;">
                                                {{ __('Application.Update') }}
                                            </button>
                                        </div> 
                                        
    
                                    </div>

                                    
                                </form>
                                
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
                // dropdownParent: $('#myModal')
            });
        });
    </script>

@endsection
