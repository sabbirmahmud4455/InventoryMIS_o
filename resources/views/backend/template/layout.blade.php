<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    @include("backend.includes.css")
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- NAV BAR START -->
        @include("backend.includes.navbar")
        <!-- NAV BAR END -->

        <!-- LEFT SIDEBAR START -->
        @include("backend.includes.leftsidebar")
        <!-- LEFT SIDEBAR END -->

        <!-- Content Wrapper. Contains page content -->
        <div class="loading">Loading&#8230;</div>
        @yield('body-content')
        <!-- /.content-wrapper -->

        <!-- MY MODAL -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!-- MY MODAL END -->

        <!-- MY MODAL large -->
        <div class="modal fade bd-example-modal-lg" id="largeModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                </div>
            </div>
        </div>
        <!-- MY MODAL large END -->


        <!-- FOOTER START -->
        @include("backend.includes.footer")
        <!-- FOOTER END -->

    </div>
    <!-- ./wrapper -->

    @include("backend.includes.script")
</body>

</html>
