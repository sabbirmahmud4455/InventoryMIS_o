@extends("backend.template.layout")

@section('per_page_css')

<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

<!-- DatePicker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- DatePicker CSS -->

<style>
    .select2-container {
        z-index: 9999 !important;
    }
    .button_margin_bottom{
        margin-bottom: 5px;
    }
</style>

@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                {{ __('Application.Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                {{ __('Report.AllReport') }}
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

                <!--Employee Report Start-->
                @if (can(''))
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>---</h5></center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @if (can(''))
                                                <a href="" class="btn btn-sm btn-outline-primary all-report button_margin_bottom">--</a>
                                            @endif
                                            @if (can(''))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">--</a>
                                            @endif
                                            @if (can(''))
                                                <a href="" class="btn btn-sm btn-outline-success all-report button_margin_bottom">--</a>
                                            @endif
                                            @if (can(''))
                                                <a href="" class="btn btn-sm btn-outline-secondary all-report button_margin_bottom">--</a>
                                            @endif
                                            @if (can(''))
                                                <a href="" class="btn btn-sm btn-outline-dark all-report button_margin_bottom">--</a>
                                            @endif
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Employee Report End-->


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

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#myModal')
        });
    });

</script>

<script>
    $(function() {
        $('.all-report').on('click', function(e) {
            $(".loading").show()
        });
    });
</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- DatePicker JS -->


@endsection
