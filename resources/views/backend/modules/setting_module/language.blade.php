@extends("backend.template.layout")

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/dropify.min.css') }}">
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
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                Language
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                Set Application Language
                            </h3>
                        </div>
                        <div class="card-body">

                            @php
                                $lang = Illuminate\Support\Facades\App::currentLocale();
                            @endphp

                            <form action="{{ route('app_info.set_lang') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>Select Language</label>
                                        <select class="form-control" name="lang">
                                            <option {{ $lang == 'en' ? 'selected' : '' }} value="en"> English </option>
                                            <option {{ $lang == 'bn' ? 'selected' : '' }} value="bn"> বাংলা </option>
                                        </select>

                                        <button type="submit" class="btn btn-info mt-3">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('backend/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/js/form-file-uploads.min.js') }}"></script>
<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>
@endsection
