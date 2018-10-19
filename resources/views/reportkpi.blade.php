@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-4 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Reporting KPI</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label class="control-label col-md-1 col-sm-3 col-xs-12">Unit</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control unitname">
                      <option value="">Select Unit</option>
                      @foreach ($showUnit as $listunit)
                        <option value="{{ $listunit->UNIT_ID }}">{{ $listunit->UNIT }}</option>
                      @endforeach                    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1 col-sm-3 col-xs-12">Name</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="f_nama" class="form-control">
                      <option value="" disabled="true" selected="true">Choose Unit First</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1 col-sm-3 col-xs-12">Month</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select id="f_bulan" class="form-control">
                    <option value="" >Choose Month</option>
                    @foreach ($bulan as $listbulan)
                      <option value="{{ $listbulan->BULAN_ID }}">{{ $listbulan->BULAN }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-1 col-sm-3 col-xs-12">Year</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select id="f_tahun" class="form-control">
                    <option value="">Choose Year</option>
                     @foreach ($tahun as $listtahun)
                      <option value="{{ $listtahun->TAHUN_ID }}">{{ $listtahun->TAHUN }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
             
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">     
                  <button class="btn btn-success pull-right btn-search-report">Search</button>                  
                </div>
              </div> 
          </div>
       <div class="ln_solid"></div>
       <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                    <th>No</th>
                    <th>Key Performance Area</th>
                    <th colspan="2">Key Performance Indicator</th>    
                    <th>Value KPI</th>
                    <th>Target</th>
                    <th>Unit</th>
                    <th>Year and Realization</th>
                    <th>Score</th>
                    <th>Final Score</th>
                    <th>Note</th>
                  </tr>
              </thead>
 <tbody>
                  <tr>
                    <td>1</td>
                    <td>Attendance</td>
                    <td colspan="2">Attendance Employee</td>
                    <td>20</td>
                    <td>{{ $showTarget->absen_target}}%</td>
                    <td>%</td>
                    <td></td>
                    <td class="result-absen-skor"></td>
                    <td class="result-absen-skorakhir"></td>
                    <td class="result-absen-ket"></td>  
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Project</td>
                    <td colspan="2">Days Project</td>
                    <td>11</td>
                    <td>{{ $showTarget->days_target}}</td>
                    <td>hari</td>
                    <td></td>
                    <td class="result-daysproject-skor"></td>
                    <td class="result-daysproject-skorakhir"></td>
                    <td class="result-daysproject-ket"></td> 
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>PMIS</td>
                    <td colspan="2">PMIS</td>
                    <td>20</td>
                    <td>{{ $showTarget->pmis_target}}%</td>
                    <td>%</td>
                    <td></td>
                    <td class="result-pmis-skor"></td>
                    <td class="result-pmis-skorakhir"></td>
                    <td class="result-pmis-note"></td>
                  </tr>   
                  <tr>
				  
                    <td>4</td>                
                    <td></td>                
                    <td colspan="2">Human Resource Department</td>
                    <td>15</td>
                    <td>{{ $showTarget->hrd_target}}</td>
                    <td>skor</td>
                    <td></td>
                    <td class="result-hrd-skor"></td>
                    <td class="result-hrd-skorakhir"></td>
                    <td class="result-hrd-ket"></td>                       
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><center>Givent Point</center></td>       
                    <td colspan="2">Project Management Officer</td>
                    <td>16</td>
                    <td>{{ $showTarget->pmo_target}}</td>
                    <td>skor</td>
                    <td></td>
                    <td class="result-pmo-skor"></td>  
                    <td class="result-pmo-skorakhir"></td>
                    <td class="result-pmo-ket"></td>  
                  </tr>
                  <tr>
                    <td>6</td>
                    <td></td>
                    <td colspan="2">UNIT</td>                
                    <td>18</td>
                    <td>{{ $showTarget->unit_target}}</td>
                    <td>skor</td>
                    <td></td>
                    <td class="result-unit-skor"></td>  
                    <td class="result-unit-skorakhir"></td> 
                    <td class="result-unit-ket"></td> 
                  </tr>
                  <tr>                
                  </tr>
                  <tr>
                    <td colspan="4"><center>TOTAL VALUE</center></td>
                    <td>80</td>
                    <td></td>
                    <td></td>
                    <td colspan="2"><center>FINAL RESULT</center></td>
                    <td class="result-score-akhir"></td>
                    <td></td>
                  </tr>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

$('.unitname').change(function(){

      var id = $('.unitname').val();
      var op = "";

      $.ajax({
            
          type  :'get',
          url   :'{{URL::to('getEmployeeFromUnitreport')}}',
          data  : {'id':id},
          beforeSend: function(){
            $('.ajax-loader').css("visibility", "visible");
          },
          success:function(data){
            
            $('#f_nama option').remove();

            if(data.length == ""){
              op+='<option value="" >Empty</option>';
            }else{

              op+='<option value="" >Choose Employee</option>';
              for(var i = 0 ; i < data.length ; i++){
                op+='<option value="'+data[i].EMPLOYEE_ID+'">'+data[i].EMPLOYEE_NAME+'</option>';
              }
            }
                               
            $('#f_nama').append(op);
                      
          },
          complete: function(){
            $('.ajax-loader').css("visibility", "hidden");
          }
      });
});


$('.btn-search-report').click(function(){
  
    var nama = $('#f_nama').val();
    var bulan = $('#f_bulan').val();
    var tahun = $('#f_tahun').val();     
                    
    if( nama == "" || tahun == "" || bulan == ""){

        $("#error1").html("Your Data is not complete!");
        $('#myModal1').modal("show");

    }else{

        $.ajax({
            url : baseUrl +'/reportkpi/search',
            type: 'POST',
            data: {'nama': nama, 'tahun' : tahun, 'bulan' : bulan},
            dataType: 'json',
            beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
            },
            success:function(r){
                
              var pmis_skor ='';
              var pmis_skorakhir ='';
              var pmis_note ='';
              
              var absen_skor = '';
              var absen_skorakhir = '';
              var absen_ket = '';

              var daysproject_skor = '';
              var daysproject_skorakhir = '';
              var daysproject_ket = '';
              
              var hrd_skor = '';
              var hrd_skorakhir = '';
              var hrd_ket = '';

              var pmo_skor = '';
              var pmo_skorakhir = '';
              var pmo_ket = '';

              var unit_skor = '';
              var unit_skorakhir = '';
              var unit_ket = '';

              var final_score = '';
              
              $('.result-pmis-skor span').remove();
              $('.result-pmis-skorakhir span').remove();
              $('.result-pmis-note span').remove()
              
              $('.result-absen-skor span').remove();
              $('.result-absen-skorakhir span').remove();
              $('.result-absen-ket span').remove()

              $('.result-daysproject-skor span').remove();
              $('.result-daysproject-skorakhir span').remove();
              $('.result-daysproject-ket span').remove()

              $('.result-pmis-skor span').remove();
                  
              $('.result-hrd-skor span').remove();
              $('.result-hrd-skorakhir span').remove();
              $('.result-hrd-ket span').remove()
              
              $('.result-pmo-skor span').remove();
              $('.result-pmo-skorakhir span').remove();
              $('.result-pmo-ket span').remove();
              
              $('.result-unit-skor span').remove();
              $('.result-unit-skorakhir span').remove();
              $('.result-unit-ket span').remove();

              $('.result-score-akhir span').remove();


              $.each(r.content, function(k, v){
                
                  pmis_skor += '<span>'+v.PMIS_score+'</span>';
                  pmis_skorakhir += '<span>'+v.PMIS_final_score+'</span>';
                  pmis_note += '<span>'+v.NOTE_PMIS+'</span>';
                  
                  absen_skor += '<span>'+v.score_absensi+'</span>';
                  absen_skorakhir += '<span>'+v.final_score_absensi+'</span>';
                  absen_ket += '<span>'+v.note_absensi+'</span>';

                  daysproject_ket += '<span>'+v.note_days_project+'</span>';

                  hrd_skor += '<span>'+v.HASIL_HRD+'</span>';
                  hrd_skorakhir += '<span>'+v.SKOR_HRD+'</span>';
                  hrd_ket += '<span>'+v.KRITIK_HRD+'</span>';

                  pmo_skor += '<span>'+v.HASIL_PMO+'</span>';
                  pmo_skorakhir += '<span>'+v.SKOR_PMO+'</span>';
                  pmo_ket +='<span>'+v.KRITIK_PMO+'</span>';

                  unit_skor += '<span>'+v.HASIL_UNIT+'</span>';
                  unit_skorakhir += '<span>'+v.SKOR_UNIT+'</span>';
                  unit_ket += '<span>'+v.KRITIK_UNIT+'</span>';

                  final_score += '<span>'+v.FINAL_SCORE+'</span>';

              });

              $.each(r.contentdays, function(k, v){

                  daysproject_skor += '<span>'+v.final+'</span>';
                  daysproject_skorakhir += '<span>'+v.fixdays+'</span>';       

              });
              

              if(r.content == "" || r.contentdays == ""){
                  
                  $('.result-pmis-skor').append("<span>0</span>");
                  $('.result-pmis-skorakhir').append("<span>0</span>");
                  $('.result-pmis-note').append("<span>-</span>");
                  
                  $('.result-absen-skor').append("<span>0</span>");
                  $('.result-absen-skorakhir').append("<span>0</span>");
                  $('.result-absen-ket').append("<span>-</span>");
                   
                  $('.result-daysproject-skor').append("<span>0</span>");
                  $('.result-daysproject-skorakhir').append("<span>0</span>");
                  $('.result-daysproject-ket').append("<span>-</span>");

                  $('.result-hrd-skor').append("<span>0</span>");
                  $('.result-hrd-skorakhir').append("<span>0</span>");
                  $('.result-hrd-ket').append("<span>-</span>");
                  
                  $('.result-pmo-skor').append("<span>0</span>");
                  $('.result-pmo-skorakhir').append("<span>0</span>");
                  $('.result-pmo-ket').append("<span>-</span>");
                  
                  $('.result-unit-skor').append("<span>0</span>");
                  $('.result-unit-skorakhir').append("<span>0</span>");
                  $('.result-unit-ket').append("<span>-</span>");  

                  $('.result-score-akhir').append("<span>0</span>");
                  
              }else{
                  
                  $('.result-pmis-skor').append(pmis_skor);
                  $('.result-pmis-skorakhir').append(pmis_skorakhir);
                  $('.result-pmis-note').append(pmis_note);
                  
                  $('.result-absen-skor').append(absen_skor);
                  $('.result-absen-skorakhir').append(absen_skorakhir);
                  $('.result-absen-ket').append(absen_ket);

                  $('.result-daysproject-skor').append(daysproject_skor);
                  $('.result-daysproject-skorakhir').append(daysproject_skorakhir);
                  $('.result-daysproject-ket').append(daysproject_ket);
 
                  $('.result-hrd-skor').append(hrd_skor);
                  $('.result-hrd-skorakhir').append(hrd_skorakhir);
                  $('.result-hrd-ket').append(hrd_ket);
                  
                  $('.result-pmo-skor').append(pmo_skor);
                  $('.result-pmo-skorakhir').append(pmo_skorakhir);
                  $('.result-pmo-ket').append(pmo_ket);
                  
                  $('.result-unit-skor').append(unit_skor);
                  $('.result-unit-skorakhir').append(unit_skorakhir);
                  $('.result-unit-ket').append(unit_ket);  

                  var resultKPI = parseInt(final_score.split('<span>').join('').split('</span>').join('')) + parseInt(daysproject_skorakhir.split('<span>').join('').split('</span>').join('')) + parseInt(pmis_skorakhir.split('<span>').join('').split('</span>').join(''));
                  
                  $('.result-score-akhir').append("<span>"+resultKPI+"</span>");
              }
            },
            complete: function(){
             $('.ajax-loader').css("visibility", "hidden");
           } 
        });
    }
});

</script>
@endsection