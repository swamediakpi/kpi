@extends('layouts.master')

@section('content')
<div class="row">
	<div id=\"yfReportContainer59f3bf13-4f3a-4517-8a83-bd950357621a\"></div>
</div>
<!-- <script type="text/javascript" src="http://localhost:8090/JsAPI?dashUUID=0537286a-a4a7-411d-9650-d6003810018c"></script> -->
<script type="text/javascript" src="http://localhost:8090/JsAPI?reportUUID=59f3bf13-4f3a-4517-8a83-bd950357621a&amp;yfFilterfec90b31-c705-4e98-b651-6f191d099041=Ade+Setiyanto"></script>

<script type="text/javascript" src="http://localhost:8090/JsAPI?reportUUID=1bfad5e3-5389-4bc2-9c94-d113179e9174&amp;yfFilterf815dfd4-1908-4641-b521-7374883b1026=Ade+Setiyanto"></script>

<script type="text/javascript" src="http://localhost:8090/JsAPI?reportUUID=a5ab3580-f915-4026-b747-77660e4368d8&amp;yfFilter072022f4-27d1-4479-969e-3bceabe7c944=Ade+Setiyanto"></script>

  <!-- <div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">
		  <div class="row x_title">
			<div class="col-md-6">
			  <h2>Dashboard</h2>
			  <ul class="nav navbar-right panel_toolbox">
			</ul>
			<div class="clearfix"></div>
			<div class="form-horizontal form-label-left">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
				  <label class="control-label col-md-2 col-sm-3 col-xs-12">Year</label>
				  <div class="col-md-9 col-sm-9 col-xs-12">
					<select id="f_tahun" class="form-control">
					  <option value="">Select Year</option>
					  <option value="2017">2017</option>
					  <option value="2018">2018</option>
					  <option value="2019">2019</option>                      
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
	<div class="col-md-6 col-sm-4 col-xs-12">
	  <div class="x_panel tile fixed_height_320">
		  <div class="x_title">
			<h2>Mandays</h2>
			<ul class="nav navbar-right panel_toolbox">
			</ul>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">            
			  <div class="w_center w_55">
				<div id="mandaysChart" name="mandaysChart" style="width: 500px; height: 300px;"></div>
			  </div>
			  <div class="clearfix"></div>
		  </div>
	  </div>
	</div>
	<div class="col-md-6 col-sm-4 col-xs-12">
	  <div class="x_panel tile fixed_height_320 overflow_hidden">
		<div class="x_title">
		  <h2>Employee</h2>
		  <ul class="nav navbar-right panel_toolbox">
		  </ul>
		  <div class="clearfix"></div>
		  <div class="form-horizontal form-label-left">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
				  <label class="control-label col-md-2 col-sm-3 col-xs-12">Project</label>
				  <div class="col-md-9 col-sm-9 col-xs-12">
					<select id="f_nama_graf" class="form-control">
					  <option value="">Select Project Name</option>            
					  <option value="" disabled="true" selected="true">Choose Year First</option>
					</select>
				  </div>
				</div>               
		  </div>
		</div>
		<div class="x_content">
		  <div id="employeeChart" name="employeeChart" style="width: 500px; height: 200px;"></div>
		</div>
	  </div>
	</div>
