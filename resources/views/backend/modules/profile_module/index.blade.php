@extends("backend.template.layout")

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/dropify.min.css') }}">
<style>
    .password-box{
        position: relative;
    }
    .password-box .hide-password{
        display: none;
    }
    .password-box .password-eye{
        position: absolute;
        top: 57%;
        right: 15px;
        z-index : 10;
        cursor : pointer;
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
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                Profile
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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" alt="User profile picture"
                                @if(auth('web')->check())

                                    @if(auth('web')->user()->image == null )
                                        src="{{ asset('images/profile/user.png') }}"
                                    @else
                                        src="{{ asset('images/profile/'.auth('web')->user()->image ) }}"
                                    @endif

                                @endif
                                >
                            </div>

                            <h3 class="profile-username text-center">
                                @if( auth('web')->check() )
                                {{ auth('web')->user()->name }}
                                @endif
                            </h3>

                            <p class="text-muted text-center">
                                @if( auth('web')->check() )
                                {{ auth('web')->user()->role->name }}
                                @endif
                            </p>

                            <a href="#" class="btn btn-primary btn-block" onclick="document.getElementById('logout-form').submit()">
                                <b>
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Logout
                                    <form action="{{route('do.logout')}}" method="post" id="logout-form">@csrf</form>
                                </b>
                            </a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#basic_information" data-toggle="tab">
                                        Basic Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#change_password" data-toggle="tab">
                                        Change Password
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <!-- TAB PANEL START -->
                                <div class="row tab-pane active" id="basic_information">
                                    <form class="ajax-form" method="post" enctype="multipart/form-data"
                                    @if(auth('web')->check())
                                    action="{{ route('profile.edit',auth('web')->user()->id) }}"
                                    @endif
                                    >
                                    @csrf
                                        <!-- name -->
                                        <div class="col-auto form-group">
                                            <label>
                                                    Name
                                            </label><span class="require-span">*</span>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="name" class="form-control" placeholder="Name"
                                                @if( auth('web')->check() )
                                                value="{{ auth('web')->user()->name }}"
                                                @endif
                                                >
                                            </div>
                                        </div>

                                        <!-- email -->
                                        <div class="col-auto form-group">
                                            <label>
                                                Email
                                            </label><span class="require-span">*</span>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                </div>
                                                <input type="email" name="email" class="form-control" readonly placeholder="Email"
                                                @if( auth('web')->check() )
                                                value="{{ auth('web')->user()->email }}"
                                                @endif
                                                >
                                            </div>
                                        </div>

                                        <!-- phone -->
                                        <div class="col-auto form-group">
                                            <label>
                                                Phone
                                            </label><span class="require-span">*</span>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="phone" class="form-control" placeholder="Phone"
                                                @if( auth('web')->check() )
                                                value="{{ auth('web')->user()->phone }}"
                                                @endif
                                                >
                                            </div>
                                        </div>

                                        <!-- image -->
                                        <div class="col-auto form-group">
                                            <div class="dropify-wrapper">
                                                <div class="dropify-message"><span
                                                        class="file-icon"></span>
                                                    <p>
                                                        Profile Picture
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
                                                    class="dropify" name="image"
                                                    data-default-file="">
                                                    <img src="{{ asset('images/profile/'. auth('web')->user()->image) }}" style="width: 50px; margin-top: 10px" alt="">
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

                                        <div class="col-auto form-group text-right">
                                            <button type="submit" class="btn btn-outline-dark">
                                                Update Profile
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- TAB PANEL END -->

                                <!-- TAB PANEL START -->
                                <div class="tab-pane" id="change_password">
                                    <form class="ajax-form" method="post" enctype="multipart/form-data" 
                                    @if(auth('web')->check())
                                    action="{{ route('profile.password',auth('web')->user()->id) }}"
                                    @endif
                                    >
                                    @csrf

                                        <!-- old password -->
                                        <div class="col-auto form-group password-box">
                                            <i class="fas fa-eye show-password password-eye"></i>
                                            <i class="fas fa-eye-slash hide-password password-eye"></i>
                                            <label>
                                                    Old Password
                                            </label><span class="require-span">*</span>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-key"></i>
                                                    </div>
                                                </div>
                                                <input type="password" name="old_password" id="password-field" class="form-control" placeholder="Old Password"
                                                >
                                            </div>
                                        </div>

                                        <!-- new password -->
                                        <div class="col-auto form-group password-box">
                                            <i class="fas fa-eye show-password password-eye"></i>
                                            <i class="fas fa-eye-slash hide-password password-eye"></i>
                                            <label>
                                                    New Password
                                            </label><span class="require-span">*</span>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-key"></i>
                                                    </div>
                                                </div>
                                                <input type="password" name="password" id="password-field" class="form-control" placeholder="New Password"
                                                >
                                            </div>
                                        </div>

                                        <!-- new password -->
                                        <div class="col-auto form-group password-box">
                                            <i class="fas fa-eye show-password password-eye"></i>
                                            <i class="fas fa-eye-slash hide-password password-eye"></i>
                                            <label>
                                                    Confirm Password
                                            </label><span class="require-span">*</span>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-key"></i>
                                                    </div>
                                                </div>
                                                <input type="password" name="password_confirmation" id="password-field" class="form-control" placeholder="Confirm Password"
                                                >
                                            </div>
                                        </div>


                                        <div class="col-auto form-group text-right">
                                            <button type="submit" class="btn btn-outline-dark">
                                                Change Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- TAB PANEL END -->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/js/form-file-uploads.min.js') }}"></script>
<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>
<script>
    $(".show-password").click(function () {
        let $this = $(this)
        $this.closest(".password-box").find("#password-field").attr("type", "text")
        $this.closest(".password-box").find(".show-password").hide()
        $this.closest(".password-box").find(".hide-password").show()
    })

    $(".hide-password").click(function () {
        let $this = $(this)
        $this.closest(".password-box").find("#password-field").attr("type", "password")
        $this.closest(".password-box").find(".show-password").show()
        $this.closest(".password-box").find(".hide-password").hide()
    })
</script>
@endsection
