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
	<style>
	
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
	<script src=" {{ asset('public/js/exporting.js') }}"></script>
	
	<script src=" {{ asset('public/js/jquery.dataTables.min.js') }}"></script>
	<script src=" {{ asset('public/js/dataTables.bootstrap.min.js') }}"></script>

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
						   
			  <img src="public/css/landingpage/img/logo white.png" alt="logo-kpi" style="width:90px; margin-left:5%; margin-top:5%;">
			</div>

			<div class="clearfix"></div>

			<!-- menu profile quick info -->
			<div class="profile clearfix">
			  <div class="profile_pic">
			  {{-- class="img-circle profile_img" --}}
				<img src="public/avatars/{{ Auth::user()->avatar }}" alt="..." class="img-circle profile_img" style="width: 80px;">
			  </div>
			  <div class="profile_info">
				<span>Welcome,</span>
				<h2>{{ Auth::user()->EMPLOYEE_NAME }}</h2>
			  </div>
			</div>
			<!-- /menu profile quick info -->
			<br/>
			<!-- sidebar menu -->
			<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			  <div class="menu_section">
				<h3>Menu</h3>
				<ul class="nav side-menu">
				  <li><a href="{{ url('/index') }}"><i class="fa fa-home"></i> Dashboard</a></li>
				  <li><a href="{{ url('/index') }}"><i class="fa fa-home"></i> Dashboard 2</a></li>
				  <li><a href="{{ url('/reportkpi') }}"><i class="fa fa-sticky-note"></i> Reporting KPI</a></li>
				  <li><a href="#"><i class="fa fa-briefcase"></i> Kinerja <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
	  
					  <li><a href="{{ url('/absensi') }}">Absensi</a></li>
					  <li><a href="{{ url('/days') }}">Days Project</a></li>
					  <li><a href="{{ url('/pmis') }}">PMIS</a></li>
					  <li><a href="{{ url('/hrd') }}">HRD</a></li>
					  <li><a href="{{ url('/pmo') }}">PMO</a></li>
					  <li><a href="{{ url('/asman') }}">UNIT</a></li>

					</ul>
				  </li>
				 @if (Auth::user()->ROLE_ID == '5')
				  {{-- <li><a href="#"><i class="fa fa-user"></i> Admin <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					  <li><a href="{{ url('/admin') }}">Input Admin</a></li>
					  <li><a href="{{ url('/input_unit') }}">Input Unit</a></li>
					</ul>
				  </li> --}}
				  <li><a href="#"><i class="fa fa-edit"></i> Edit <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					  <li><a>Days Project Emp Live<span class="fa fa-chevron-down"></span></a>
						  <ul class="nav child_menu">
							<li><a href="{{ url('/edit_days_project') }}">Forget</a>
							</li>
							<li><a href="{{ url('/edit_days_project_touch') }}">Touched</a>
							</li>
						  </ul>
					  </li>                      
					  <li><a href="{{ url('/edit_given_point') }}">Given Point</a></li>  
					  <li><a href="{{ url('/edit_mandays_project') }}">Mandays Project</a></li>
					  <li><a href="{{ url('/edit_single_mndyproject') }}">Single Mandays Project</a></li>
					  <li><a href="{{ url('/edit_project') }}">Project</a></li>                      
					</ul>
				  </li>

				  <li><a href="#"><i class="fa fa-check-square-o"></i> Input <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					  <li><a href="{{ url('/input_emp') }}">Employee</a></li>
					  <li><a href="{{ url('/project') }}">Project</a></li>
					  <li><a href="{{ url('/holiday') }}">Holiday</a></li>
					  {{-- <li><a href="{{ url('/input_unit') }}">Nama Unit</a></li> --}}
					  <li><a href="{{ url('/input_given_point') }}">Given Point</a></li>
					  <li><a href="{{ url('/newcase') }}">Single Mandays Project </a></li>
					</ul>
				  </li>           
				  <li><a href="{{ url('/days_project') }}"><i class="fa fa-bar-chart"></i>Days Project Employee</a></li>                  
							<li><a href="{{ url('/view_emp') }}"><i class="fa fa-bar-chart"></i>View Employee</a></li>
				  @endif
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

			  <ul class="nav navbar-nav navbar-right">
				<li class="">
				  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<img src="" alt="">{{ Auth::user()->EMPLOYEE_NAME }}
					<span class=" fa fa-angle-down"></span>
				  </a>
				  <ul class="dropdown-menu dropdown-usermenu pull-right">
					<li><a href="" data-toggle="modal" data-target="#modalphoto"><i class="fa fa-cog pull-right"></i>Change Photo</a>
					</li>               
					<li><a href="{{ url('/logout') }}"
					onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
					</li>
				  </ul>
				</li>
			  </ul>
			</nav>
		  </div>
		</div>

		<!-- Modal Edit Photo -->
		<div class="modal fade" id="modalphoto" role="dialog">
			<div class="modal-dialog">          
			  <!-- Modal content-->
			  <div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Photo</h4>
				  </div>
				  <div class="modal-body">                
					  <img src="public/avatars/{{ Auth::user()->avatar }}" style="width:80px; height:80px; margin-right: 25px; float: left; border-radius: 50%;">
					  <h2>{{ Auth::user()->EMPLOYEE_NAME }}'s Profile</h2>
					  <form enctype="multipart/form-data" method="POST" action="{{ url('/indexphoto') }}">
						  <label>Update Profile Image</label>
						  <br>
						  <label style="color: red">*Maximum 1,5 MB</label>
						  <input type="file" name="avatar">
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">
						  <input type="submit" class="pull-right btn btn-sm btn-primary" value="Submit">
					  </form>
				  </div>
				 {{--  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div> --}}
			  </div>            
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
			<div class="row">       
			  @yield('content')            
		  </div>
		</div>
		<!-- footer content -->
		<footer>
		  <div class="pull-right"><a href="https://colorlib.com"></a>
			  Copyright &copy; KPI BIM 2017 
		  </div>
		  <div class="clearfix"></div>
		</footer>
		<!-- /footer content -->
	  </div>
	</div>     
	<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
	<!--  Theme Scripts -->
	<script src="{{ asset('public/js/custom.min.js') }}"> </script>
</body>