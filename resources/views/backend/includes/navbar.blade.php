<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- USER PROFILE DROPDOWN START -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i> &nbsp;&nbsp; {{ auth('web')->user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a
                @if( auth('web')->check() )
                href="{{ route('profile.show',auth('web')->user()->email) }}"
                @endif

                class="dropdown-item">
                    <i class="fas fa-user mr-2"></i>
                    {{ auth('web')->user()->name }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" onclick="document.getElementById('logout-form').submit()" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                    <form action="{{route('do.logout')}}" method="post" id="logout-form">@csrf</form>
                </a>
            </div>
        </li>
        <!-- USER PROFILE DROPDOWN END -->

    </ul>
</nav>
