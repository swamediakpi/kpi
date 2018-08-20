<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Landing Page - KPI</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<meta name="application-name" content="&nbsp;"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
<!-- css -->
<link href="{{ asset('public/css/landingpage/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/css/landingpage/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/landingpage/jcarousel.css') }}" rel="stylesheet" />
<link href="{{ asset('public/css/landingpage/flexslider.css') }}" rel="stylesheet" />
<link href="{{ asset('public/css/landingpage/style.css') }}" rel="stylesheet" />
<link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- Theme skin -->
<link href="{{ asset('public/css/landingpage/default.css') }}" rel="stylesheet" />
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="ico/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="ico/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="ico/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="ico/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="ico/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="ico/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="ico/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="ico/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="ico/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="ico/favicon-128.png" sizes="128x128" />

</head>
<body>
<div id="wrapper">
    <!-- start header -->
    <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="public/css/landingpage/img/logo.png" width="85px" height="50px" alt=""></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html">Product</a></li>                        
                        <li><a href="#">Solution</a></li>
                        <li><a href="#">Learning</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <section id="featured" class="background-img">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <br><br><br>
                    <div class="row">
                        <div class="col-md-5">
                            <h1 class="font-custom">Mengelola Resource Tanpa Repot</h1>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-4 font-custom">
                            <p>
                                SWAKPI help the world's largest organizations<br>
                                unleash the power of their most valuable assets:their data and their people
                            </p>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-3">                            
                            <a href="{{ url('/login') }}" class="btn btn-round-lg btn-color btn-lg">Try Demo</a>
                        </div>  
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section>
    <!-- <div class="container"> -->
        <div class="" role="tabpanel" data-example-id="togglable-tabs">     
            <ul id="myTab" class="nav nav-tabs nav-justified col-md-12 col-sm-4 col-xs-12" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_content1" id="dashboard-tab" role="tab" data-toggle="tab" aria-expanded="true">
                        <img src="public/css/landingpage/img/dashboard icon.png" width="60px" height="40px" alt=""/>&nbsp;&nbsp;&nbsp;KPI Dashboards
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_content2" id="report-tab" role="tab" data-toggle="tab" aria-expanded="false">
                        <img src="public/css/landingpage/img/Report icon.png" width="60px" height="40px" alt=""/>&nbsp;&nbsp;&nbsp;KPI Report
                    </a>
                </li>
                <li role="presentation">
                    <a href="#tab_content3" id="analitic-tab" role="tab" data-toggle="tab" aria-expanded="false">
                        <img src="public/css/landingpage/img/analitic.png" width="60px" height="40px" alt=""/>&nbsp;&nbsp;&nbsp;KPI Analitics
                    </a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="dashboard-tab">
                    <div class="container">
                        <div class="col-lg-6">
                            <img src="public/css/landingpage/img/tete1.png" width="430px" height="300px" alt="">
                        </div>
                        <div class="col-lg-6" style="margin-top: 3%;">
                            <h5>KPI Dashboards</h5>
                            <p>
                                Tablue helps the world's largest organizations unleas the power of their most valuable assets: their data and their people.
                            </p>
                            <button class="btn btn-round-lg btn-color btn-lg">Learn More ></button>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="report-tab">
                    <div class="container">
                        <p>tesdasreport</p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="analitic-tab">
                    <div class="container">
                        <p>tesdasanaal</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
    </section>

    <section class="callaction">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="big-cta">
                    <div class="cta-text">
                        <h3 style="color: white;">"The easiest way to create, manage and visualise your Key Performance Indicator"</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section id="featured" class="color-bg">
        <div class="container">         
            <div class="col-lg-6" style="margin-top: 13%;">
                <h5>What is a KPI ?</h5>
                <p>
                    A Key Performance indikator (KPI) is a type of measure that is used to evaluate the performance of an organization against its strategic objectives. KPIs help to cut the complexity associated with performance tracking by reducing a large amount of measures into a practical number of 'key' indicator
                </p>
                <button class="btn btn-round-lg btn-color btn-lg">Learn More ></button>
            </div>
            <div class="col-lg-6" style="margin-top: 7%;">
                <img src="public/css/landingpage/img/KPI.png" width="500px" height="300px" alt="">
            </div>          
        </div>      
    </section>
    <section id="featured-why-with-us">
        <div class="container">
            <div class="col-lg-12">
                <h4><strong>Why</strong> with us</h4>
            </div>
            <div class="col-lg-4">
                <div class="pricing-box-alt">
                    <div class="pricing-heading">
                        <img src="public/css/landingpage/img/image1.png" alt="" width="250px" height="150px">
                    </div>
                    <div class="pricing-content">
                        <h5>Who we are</h5>
                        <p>The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin.</p>
                    </div>
                    <div class="pricing-action">
                        <button class="btn btn-round-lg btn-color btn-lg">READ MORE</button>
                    </div>                  
                </div>
            </div>
            <div class="col-lg-4">
                <div class="pricing-box-alt">
                    <div class="pricing-heading">
                        <img src="public/css/landingpage/img/image2.png" alt="" width="250px" height="150px">
                    </div>
                    <div class="pricing-content">
                        <h5>Our Community</h5>
                        <p>The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin.</p>
                    </div>
                    <div class="pricing-action">
                        <button class="btn btn-round-lg btn-color btn-lg">READ MORE</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="pricing-box-alt">
                    <div class="pricing-heading">
                        <img src="public/css/landingpage/img/imag3.png" alt="" width="250px" height="150px">
                    </div>
                    <div class="pricing-content">
                        <h5>Our Portfolio</h5>
                        <p>The lorem ipsum text is typically a scrambled section of De finibus bonorum et malorum, a 1st-century BC Latin text by Cicero, with words altered, added, and removed to make it nonsensical, improper Latin.</p>
                    </div>
                    <div class="pricing-action">
                        <button class="btn btn-round-lg btn-color btn-lg">READ MORE</button>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    
    <div id="footer1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="padding: 5%;">
                <h2 style="color: white;">For try This Product</h2>
            </div>
            <div class="col-lg-6" style="padding-top: 5%; padding-left: 15%;">
                <input type="text" id="foot-input" placeholder="Your Email">
            </div>
        </div>
    </div>
    </div>
    <div id="footer2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="padding-top: 5%;">
                <img src="public/css/landingpage/img/logo white.png" alt="">
                <p style="padding-top: 5%; color: white;">
                    A Key Performance indikator (KPI) is a type of measure<br>that is used to evaluate the performance of an organization<br>against its.
                </p>
            </div>
            <div class="col-lg-6" style="padding-top: 5%; padding-left: 15%;">
                <img src="public/css/landingpage/img/map.png" alt="">
            </div>
        </div>
    </div>  
    <div id="sub-footer" class="bg-sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright">                     
                        <div class="credits">                            
                            Copyright by SWAMEDIA INFORMATIKA
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="social-network">
                        <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>  
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('public/js/landingpage/jquery.js') }}"></script>
<script src="{{ asset('public/js/landingpage/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/landingpage/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset('public/js/landingpage/custom.js') }}"></script>

</body>
</html>