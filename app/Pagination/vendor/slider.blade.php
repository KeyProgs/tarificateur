<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="APP_URL" content="{{env('APP_URL')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('global-assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/core.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Main stylesheets -->
    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css">
    <!-- /main stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('global-assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/jquery.min.js')}}"></script>
    <script src="{{asset('global-assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script src="{{asset('global-assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('global-assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script src="{{asset('global-assets/js/demo_pages/login.js')}}"></script>

    <script src="{{asset('global-assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->

    <style type="text/css">
        #resource-slider {
            position: relative;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            /*height: 13em;*/
            height: 47.5em;;
            margin: auto;
            /*background: #fff;
            border: 1px solid #DDD;*/
            overflow: hidden;
            border-radius: 0px;
        }

        #resource-slider .arrow {
            cursor: pointer;
            position: absolute;
            width: 2em;
            height: 100%;
            padding: 0;
            margin: 0;
            outline: 0;
            background: transparent;
        }

        #resource-slider .arrow:hover {
            /*background: rgba(0, 0, 0, 0.1);*/
        }

        #resource-slider .arrow:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 0.75em;
            height: 0.75em;
            margin: auto;
            border-style: solid;
        }

        #resource-slider .prev {
            left: 0;
            bottom: 0;
        }

        #resource-slider .prev:before {
            left: 0.25em;
            border-width: 3px 0 0 3px;
            border-color: #333 transparent transparent #333;
            transform: rotate(-45deg);
        }

        #resource-slider .next {
            right: 0;
            bottom: 0;
        }

        #resource-slider .next:before {
            right: 0.25em;
            border-width: 3px 3px 0 0;
            border-color: #333 #333 transparent transparent;
            transform: rotate(45deg);
        }

        #resource-slider .resource-slider-frame {
            position: absolute;
            top: 0;
            left: 2em;
            right: 2em;
            bottom: 0;
            border-left: 0.25em solid transparent;
            border-right: 0.25em solid transparent;
            overflow: hidden;
        }

        #resource-slider .resource-slider-item {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 25%;
            height: 100%;
        }

        #resource-slider .resource-slider-inset {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: 0.5em 0.25em;
            overflow: hidden;
        }

        @media ( max-width: 60em ) {
            #resource-slider .resource-slider-item {
                width: 33.33%;
            }

            #resource-slider {
                height: 16em;
            }
        }

        @media ( max-width: 45em ) {
            #resource-slider .resource-slider-item {
                width: 50%;
            }
        }

        @media ( max-width: 30em ) {
            #resource-slider .resource-slider-item {
                width: 100%;
            }

            #resource-slider {
                height: 19em;
            }
        }
    </style>


</head>

<body class="login-container">

<!-- Main navbar -->
<div class="navbar navbar-inverse bg-grey-600 bg-indigo navbar-static-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="global-assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="#">
                    <i class="icon-display4"></i> <span
                            class="visible-xs-inline-block position-right"> Go to website</span>
                </a>
            </li>

            <li>
                <a href="#" title="">
                    <i class="icon-user-tie"></i> <span
                            class="visible-xs-inline-block position-right"> Contactez admin</span>
                </a>
            </li>


        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <div class="container">
                    <div class="col-md-12 row resources ">
                        <div class="container" id="resource-slider">
                            <!--<button class='btn-link arrow prev'></button>-->
                            <i class='icon-previous arrow prev'></i>
                            <!--<button class='arrow next'></button>-->
                            <i class='icon-next arrow next'></i>
                            <div class="resource-slider-frame">
                                <div class="row pricing-table">
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>1</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-success-300">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>2</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-danger-400">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>3</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-danger-400">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>4</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-danger-400">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>29</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-danger-400">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>29</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-danger-400">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>29</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-danger-400">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resource-slider-item">
                                        <div class="resource-slider-inset">
                                            <div class="resource">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="panel text-center rounded0">
                                                        <div class="panel-body">
                                                            <h4>Personal</h4>
                                                            <h1 class="pricing-table-price"><span>$</span>29</h1>
                                                            <ul class="list-unstyled content-group">
                                                                <li><strong>25GB</strong> space</li>
                                                                <li><strong>2GB</strong> RAM</li>
                                                                <li><strong>1</strong> domain</li>
                                                                <li><strong>5</strong> emails</li>
                                                                <li><strong>Daily</strong> backups</li>
                                                                <li><strong>24/7</strong> support</li>
                                                            </ul>
                                                            <a href="#"
                                                               class="rounded0 btn bg-success-400 btn-lg text-uppercase text-size-small text-semibold">Purchase</a>
                                                            <div class="ribbon-container">
                                                                <div class="ribbon bg-danger-400">Popular</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="resize">rzerzer</button>

                <script>

                    $(document).ready(function () {

                        function calculSize() {
                            function doneResizing() {
                                var totalScroll = $('.resource-slider-frame').scrollLeft();
                                var itemWidth = $('.resource-slider-item').width();
                                var difference = totalScroll % itemWidth;
                                if (difference !== 0) {
                                    $('.resource-slider-frame').animate({
                                        scrollLeft: '-=' + difference
                                    }, 500, function () {
                                        // check arrows
                                        checkArrows();
                                    });
                                }
                            }

                            function checkArrows() {
                                var totalWidth = $('#resource-slider .resource-slider-item').length * $('.resource-slider-item').width();
                                var frameWidth = $('.resource-slider-frame').width();
                                var itemWidth = $('.resource-slider-item').width();
                                var totalScroll = $('.resource-slider-frame').scrollLeft();

                                if (((totalWidth - frameWidth) - totalScroll) < itemWidth) {
                                    //$(".next").css("visibility", "hidden");
                                }
                                else {
                                    $(".next").css("visibility", "visible");
                                }
                                if (totalScroll < itemWidth) {
                                    //$(".prev").css("visibility", "hidden");
                                }
                                else {
                                    $(".prev").css("visibility", "visible");
                                }
                            }

                            $('.arrow').on('click', function () {
                                var $this = $(this),
                                    width = $('.resource-slider-item').width(),
                                    speed = 200;
                                if ($this.hasClass('prev')) {
                                    $('.resource-slider-frame').animate({
                                        scrollLeft: '-=' + width
                                    }, speed, function () {
                                        // check arrows
                                        checkArrows();
                                    });
                                } else if ($this.hasClass('next')) {
                                    $('.resource-slider-frame').animate({
                                        scrollLeft: '+=' + width
                                    }, speed, function () {
                                        // check arrows
                                        checkArrows();
                                    });
                                }
                            }); // end on arrow click

                            //$(window).on("load resize", function () {
                            checkArrows();
                            $('#resource-slider .resource-slider-item').each(function (i) {
                                var $this = $(this),
                                    left = $this.width() * i;
                                $this.css({
                                    left: left
                                })
                            });
                            //}); // end window resize/load

                            var resizeId;
                            $(window).resize(function () {
                                clearTimeout(resizeId);
                                resizeId = setTimeout(doneResizing, 500);
                            });
                        }
                        calculSize();
                        $('#resize').on('bind', function (){
                            calculSize();
                        })
                    })

                </script>

                <!-- Footer -->
                <div class="footer text-muted text-center">
                    &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
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

</body>
</html>
