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
		<li role="presentation" class="">
			<a href="#tab_content_edit_holiday" id="edit_holiday_id" role="tab" data-toggle="tab" aria-expanded="true">Edit Holiday</a>
		</li>
		<li role="presentation" class="">
			<a href="#tab_content_delete_holiday" id="edit_holiday_id" role="tab" data-toggle="tab" aria-expanded="true">Delete Holiday</a>
		</li>		    
	</ul>
	<div class="modal fade" id="modal_holiday_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Holiday</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="modal_holiday_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Delete Holiday</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
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
								<th class="table-head" ><center>NO</center></th>
								<th class="table-head" ><center>Date Holiday</center></th>
								<th class="table-head" >Information</th>
								<th class="table-head"><center>Action</center>
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
										<td><center>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_holiday_edit">
												Update
											</button>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_holiday_delete">
												Delete
											</button>
												<!-- <button style="">Update</button>
												<button color="red">Delete</button> -->
											</center></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade " id="tab_content_edit_holiday" aria-labelledby="home-tab">	
			<div class="col-md-12 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Edit Holiday</h2>
						<div class="clearfix"></div>        
					</div>
					<div class="x_content">
						<div class="form-horizontal form-label-left">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<label class="control-label col-md-1 col-sm-3 col-xs-12">Choose Holiday</label>
							<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select class="form-control holiday_ddl">
										<option value="">Select Unit</option>
										@foreach ($holidays as $listDate)
											<option value="{{ $listDate->day_id }}">{{ $listDate->day.' '.$listDate->keterangan }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
							  <label class="control-label col-md-1 col-sm-3 col-xs-12">Holiday Date</label>
							  <div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" id="tb_holidays_date">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-md-1 col-sm-3 col-xs-12">Information</label>
							  <div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" id="tb_holidays_ket">
							  </div>
							</div>
							
							<div class="form-group">
							  <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">     
								<button class="btn btn-success pull-right btn-update-holiday">Update</button>
							  </div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade " id="tab_content_delete_holiday" aria-labelledby="home-tab">	
			<div class="col-md-12 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Delete Holiday</h2>
						<div class="clearfix"></div>        
					</div>
					<div class="x_content">
						<div class="form-horizontal form-label-left">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<label class="control-label col-md-1 col-sm-3 col-xs-12">Choose Holiday</label>
							<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select class="form-control holiday_ddl_del">
										<option value="">Select Unit</option>
										@foreach ($holidays as $listDate)
											<option value="{{ $listDate->day_id }}">{{ $listDate->day.' '.$listDate->keterangan }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
							  <label class="control-label col-md-1 col-sm-3 col-xs-12">Holiday Date</label>
							  <div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" id="tb_holidays_date_del" disabled="true">
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="control-label col-md-1 col-sm-3 col-xs-12">Information</label>
							  <div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" id="tb_holidays_ket_del" disabled="true">
							  </div>
							</div>
							
							<div class="form-group">
							  <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">     
								<button class="btn btn-success pull-right btn-delete-holiday">Delete</button>
							  </div>
							</div> 
						</div>
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
		$.ajaxSetup({
		    headers : {
		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		  });

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
				$("#tb_holidays_date").datepicker({

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
				var val = {'holiday': holiday, 'ket' : ket};
				httpSend(baseUrl +'/holiday/input', val).done(r => {
					if(r.msg){
						 $("#error2").html(r.msg);
							$('#myModal2').modal("show");
							setTimeout(function(){
								location.reload(); 
							  }, 1000); 
					}
				});
				// old method input 
			   /*$.ajax({
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
				});*/
			}
		});
		
		$('.holiday_ddl').change(function(){
			var String_holiday = $(".holiday_ddl option:Selected").html();
			var String_holiday_date = String_holiday.slice(0,10);
			var String_holiday_ket = String_holiday.slice(11,String_holiday.length);
			$("#tb_holidays_date").val(String_holiday_date);
			$("#tb_holidays_ket").val(String_holiday_ket);
		});
		$('.holiday_ddl_del').change(function(){
			var String_holiday = $(".holiday_ddl_del option:Selected").html();
			var String_holiday_date = String_holiday.slice(0,10);
			var String_holiday_ket = String_holiday.slice(11,String_holiday.length);
			$("#tb_holidays_date_del").val(String_holiday_date);
			$("#tb_holidays_ket_del").val(String_holiday_ket);
		});

		$('.btn-update-holiday').click(function(){
			    				
			var String_holiday_id   = $(".holiday_ddl option:Selected").val();
			var String_holiday = $(".holiday_ddl option:Selected").html();
			var String_holiday_date = $("#tb_holidays_date").val();
			var String_holiday_ket = $("#tb_holidays_ket").val();
			var val = {'holiday_id': String_holiday_id, 'holiday_date' : String_holiday_date, 'holiday_ket':String_holiday_ket};
			httpSend(baseUrl +'/holiday/update', val).done(r => {
				if(r.msg){
					 $("#error2").html(r.msg);
						$('#myModal2').modal("show");
						setTimeout(function(){
							location.reload(); 
						  }, 1000); 
				}
			});
			//old method of update holiday
			//alert(String_holiday_id);
			/*$.ajax({
		        url : baseUrl +'/holiday/update',
		        type: 'POST',
		        data: {'holiday_id': String_holiday_id, 'holiday_date' : String_holiday_date, 'holiday_ket':String_holiday_ket},
		        dataType: 'json',
		        success:function(r){
		            if(r.msg == 'Success Update'){
		              $("#error2").html(r.msg);
						  $('#myModal2').modal("show");
						  setTimeout(function(){
							location.reload(); 
						  }, 1000); 
		            }
		        }
	    	});*/
		});
		$('.btn-delete-holiday').click(function(){
							
			var String_holiday_id   = $(".holiday_ddl_del option:Selected").val();
			//alert(String_holiday_id);
			var val = { 'holiday_id': String_holiday_id };
			httpSend(baseUrl +'/holiday/delete', val).done(r => {
				if(r.msg){
					 $("#error2").html(r.msg);
						$('#myModal2').modal("show");
						setTimeout(function(){
							location.reload(); 
						  }, 1000); 
				}
			});
			// old method of delete holiday
			/*$.ajax({
		        url : baseUrl +'/holiday/delete',
		        type: 'POST',
		        data: {'holiday_id': String_holiday_id},
		        dataType: 'json',
		        success:function(r){
		            if(r.msg == 'Success Delete'){
		              $("#error2").html(r.msg);
						$('#myModal2').modal("show");
						setTimeout(function(){
							location.reload(); 
						  }, 1000); 
		            }
		        }
	    	});*/

		});

});
</script>

@endsection