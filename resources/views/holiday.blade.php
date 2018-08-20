@extends('layouts.master')

@section('content')

<div class="" role="tabpanel" data-example-id="togglable-tabs">
	<ul id="myTab" class="nav nav-tabs col-md-12 col-sm-4 col-xs-12" role="tablist">
		<li role="presentation" class="active">
			<a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Input Holiday</a>
		</li>
		<li role="presentation" class="">
			<a href="#tab_content2" id="mandays-tab" role="tab" data-toggle="tab" aria-expanded="true">View Holiday</a>
		</li>	    
	</ul>
	
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">	
			<div class="col-md-12 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Input Holiday</h2>
						<div class="clearfix"></div>        
					</div>
					<div class="x_content">
						<div class="form-horizontal form-label-left">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
							  <label class="control-label col-md-1 col-sm-3 col-xs-12">Holiday Date</label>
							  <div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" id="startdate">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-md-1 col-sm-3 col-xs-12">Information</label>
							  <div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" id="txtket">
							  </div>
							</div>
							
							<div class="form-group">
							  <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">     
								<button class="btn btn-success pull-right btn-input-holiday">Save</button>
							  </div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="home-tab">
			<div class="col-md-12 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>View Holiday</h2>
						<div class="clearfix"></div>        
					</div>
					<div class="x_content">
						<table class="table table-bordered table-responsive table-hover">
							<thead>
								<th><center>NO</center></th>
								<th><center>Date Holiday</center></th>
								<th>Information</th>
							</thead>
							<tbody>
								@php $no = 1; @endphp
								@foreach ($holidays as $value)
									@php 
										$date_holiday = strtotime($value->day); 
									@endphp
									<tr>
										<td><center>{{ $no ++ }}</center></td>
										<td><center>{{ date('d F Y',$date_holiday) }}</center></td>
										<td>{{ $value->keterangan }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function () {
	//Date Picker
	//var holidays = ["2017-08-17","2017-09-01","2017-09-21","2017-12-01","2017-12-25","2017-12-26"];
	
	var holidays = "";

	$.ajax({ 
		 type: "GET",   
		 url: '{{ URL::to('getHoliday') }}',         
		 dataType: 'json',
		 success : function(data)
		 {
			var holiday = [];            
			for (var i = 0; i < data.length; i++)
			{
			  var obj = data[i];
			  holiday[i] = obj.day;          
			}
						  
			holidays = holiday;         	

			$("#startdate").datepicker({

			//disable Weekend dan Holidays      
				beforeShowDay: function(date){

					var day = date.getDay();
					if(day == 0 || day == 6){

					  return [false];
							
					}else if(holidays != ""){

					  var datestring = jQuery.datepicker.formatDate('yy-mm-dd', date);
					  var x = holidays.indexOf(datestring) == -1 ;
					  return [x];

					}else{
						
					  return [true];
					}       
				},
				dateFormat : 'yy-mm-dd'
			});
		 }

	});    

	$('.btn-input-holiday').click(function(){
		var holiday = $("#startdate").val();
		var ket     = $("#txtket").val();
				
		if( holiday == "" || ket == "" ){
			$("#error1").html("Your Data is not complete!");
			$('#myModal1').modal("show");
		}else{

		   $.ajax({
				url : baseUrl +'/holiday/input',
				type: 'POST',
				data: {'holiday': holiday, 'ket' : ket},
				dataType: 'json',
				success:function(r){
					if(r.msg == 'Success Insert'){
					  $("#error2").html(r.msg);
					  $('#myModal2').modal("show");
					  setTimeout(function(){
						location.reload(); 
					  }, 1000); 
					}
				}
			});
		}
	});
});
</script>

@endsection