</div>

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

	$('#f_tahun').change(function(){
		
		var p_tahun = $('#f_tahun').val();
		var op = "";

		$.ajax({
				
			 type  :'get',
			 url   :'{{URL::to('getProjectFromYear')}}',
			 data  : {'p_tahun':p_tahun},
			 beforeSend: function(){
				$('.ajax-loader').css("visibility", "visible");
			  },
			 success:function(data){
				
			   $('#f_nama_graf option').remove();

			   if(data.length == ""){

				  op+='<option value="" >Empty</option>';

			   }else{

				   op+='<option value="" >Choose Project</option>';

				   for(var i = 0 ; i < data.length ; i++){
					 op+='<option value="'+data[i].PROJECT_DETAIL_ID+'">'+data[i].PROJECT_NAME+'</option>';
				   }

				}                               
				   $('#f_nama_graf').append(op);                      
			  },
				complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			   }
		});

		$.ajax({

			url : baseUrl +'/index/GrafMnd',
			type: 'POST',
			data: {'p_tahun': p_tahun},
			dataType: 'json',
			beforeSend: function(){
				$('.ajax-loader').css("visibility", "visible");
			},
			success : function(data){

			  var project_name = [];
			  var project_duration = [];
								
			  if(data == ""){
				
				 Highcharts.chart('mandaysChart', {
					title: {
						text: ''
					},
					yAxis: {
					enabled: true,
					title: {
						text: 'Mandays'
						}
					},
					xAxis: {
						categories: 0
					},
					plotOptions: {  
						column: {
							dataLabels: {
								enabled: true
							}
						}
					},    
					series: [{
						name: 'Mandays',
						type: 'column',       
						data: 0,
						color: '#337AB8',
					}]
				});
						
			  }else{

				for (var i = 0; i < data.length; i++)
				{
				  var obj = data[i];
				  project_name[i] = obj.PROJECT_NAME;
				  project_duration[i] = obj.PROJECT_DURATION;
				}
				
				Highcharts.chart('mandaysChart', {
					title: {
						text: ''
					},
					yAxis: {
					enabled: true,
					title: {
						text: 'Mandays'
						}
					},
					xAxis: {
						categories: project_name
					},
					plotOptions: {  
						column: {
							dataLabels: {
								enabled: true
							}
						}
					},    
					series: [{
						name: 'Mandays',
						type: 'column',       
						data: project_duration,
						color: '#337AB8',
					}]
				});                  
			  }
			},
				complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			   }
		});

		$.ajax({

			url : baseUrl +'/index/GrafEvo',
			type: 'POST',
			data: {'p_tahun': p_tahun},
			dataType: 'json',
			beforeSend: function(){
				$('.ajax-loader').css("visibility", "visible");
			},
			success : function(data){

			  var project_name = [];
			  var project_duration = [];
			  var days = [];
			  var realize_time = [];

			  if(data == ""){
				Highcharts.chart('ChartEvo', {
				  chart: {
					  type: 'line'
				  },
				  title: {
					  text: 'Graph Relation Mandays Project with Employee'
				  },

				  yAxis: {
					  title: {
						  text: 'Days'
					  }
				  },

				  legend: {
					  layout: 'vertical',
					  align: 'right',
					  verticalAlign: 'middle'
				  },

				  xAxis: {
					  categories: 0
				  },

				  series: [{
					  name: 'Mandays',
					  data: 0
				  },{
					  name: 'Work Duration',
					  data: 0
				  },
				  {
					  name: 'Relize Time',
					  data: 0
				  }
				  ],

				  responsive: {
					  rules: [{
						  condition: {
							  maxWidth: 500
						  },
						  chartOptions: {
							legend: {
								layout: 'horizontal',
								align: 'center',
								verticalAlign: 'bottom'
							}
						  }
					  }]
				  }
				});//tutup chart

			  }else{       
						
				for (var i = 0; i < data.length; i++)
				{
				  var obj = data[i];
				  project_name[i] = obj.PROJECT_NAME;
				  project_duration[i] = obj.PROJECT_DURATION;           
				  days[i] = parseInt(obj.WORK_DURATION);
				  realize_time[i] = parseInt(obj.realize_time);
				}

				Highcharts.chart('ChartEvo', {
				  chart: {
					  type: 'line'
				  },
				  title: {
					  text: 'Graph Relation Mandays Project with Employee'
				  },

				  yAxis: {
					  title: {
						  text: 'Days'
					  }
				  },

				  legend: {
					  layout: 'vertical',
					  align: 'right',
					  verticalAlign: 'middle'
				  },

				  xAxis: {
					  categories: project_name
				  },

				  series: [{
					  name: 'Mandays',
					  data: project_duration
				  },{
					  name: 'Work Duration',
					  data: days
				  },{
					  name: 'Relize Time',
					  data: realize_time
				  }],

				  responsive: {
					  rules: [{
						  condition: {
							  maxWidth: 500
						  },
						  chartOptions: {
							legend: {
								layout: 'horizontal',
								align: 'center',
								verticalAlign: 'bottom'
							}
						  }
					  }]
				  }
				});//tutup chart
			  }      
			},
			complete: function(){
			 $('.ajax-loader').css("visibility", "hidden");
		   }
		});   
	});


	$('#f_nama_graf').change(function(){

		var nama = $('#f_nama_graf').val();

		$.ajax({
			url : baseUrl +'/index/GrafEmp',
			type: 'POST',
			data: {'nama': nama},
			dataType: 'json',
			beforeSend: function(){
				$('.ajax-loader').css("visibility", "visible");
			},
			success : function(data){

			  var employee_name = [];
			  var workduration = [];
			  var projectduration = [];

			  if(data == ""){
				
				$("#error1").html("Project Worker is Not Available!");
				$('#myModal1').modal("show");

				Highcharts.chart('employeeChart', {
					chart: {
					  type: 'column'
					},
					title: {
						text: ''
					},
					yAxis: {
					enabled: true,
					title: {
						text: 'Days'
						}
					},
					xAxis: {
						categories: 0
					},
					plotOptions: {  
						column: {
							dataLabels: {
								enabled: true
							}
						}
					},    
					series: [{ 
						name: 'Mandays',                               
						data: 0,                        
					},{ 
						name: 'Days',
						data: 0,                        
					}]
				});
							  
			  }else{

				for (var i = 0; i < data.length; i++)
				{
				  var obj = data[i];
				  employee_name[i] = obj.EMPLOYEE_NAME;
				  workduration[i] = parseInt(obj.WORK_DURATION);
				  projectduration[i] = obj.PROJECT_DURATION;
				}

				console.log(employee_name);
				
				Highcharts.chart('employeeChart', {
					chart: {
					  type: 'column'
					},
					title: {
						text: ''
					},
					yAxis: {
					enabled: true,
					title: {
						text: 'Days'
						}
					},
					xAxis: {
						categories: employee_name
					},
					plotOptions: {  
						column: {
							dataLabels: {
								enabled: true
							}
						}
					},    
					series: [{ 
						name: 'Mandays',                               
						data: projectduration,                        
					},{ 
						name: 'Days',
						data: workduration,                        
					}]
				});                  
			  }
			},
				complete: function(){
				 $('.ajax-loader').css("visibility", "hidden");
			   }
		});
	});
});
</script> -->

@endsection