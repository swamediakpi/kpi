@extends('layouts.master')

@section('content')
	<!-- <h2>{{ Auth::user()->EMPLOYEE_NAME }}</h2> -->
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="dashboard_graph">
				<div class="row x_title">
					<div class="col-md-6">
						<h2>Dashboard</h2>
						<ul class="nav navbar-right panel_toolbox"></ul>
						<div class="clearfix"></div>
						<div class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-3 col-xs-12">Year</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select id="f_tahun" class="form-control">
										<option value="">Select Year</option>
										@foreach ($tahun as $listtahun)
											<option value="{{ $listtahun->TAHUN}}">{{ $listtahun->TAHUN}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-12 col-sm-4 col-xs-12">
			<div class="x_panel tile fixed_height_320">
				<div class="x_title">
					<h2>Employee Mandays Project</h2>
					<div class="clearfix"></div>
				</div>
			
				<div class="x_content">
					<div class="w_center w_55">
						<div id="ChartEvo" name="ChartEvo" style="width: 185%; height: 200px;"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){ 

	});
</script>

@endsection