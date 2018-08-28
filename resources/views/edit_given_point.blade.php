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
</div>

<script type="text/javascript">
$(document).ready(function(){

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