@include('layout.header')

    <div class="wrapper">

        @include('layout.main-header')

        @include('layout.main-sidebar')

        <!-- ============ Main content ============ -->
        <div class="content-wrapper">

            @yield('page-header')

            @yield('content')


        </div>
    </div>
        </div>
    </div>
    <!--=================================
 footer -->
@include('layout.footer')

