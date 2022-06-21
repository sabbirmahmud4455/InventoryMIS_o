<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ __('Role.AddNewRole') }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('user.add') }}">
        @csrf

        <div class="row">

            <!-- name -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">{{ __('User.Name') }}</label><span class="require-span">*</span>
                <input type="text" class="form-control" name="name" >
            </div>

            <!-- email -->
            <div class="col-md-6 col-12 form-group">
                <label for="email">{{ __('User.Email') }}</label><span class="require-span">*</span>
                <input id="email" type="email" class="form-control" name="email">
            </div>

            <!-- phone number -->
            <div class="col-md-6 col-12 form-group">
                <label for="phone">Phone</label><span class="require-span">*</span>
                <input id="phone" type="text" class="form-control" name="phone">
            </div>

            <!-- select role -->
            <div class="col-md-6 col-12 form-group">
            <label>Please select a user role</label><span class="require-span">*</span>
                <select name="role_id" class="form-control select2">
                    <option selected disabled>Select a user role</option>
                    @foreach( $roles as $role )
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- confirm password -->
            <div class="col-md-6 col-12 form-group password-box">
                <i class="fas fa-eye show-password"></i>
                <i class="fas fa-eye-slash hide-password"></i>
                <label>Password</label><span class="require-span">*</span>
                <input type="password" class="form-control" name="password" id="password-field">
            </div>

            <!-- confirm password -->
            <div class="col-md-6 col-12 form-group password-box">
                <i class="fas fa-eye show-password"></i>
                <i class="fas fa-eye-slash hide-password"></i>
                <label>Confirm Password</label><span class="require-span">*</span>
                <input type="password" class="form-control" name="password_confirmation" id="password-field">
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    {{ __('User.Add') }}
                </button>
            </div>

        </div>
    </form>
</div>
<div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
 </div>



<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

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



