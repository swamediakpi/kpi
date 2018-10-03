<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="csrf-token" content="{!! csrf_token() !!}"/>
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<meta name="application-name" content="&nbsp;"/>
		<meta name="msapplication-TileColor" content="#FFFFFF" />
		<meta name="msapplication-TileImage" content="mstile-144x144.png" />
		<meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
		<meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
		<meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
		<meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

		<title>KPI PEGAWAI</title>

		 <!-- Bootstrap -->
		<link href= "{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">
		<!--  Theme Style -->
		<link href= " {{ asset('public/css/custom.min.css') }}" rel="stylesheet">
		

		<link href="{{ asset('public/css/jquery-ui.css') }}" rel="stylesheet" >
		<link href="{{ asset('public/css/jquery-ui-timepicker-addon.css') }}" rel="stylesheet">    
		<link href="{{ asset('public/css/dataTables.bootstrap.min.css') }}" type="text/css" rel="stylesheet"/>
		<link href="{{ asset('public/css/Table-Head.css') }}" type="text/css" rel="stylesheet"/> 
		<style>
			.table-head {
				color:#fff;
				background-color:#2A3F54;
				border-color:#32383e;
				text-align:center;
			}
			.table-head-absensi {
				color:#fff;
				background-color:#2A3F54;
				border-color:#32383e;
				text-align:left;
			}
			.number-absensi {
				text-align:right;
			}
			.ajax-loader {
				visibility: hidden;
				background-color: rgba(255,255,255,0.7);        
				position: absolute;
				z-index: +100 !important;
				width: 100%;
				height:100%;
			}

			.ajax-loader img {
				position: relative;
				top:50%;
				left:50%;
			}
		</style>

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

		<script src=" {{ asset('public/js/jquery.min.js') }}"></script>
		<script src=" {{ asset('public/js/jquery.js') }}"></script>

		<script src="{{ asset('public/js/jquery-ui.js') }} "></script>
		<script src="{{ asset('public/js/jquery-ui-timepicker-addon.js') }}"></script>    

		<script src=" {{ asset('public/js/highcharts.js') }}"></script>
		<script src=" {{ asset('public/js/drilldown.js') }}"></script>
		<script src=" {{ asset('public/js/exporting.js') }}"></script>

		<script src=" {{ asset('public/js/jquery.dataTables.min.js') }}"></script>
		<script src=" {{ asset('public/js/dataTables.bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset("public/js/FungsiSend.js") }}"></script>
	</head>

<script type="text/javascript">
	var baseUrl = '<?php echo URL::to('/');?>';
</script>
<body class="nav-md"> 
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">

						<img src="../public/css/landingpage/img/logo white.png" alt="logo-kpi" style="width:90px; margin-left:5%; margin-top:5%;" class="responesive">

					</div>

					<div class="clearfix"></div>
					<!-- menu profile quick info -->
					
					<!-- /menu profile quick info -->
					<br/>
					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>Menu</h3>
							<ul class="nav side-menu">
								<li><a href="#"><i class="fa fa-home"></i><span class="fa fa-chevron-down"></span> Dashboard Reporting</a>
									<ul class="nav child_menu">
										<li><a href="{{ url('/indexdasboardyf/absen') }}"><i class="fa fa-home"></i>Absen</a></li>
										<li><a href="{{ url('indexdasboardyf/duateratas') }}"><i class="fa fa-home"></i>Datang Tercepat</a></li>
										<li><a href="{{ url('/indexdasboardyf/duaterbawah') }}"><i class="fa fa-home"></i>Datang Terlambat</a></li>
									</ul>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						
					</nav>
				</div>
			</div>

			

			<!-- Modal -->
			<div class="modal fade" id="myModal1" role="dialog">
				<div class="modal-dialog modal-sm">    
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Error!</h4>
						</div>
				
						<div class="modal-body">
							<p style="color: red; text-align: center; font-size: 15px; font-weight: bold;" id="error1"></p>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="myModal2" role="dialog">
				<div class="modal-dialog modal-sm">    
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Success!</h4>
						</div>
					
						<div class="modal-body">
							<p style="color: green; text-align: center; font-size: 15px; font-weight: bold;" id="error2"></p>
						</div>
					</div>
				</div>
			</div>

			<div class="ajax-loader">
				<img src="{{ url('public/images/spinner.gif') }}" />
			</div>
			
			<div class="right_col" role="main">
				<div class="row">@yield('content')</div>
			</div>

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					<a href="https://colorlib.com"></a>Copyright &copy; KPI BIM 2017 
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>
	<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
	<!--  Theme Scripts -->
	<script src="{{ asset('public/js/custom.min.js') }}"> </script>
	<script>
              setTimeout(function(){// wait for 5 secs(2)
                    location.reload(); // then reload the page.(3)
                  }, 60000);
</script>
</body>