@extends('client.layouts.client')

@section('content')
    <script src="{{asset('js/client/file.js')}}"></script>
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.client.client-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                @include('includes.client-page-header')
                <!-- /page header -->
                <!-- Content area -->
                <div class="content ">

                    <!-- Footer -->
                    @include('includes.footer')
                    <!-- /footer -->

                </div>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
@endsection