<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset="UTF-8">
		<title>{{ $page_title or "KPI PEGAWAI" }}</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="csrf_token" content="{{ csrf_token() }}">

		<link type="text/css" rel="stylesheet" href="{{ asset("public/bower_components/components.css") }}" />
		<link type="text/css" rel="stylesheet" href="{{ asset("public/bower_components/custom.css") }}" />

		<meta name="application-name" content="&nbsp;"/>
		<meta name="msapplication-TileColor" content="#FFFFFF" />
		<meta name="msapplication-TileImage" content="mstile-144x144.png" />
		<meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
		<meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
		<meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
		<meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

		<link href="{{ asset("public/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset("public/bower_components/AdminLTE/plugins/select2/select2.min.css") }}" rel="stylesheet" >
		<link href="{{ asset("public/bower_components/AdminLTE/plugins/iCheck/all.css") }}" rel="stylesheet" >
		<link href="{{ asset("public/bower_components/AdminLTE/plugins/iCheck/all.css") }}" rel="stylesheet">
		<link href="{{ asset("public/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset("public/bower_components/AdminLTE/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" >
		<link href="{{ asset("public/bower_components/AdminLTE/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset("public/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" >
		<style type="text/css">
			tr.group,
			tr.group:hover {
				background-color: #000 !important;
			}
		</style>
		<script type="text/javascript" src="{{ asset("public/js/FungsiSend.js") }}"></script>
		<script type="text/javascript">
			var urlbase = "{{ asset("") }}";
		</script>
	</head>

	<body class="skin-blue">
		<div class="wrapper">
			
			<!-- Header -->
			<header class="main-header">
				<a href="#" class="logo" style="height: 80px;">
					<img src="{{ asset ("public/css/landingpage/img/logo white.png") }}" alt="logo-kpi">
				</a>
				<nav class="navbar navbar-static-top" role="navigation" style="height: 80px;">
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
				</nav>
			</header>

			<!-- Sidebar -->
			<aside class="main-sidebar" style="padding-top: 80px;">
				<section class="sidebar">
					<ul class="sidebar-menu">
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-home"></i>
								<span>Dashboard Reporting</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>

							<ul class="treeview-menu">
									<li><a href="{{ url('/indexdasboardyf/absen') }}"><i class="fa fa-home"></i>Absen</a></li>
										<li><a href="{{ url('indexdasboardyf/duateratas') }}"><i class="fa fa-home"></i>Project Berjalan</a></li>
										<li><a href="{{ url('/indexdasboardyf/duaterbawah') }}"><i class="fa fa-home"></i>Rekap absen</a></li>
							</ul>
						</li>
					</ul>
					
					
				</section>
			</aside>

			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						{{ $page_title or "" }}
					</h1>
					@yield('contentLevel')
				</section>

				<!-- Main content -->
				<section class="content">
					@yield('content')
				</section>
			</div>

			<!-- Footer -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					KPI BIM
				</div>
				<strong>Copyright © 2017 <a href="#">PT. Swamedia Informatika</a>.</strong>
			</footer>
		</div>

		<script src="{{ asset ("public/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
		<script src="{{ asset ("public/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
		<script src="{{ asset ("public/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
		<script src="{{ asset ("public/bower_components/AdminLTE/plugins/datatables.net/js/jquery.dataTables.min.js") }}"></script>
		<script src="{{ asset ("public/bower_components/AdminLTE/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
		<script src="{{ asset ("public/bower_components/AdminLTE/plugins/select2/select2.full.min.js") }}"></script>
		<script src="{{ asset ("public/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
		<script src="{{ asset ("public/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
		<script src="{{ asset ("public/js/bootstrap3-typeahead.min.js") }}"></script>
		<script src="{{ asset ("public//js/jquery.formautofill.min.js") }}"></script>
		<script src="{{ asset ("public//js/jquery.form.min.js") }}"></script>
		<script src="{{ asset ("public/js/marquee.js") }}" type="text/javascript"></script>

		<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		<script src="https://code.highcharts.com/modules/drilldown.js"></script>

		@stack('scripts')
	</body>
</html>
	
<script src="http://code.jquery.com/jquery-3.1.1.js"></script>
<script type="text/javascript">
setTimeout(function(){// wait for 5 secs(2)
                    location.reload(); // then reload the page.(3)
                  }, 360000);
</script>
</body>