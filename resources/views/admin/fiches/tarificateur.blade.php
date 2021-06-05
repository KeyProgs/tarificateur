@extends('layouts.utilisateur')
@section('content')
    <script src="{{asset('js/fiches/fiche.js')}}"></script>
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.utilisateur-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content hidden">
                        <div class="page-title">
                            <h4>
                                <i class="icon-files-empty position-left"></i>
                                <span class="text-semibold">Fiche</span> - Details
                            </h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                                            class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                                            class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                                            class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="index.html"><i class="icon-home2 position-left"></i> Accueil </a></li>
                            <li class="active">Fiche Details</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i>
                                    Settings
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content p0">


                    {{$data['nom']}}
                    {{$user->nom}}

                    <script src="{{asset('global-assets/js/plugins/pagination/bs_pagination.min.js')}}"></script>
                    <script src="{{asset('global-assets/js/demo_pages/components_pagination.js')}}"></script>


                    <!--  Debut pagination  -->
                    <div class="panel panel-body border-top-teal text-center">
                        <h6 class="no-margin text-semibold">Prev/Next buttons</h6>
                        <p class="content-group-sm text-muted">Configurable buttons text</p>

                        <div class="well content-group twbs-content-prev-next text-left">Page 10</div>
                        <ul class="pagination-flat pagination-sm twbs-prev-next pagination">
                            <li class="page-item first"><a href="#" class="page-link">⇤</a></li>
                            <li class="page-item prev"><a href="#" class="page-link">⇠</a></li>
                            <li class="page-item"><a href="#" class="page-link">9</a></li>
                            <li class="page-item active"><a href="#" class="page-link">10</a></li>
                            <li class="page-item"><a href="#" class="page-link">11</a></li>
                            <li class="page-item"><a href="#" class="page-link">12</a></li>
                            <li class="page-item next"><a href="#" class="page-link">⇢</a></li>
                            <li class="page-item last"><a href="#" class="page-link">⇥</a></li>
                        </ul>
                    </div>


                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; 2018. <a href="#">ACS CRM</a> by <a
                                href="" target="_blank">ACS</a>
                    </div>
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