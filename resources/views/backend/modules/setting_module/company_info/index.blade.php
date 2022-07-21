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
                                    Company Information
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
                                    Update Company Information
                                </h3>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('company.info.update', encrypt($company_info->id)) }}" method="post" class="ajax-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-12">

                                            <div class="tab-content" id="vert-tabs-tabContent">

                                                <!-- ITEM START -->
                                                <div class="tab-pane text-left fade active show" id="tab-one"
                                                     role="tabpanel" aria-labelledby="vert-tabs-home-tab">

                                                    <div class="row ">


                                                        <!-- Company Name start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Company Name</label><span class="require-span">*</span>
                                                            <input type="text" name="name" value="{{ old('name', $company_info->name) }}" id="" class="form-control" placeholder="Enter Company Name">
                                                        </div>
                                                        <!-- Company Name end -->

                                                        <!-- Address start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Address</label><span class="require-span">*</span>
                                                            <input type="text" name="address" value="{{ old('name', $company_info->address) }}" id="" class="form-control" placeholder="Enter Company Address">
                                                        </div>
                                                        <!-- Address end -->

                                                        <!-- phone start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Phone</label><span class="require-span">*</span>
                                                            <input type="text" name="phone" value="{{ old('name', $company_info->phone) }}" id="" class="form-control" placeholder="Enter Company Phone Number">
                                                        </div>
                                                        <!-- phone end -->

                                                        <!-- email start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Email</label><span class="require-span">*</span>
                                                            <input type="email" name="email" value="{{ old('name', $company_info->email) }}" id="" class="form-control" placeholder="Enter Company Email Number">
                                                        </div>
                                                        <!-- email end -->

                                                        <!-- website start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Website</label><span class="require-span">*</span>
                                                            <input type="text" name="website" value="{{ old('name', $company_info->website) }}" id="" class="form-control" placeholder="Enter Company Website">
                                                        </div>
                                                        <!-- website end -->

                                                        <!-- web_mail start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Web Mail</label><span class="require-span">*</span>
                                                            <input type="text" name="web_mail" value="{{ old('name', $company_info->web_mail) }}" id="" class="form-control" placeholder="Enter Company Web Mail">
                                                        </div>
                                                        <!-- web_mail end -->

                                                        <!-- facebook_profile start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Facebook Profile</label><span class="require-span">*</span>
                                                            <input type="text" name="facebook_profile" value="{{ old('name', $company_info->facebook_profile) }}" id="" class="form-control" placeholder="Enter Company Facebook Profile">
                                                        </div>
                                                        <!-- facebook_profile end -->

                                                        <!-- linkedin_profile start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Linkedin Profile</label><span class="require-span">*</span>
                                                            <input type="text" name="linkedin_profile" value="{{ old('name', $company_info->linkedin_profile) }}" id="" class="form-control" placeholder="Enter Company Linkedin Profile">
                                                        </div>
                                                        <!-- linkedin_profile end -->

                                                        <!-- youtube_profile start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <label>Youtube Profile</label><span class="require-span">*</span>
                                                            <input type="text" name="youtube_profile" value="{{ old('name', $company_info->youtube_profile) }}" id="" class="form-control" placeholder="Enter Company Youtube Profile">
                                                        </div>
                                                        <!-- youtube_profile end -->

                                                        <!-- description start -->
                                                        <div class="col-md-12 col-12 form-group">
                                                            <label>Description</label><span class="require-span">*</span>
                                                            <textarea name="description" rows="3" id="item_description" class="form-control" placeholder="Enter Company Description">{{ old('name', $company_info->description) }}</textarea>
                                                        </div>
                                                        <!-- description end -->


                                                        <!-- Company Logo start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <div class="dropify-wrapper">
                                                                <div class="dropify-message"><span
                                                                        class="file-icon"></span>
                                                                    <p>
                                                                        Company Logo (837 x 218)
                                                                    </p>
                                                                    <p class="dropify-error">Ooops,
                                                                        something wrong appended.</p>
                                                                </div>
                                                                <div class="dropify-loader"
                                                                     style="display: none;"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" id="input-file-now"
                                                                       class="dropify" name="company_logo"
                                                                       data-default-file="">
                                                                <img src="{{ asset('images/company_info/'. $company_info->company_logo) }}" style="width: 100px; margin-top: 10px" alt="">
                                                                <button
                                                                    type="button"
                                                                    class="dropify-clear">Remove</button>
                                                                <div class="dropify-preview"
                                                                     style="display: none;"><span
                                                                        class="dropify-render"></span>
                                                                    <div class="dropify-infos">
                                                                        <div class="dropify-infos-inner">
                                                                            <p class="dropify-filename">
                                                                            <span
                                                                                class="file-icon"></span>
                                                                                <span
                                                                                    class="dropify-filename-inner">1618054231jLxKfola9cDg.jpg</span>
                                                                            </p>
                                                                            <p
                                                                                class="dropify-infos-message">
                                                                                Drag and drop or click to
                                                                                replace</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Company Logo end -->

                                                        <!-- Reporting logo start -->
                                                        <div class="col-md-6 col-12 form-group">
                                                            <div class="dropify-wrapper">
                                                                <div class="dropify-message"><span
                                                                        class="file-icon"></span>
                                                                    <p>
                                                                        Reporting Logo (512 x 512)
                                                                    </p>
                                                                    <p class="dropify-error">Ooops,
                                                                        something wrong appended.</p>
                                                                </div>
                                                                <div class="dropify-loader"
                                                                     style="display: none;"></div>
                                                                <div class="dropify-errors-container">
                                                                    <ul></ul>
                                                                </div>
                                                                <input type="file" id="input-file-now"
                                                                       class="dropify" name="reporting_logo"
                                                                       data-default-file="">
                                                                <img src="{{ asset('images/company_info/'. $company_info->reporting_logo) }}" style="width: 32px; margin-top: 10px" alt="">
                                                                <button
                                                                    type="button"
                                                                    class="dropify-clear">Remove</button>
                                                                <div class="dropify-preview"
                                                                     style="display: none;"><span
                                                                        class="dropify-render"></span>
                                                                    <div class="dropify-infos">
                                                                        <div class="dropify-infos-inner">
                                                                            <p class="dropify-filename">
                                                                            <span
                                                                                class="file-icon"></span>
                                                                                <span
                                                                                    class="dropify-filename-inner">1618054231jLxKfola9cDg.jpg</span>
                                                                            </p>
                                                                            <p
                                                                                class="dropify-infos-message">
                                                                                Drag and drop or click to
                                                                                replace</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Reporting logo end -->


                                                    </div>

                                                    <div class="col-md-12 form-group text-right">
                                                        <button type="submit" class="btn btn-outline-dark">
                                                            Update Information
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- ITEM END -->

                                            </div>

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

    <script src="{{ asset('backend/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/js/form-file-uploads.min.js') }}"></script>
    <script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>
@endsection
