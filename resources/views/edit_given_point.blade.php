@extends('layouts.master')

@section('content')

<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs col-md-12 col-sm-4 col-xs-12" role="tablist">
      <li role="presentation" class="active">
        <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">HRD</a>
      </li>
        <li role="presentation" class="">
            <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">PMO</a>
        </li>
        <li role="presentation" class="">
            <a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">UNIT</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
		  <br>
			<div class="col-md-12 col-sm-4 col-xs-12">
				<div class="x_panel">
					<h3>Given Point HRD</h3>
					<div class="clearfix"></div>
					<div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class ="table-head" style="text-align: center;">No</th>
									<th class ="table-head" style="text-align: center;">Area Kinerja Utama</th>
									<th class ="table-head" style="text-align: center;">KPI</th>
									<th class ="table-head" style="text-align: center;">Status</th>
									<th class ="table-head" style="text-align: center;">Action</th>
									
								</tr>
							</thead>
							<tbody>
								@php
								$no = 1;
								@endphp
								@foreach ($areaHRD as $list)         
								<tr style="text-align: center;">
									<td>@php echo $no++ @endphp</td>
									<td>{{ $list->KINERJA_NAME }}</td>
									<td>{{ $list->KPI_NAME }}</td>                        
									<td style="text-align: center;">
									@php
									  if($list->STATUS == 'aktif'){
									@endphp
										<label><input type="checkbox" class="radio-cek-hrd" list-id="{{ $list->LIST_ID }}" checked="checked"></label>
									@php
									  }elseif($list->STATUS == 'none'){ 
									@endphp
										<label><input type="checkbox" class="radio-cek-hrd" list-id="{{ $list->LIST_ID }}"></label>
									@php
									  }
									@endphp
									</td>
									<td>
										<center>
										  <button  type="button" class="btn Updategivenpoint btn-primary button_givenpoint_edit" data-toggle="modal"  value="{{$list->LIST_ID}}*{{$list->ROLE_ID}}*{{$list->KINERJA_ID}}*{{ $list->KPI_NAME }}">Update{{$list->LIST_ID}}</button>';
										  <button  type="button" class="btn Deletegivenpoint btn-primary button_delete_nilai" data-toggle="modal" value="'+ v.PENILAIAN_ID +'*'+ v.KINERJA_NAME +'">Delete{{$list->LIST_ID}}</button>';
										</center>
									</td>
								</tr>
							  @endforeach
							 </tbody>
						  </table>
						  <div class="form-group">
							  <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">     
								<button id="btnsavehrd" class="btn btn-success pull-right">Save</button>
							  </div>
						  </div>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
			<div class="col-md-12 col-sm-4 col-xs-12">
				<div class="x_panel">
					<h3>Given Point PMO</h3>
					<div class="clearfix"></div>
					<div>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class ="table-head" style="text-align: center;">No</th>
									<th class ="table-head" style="text-align: center;">Area Kinerja Utama</th>
									<th class ="table-head" style="text-align: center;">KPI</th>
									<th class ="table-head" style="text-align: center;">Status</th>
									<th class ="table-head" style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
							@php
							$no = 1;
							@endphp
							@foreach ($areaPMO as $list)         
								<tr style="text-align: center;">
									<td>@php echo $no++ @endphp</td>
									<td>{{ $list->KINERJA_NAME }}</td>
									<td>{{ $list->KPI_NAME }}</td>
									<input type="hidden" value="{{ $list->LIST_ID }}">
									<td style="text-align: center;">
									@php
									if($list->STATUS == 'aktif'){
										@endphp
										<label><input type="checkbox" class="radio-cek-pmo" list-id="{{ $list->LIST_ID }}" checked="checked"></label>
									@php
									  }elseif($list->STATUS == 'none'){ 
									@endphp
										<label><input type="checkbox" class="radio-cek-pmo" list-id="{{ $list->LIST_ID }}"></label>
									@php
									  }
									@endphp
									</td>
									<td><center>
										<button  type="button" class="btn Updategivenpoint btn-primary button_pmo_edit" data-toggle="modal"  value="'+ v.HASIL_KINERJA_ID +'*' + v.KINERJA_NAME + '*' + v.BOBOT + '">Update</button>';
										<button  type="button" class="btn Deletegivenpoint btn-primary button_delete_nilai" data-toggle="modal" value="'+ v.PENILAIAN_ID +'*'+ v.KINERJA_NAME +'">Delete</button>';
									  </center>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12 col-md-9">     
							  <button id="btnsavepmo" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
			<div class="col-md-12 col-sm-4 col-xs-12">
				  <div class="x_panel">
					  <h3>Given Point UNIT</h3>
					  <div class="clearfix"></div>

					<div>
						<table class="table table-bordered">
							<thead>
								 <tr>
									<th class ="table-head" style="text-align: center;">No</th>
									<th class ="table-head" style="text-align: center;">Area Kinerja Utama</th>
									<th class ="table-head" style="text-align: center;">KPI</th>
									<th class ="table-head" style="text-align: center;">Status</th>
									<th class ="table-head" style="text-align: center;">Action</th>
								 </tr>
							</thead>
							<tbody>
								@php
								$no = 1;
								@endphp
								@foreach ($areaUNIT as $list)         
								  <tr style="text-align: center;">
									<td>@php echo $no++ @endphp</td>
									<td>{{ $list->KINERJA_NAME }}</td>
									<td>{{ $list->KPI_NAME }}</td>
									<input type="hidden" value="{{ $list->LIST_ID }}">
									<td style="text-align: center;">
									@php
									  if($list->STATUS == 'aktif'){
									@endphp
										<label><input type="checkbox" class="radio-cek-unit" list-id="{{ $list->LIST_ID }}" checked="checked"></label>
									@php
									  }elseif($list->STATUS == 'none'){ 
									@endphp
										<label><input type="checkbox" class="radio-cek-unit" list-id="{{ $list->LIST_ID }}"></label>
									@php
									  }
									@endphp
									</td>
									<td><center>
									  <button  type="button" class="btn Updategivenpoint btn-primary button_givenpoint_edit" data-toggle="modal"  value="'+ v.HASIL_KINERJA_ID +'*' + v.KINERJA_NAME + '*' + v.BOBOT + '">Update</button>';
									  <button  type="button" class="btn Deletegivenpoint btn-primary button_delete_nilai" data-toggle="modal" value="'+ v.PENILAIAN_ID +'*'+ v.KINERJA_NAME +'">Delete</button>';
									  </center>
									</td>
								 </tr>
							  @endforeach
						   </tbody>
						</table>

						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12 col-md-9">     
							  <button id="btnsaveunit" class="btn btn-success pull-right">Save</button>
							</div>
						</div>
					</div>
				  </div>
			</div>
		</div>
	</div>
	<div class="modal fade bd-example-modal-lg" id="modal_givenpoint_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Given Point</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="x_panel">
						<div class="x_content">
							<div class="form-horizontal form-label-left">
								<div class="form-group">
									<label class="control-label col-md-1 col-sm-3 col-xs-12">Area Kinerja Utama</label>
									<div class="form-group">
										<div class="col-md-9 col-sm-9 col-xs-12">
											<select class="form-control id_kinerja" id="id_kinerja" selected>
												<option value="">Select Area Kinerja Utama</option>
												@foreach ($showAreaKinerja as $listareakinerja)
													<option value="{{ $listareakinerja->KINERJA_ID }}">{{ $listareakinerja->KINERJA_NAME }}</option>
												@endforeach                    
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="form-group">
											<label class="control-label col-md-1 col-sm-3 col-xs-12">KPI</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
											  <input type="hidden" class="form-control list_id" id="kpi-pmo">
											  <input type="hidden" class="form-control role_id" id="kpi-pmo">
											  <input type="text" class="form-control kpi-pmo" id="kpi-pmo">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
					<button class="btn btn-success pull-right btn-update-givenpoint">Update</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
      $.ajaxSetup({
          headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
		$(this).on('click', '.Updategivenpoint', function(e){
			  var splt = $(this).val().split('*');
			  if (splt[0]==null){
						alert('Plese Insert Value');
			  }else{
				$('#modal_givenpoint_edit').modal('show');
			}
		});
		$(this).on('click', '.button_givenpoint_edit', (function(e){	
			//alert($(this).attr('data-index'));
			var splt = $(this).val().split('*');	
			$("#list_id").val(splt[0]);
			$("#role_id").val(splt[1]);
			$("#id_kinerja").val(splt[2]);
			$("#kpi-pmo").val(splt[3]);
		}));
		
		$(this).on('click', '.DeletePeninilai', function(e){
			  var splt = $(this).val().split('*');
			  console.log(splt);
			  if (splt[0]==null||splt[0]=='-'){
				alert('Plese Insert Value');
			  }else{
				$('#DeletePeninilaian').modal('show');
			}
		});
		$(this).on('click', '.button_delete_nilai', (function(e){	
			//alert($(this).attr('data-index'));
			var splt = $(this).val().split('*');
			$("#tb_penilaian_id").val(splt[0]);
		
		}));
		
		$('.btn-update-givenpoint').click(function(){
			    				
			var String_list_id  	= $("#list_id").val();
			var String_role_id   	= $("#role_id").val();
			var String_id_kinerja  	= $("#id_kinerja").val();
			var String_kpi-pmo	 	= $(".kpi-pmo").val();
			console.log(String_pmo_nilai);
			var val = {'list_id': String_list_id, 'role_id' : String_role_id, 'id_kinerja':String_id_kinerja,'kpi-pmo':String_kpi-pmo};		
			  $.ajax({
              url : baseUrl +'/givenpoin/update',
              type: 'POST',
              data: val,      
              dataType: 'json',
              beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
              },
              success:function(r){
                $('#modal_pmo_edit').modal('hide');
                setTimeout(function(){// wait for 5 secs(2)
                    location.reload(); // then reload the page.(3)
                  }, 1000);
				   $("#error2").html(r.msg);
                  $('#myModal2').modal("show");              
              },
                complete: function(){
                 $('.ajax-loader').css("visibility", "hidden");
               }
          });
		});
		
		$('.btn-delete-nilai_unit').click(function(){
			    				
			var String_penilaian_id   = $("#tb_penilaian_id").val();
			var val = {'nilai_id': String_penilaian_id};		
			  $.ajax({
              url : baseUrl +'/penilaian/del',
              type: 'POST',
              data: val,      
              dataType: 'json',
              beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
              },
              success:function(r){
                $('#DeletePeninilaian').modal('hide');
                setTimeout(function(){// wait for 5 secs(2)
                    location.reload(); // then reload the page.(3)
                  }, 1000);
				   $("#error2").html(r.msg);
                  $('#myModal2').modal("show");              
              },
                complete: function(){
                 $('.ajax-loader').css("visibility", "hidden");
               }
          });
		});
  $('#btnsavehrd').click(function(){
    
    var lib_update_hrd = [];

    $(".radio-cek-hrd").each(function(){
   
       if($(this).is(':checked')){

          var status = "aktif";
          var list   = $(this).attr("list-id");

       }else{

          var status = "none";
          var list   = $(this).attr("list-id");
       }

        lib_update_hrd.push({
           list:list,
           status:status
        });

    });
    
    var data = {
      'list_final' : lib_update_hrd
    };
    
    $.ajax({
        url : baseUrl +'/editGPHRD/update',
        type: 'POST',
        data: data,      
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
    });
  });

  $('#btnsavepmo').click(function(){
    
    var lib_update_pmo = [];

    $(".radio-cek-pmo").each(function(){
   
       if($(this).is(':checked')){

          var status = "aktif";
          var list   = $(this).attr("list-id");

       }else{

          var status = "none";
          var list   = $(this).attr("list-id");
       }

        lib_update_pmo.push({
           list:list,
           status:status
        });

    });
    
    var data = {
      'list_final' : lib_update_pmo
    };
    
    $.ajax({
        url : baseUrl +'/editGPPMO/update',
        type: 'POST',
        data: data,      
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
    });
  });

  $('#btnsaveunit').click(function(){
    
    var lib_update_unit = [];

    $(".radio-cek-unit").each(function(){
   
       if($(this).is(':checked')){

          var status = "aktif";
          var list   = $(this).attr("list-id");

       }else{

          var status = "none";
          var list   = $(this).attr("list-id");
       }

        lib_update_unit.push({
           list:list,
           status:status
        });

    });
    
    var data = {
      'list_final' : lib_update_unit
    };
    
    $.ajax({
        url : baseUrl +'/editGPUNIT/update',
        type: 'POST',
        data: data,      
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
    });
  });

});
</script>
@endsection