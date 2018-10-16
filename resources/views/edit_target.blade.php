@extends('layouts.master')
@section('content')

<div class="col-md-12 col-sm-4 col-xs-12">
    <div class="x_panel">      
        <div class="x_title">
			<h3>Edit Target Value</h3>
            <div class="clearfix"></div>  
        
		</div>
		<div class="x_content">

			<table class="table table-bordered">
        		<thead>
          			<tr>
            			<th class ="table-head" style="text-align: center">Target Absen(%)</th>
            			<th class ="table-head" style="text-align: center">Target Days Project</th>
            			<th class ="table-head" style="text-align: center">Target PMIS(%)</th>
            			<th class ="table-head" style="text-align: center">Target PMO</th>
						<th class ="table-head" style="text-align: center">Target HRD</th>
						<th class ="table-head" style="text-align: center">Target Unit</th>
          			</tr>
                </thead>
	            <tbody class="result-prjct">
				<tr>	
				@foreach ($showTarget as $list_target)
            		<td style="text-align:center"><input type="text"  class="form-control absen" value="{{ $list_target->absen_target}}"></td>
            		<td style="text-align:center"><input type="text"  class="form-control daysproject" value="{{ $list_target->days_target}}"></td>
            		<td style="text-align:center"><input type="text"  class="form-control PMIS" value="{{ $list_target->pmis_target}}"></td>
            		<td style="text-align:center"><input type="text"  class="form-control PMO" value="{{ $list_target->pmo_target}}"></td>
            		<td style="text-align:center"><input type="text"  class="form-control HRD" value="{{ $list_target->hrd_target}}"></td>
            		<td style="text-align:center"><input type="text"  class="form-control Unit" value="{{ $list_target->unit_target}}"></td>
					                        	
				@endforeach 

            	</tr>
				</tbody>
	        </table>  			
    		<div class="form-group">
          		<div class="col-md-10 col-sm-10 col-xs-12 col-md-10">
            		<button id="btn-update-prjct" class="btn btn-success pull-right">Update</button>
        		</div>
        	</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    // CSRF Setup
    $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


						
	$('#btn-update-prjct').click(function(){
		var pmo   = $('.PMO').val();
		var hrd 	   = $('.HRD').val(); 
		var unit      = $('.Unit').val();
		var pmis      = $('.PMIS').val();
		var absen     = $('.absen').val();
		var daysproject   = $('.daysproject').val();
	
			$.ajax({
				url : baseUrl +'/update/target',
				type: 'POST',
				data: {'pmo': pmo, 'hrd': hrd, 'unit' : unit, 'pmis':pmis, 'absen':absen, 'daysproject':daysproject},
				dataType: 'json',
				success:function(r){
					if(r.msg == 'Success Update'){                  
					  $("#error2").html(r.msg);
					  $('#myModal2').modal("show");
					}
					 location.reload(true);
					}
				});
			});
		
});
</script>
@endsection