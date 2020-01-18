@include('layout.admin.partials.header')

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">@yield('header')</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        @yield('content')


        <!-- /.row -->
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

@include('layout.admin.partials.footer')