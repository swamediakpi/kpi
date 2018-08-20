@extends('layouts.master')

@section('content')

<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs col-md-12 col-sm-4 col-xs-12" role="tablist">
        <li role="presentation" class="active">
            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">View Employee</a>
        </li>
      @if (Auth::user()->ROLE_ID == '2' || Auth::user()->ROLE_ID == '5' || Auth::user()->ROLE_ID == '8')
        <li role="presentation" class="">
            <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Input</a>
        </li>
      @endif
    </ul>
    <div id="myTabContent" class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
      <br>       
    <div class="col-md-12 col-sm-4 col-xs-12">
    <div class="x_panel">
    <div class="x_title">
      <h3>PMO</h3>
      <div class="clearfix"></div>
      <div class="form-horizontal form-label-left">
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
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Employee Name</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="f_nama" class="form-control">
                <option value="" disabled="true" selected="true">Choose Unit First</option>
              </select>
            </div>
          </div>
          @foreach ($rolepmo as $ele)
            <input id="f_role_id" type="hidden" value="{{ $ele->ROLE_ID }}">
          @endforeach
          <div class="form-group">
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Month</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select class="form-control" id="f_bulan">
                <option value="">Choose Month</option>
                @foreach ($bulan as $listbulan)
                  <option value="{{ $listbulan->BULAN_ID }}">{{ $listbulan->BULAN }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-1 col-sm-3 col-xs-12">Year</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select class="form-control" id="f_tahun">
                <option value="">Choose Year</option>
                @foreach ($tahun as $listtahun)
                  <option value="{{ $listtahun->TAHUN_ID }}">{{ $listtahun->TAHUN }}</option>
                @endforeach
              </select>
            </div>
          </div>         
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">
              <button class="btn btn-success pull-right btn-search btn-search-pmo">Search</button>
            </div>
          </div>
      </div>

    </div>
    <div class="x_content">
          <table class="table table-bordered">
          <thead>
        <tr>
          <th style="text-align: center">No</th>
          <th style="text-align: center">Area Kinerja Utama</th>
          <th style="text-align: center">KPI</th>
          <th style="text-align: center">BOBOT</th>
          <th style="text-align: center">Pencapaian</th>
        </tr>
        </thead>
        <tbody class="result-search-pmo">
        
        </tbody>
      </table>

      <table class="table table-bordered">
          <thead>
             <tr>                           
               <th style="text-align: center;">Alfabet</th>
               <th style="text-align: center;">Skor</th>
             </tr>
         </thead>
         <tbody>
             <tr>                          
                <td style="text-align: center;">A</td>
                <td style="text-align: center;">4</td>
             </tr>
             <tr>                          
                <td style="text-align: center;">B</td>
                <td style="text-align: center;">3</td>
             </tr>
             <tr>                          
                <td style="text-align: center;">C</td>
                <td style="text-align: center;">2</td>
             </tr>
             <tr>                          
                <td style="text-align: center;">D</td>
                <td style="text-align: center;">1</td>
             </tr>
             <tr>                          
                <td style="text-align: center;">E</td>
                <td style="text-align: center;">0</td>
             </tr>
         </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end recent activity -->
    </div>
    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

      <!-- start user projects -->
      <div class="col-md-12 col-sm-4 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>PMO</h2>
      <div class="clearfix"></div>
    <div class="form-horizontal form-label-left">

    <div class="form-group">
        <label class="control-label col-md-1 col-sm-3 col-xs-12">Unit</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control unitname1">
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
          <select id="idemp" class="form-control">
            <option value="">Choose Unit First</option>          
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-1 col-sm-3 col-xs-12">Month</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select id="idbln" class="form-control">
            <option value="">Choose Month</option>
            @foreach ($bulan as $listbulan)
              <option value="{{ $listbulan->BULAN_ID }}">{{ $listbulan->BULAN }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-1 col-sm-3 col-xs-12">Year</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <select id="idthn" class="form-control">
            <option value="">Choose Year</option>
            @foreach ($tahun as $listtahun)
              <option value="{{ $listtahun->TAHUN_ID }}">{{ $listtahun->TAHUN }}</option>
            @endforeach
          </select>
        </div>
      </div>
     
      <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">
          <button class="btn btn-success pull-right" id="openContainer">Open</button>
        </div>
      </div>
  </div>
</div>

<div class="container" id="contt">
  <h3>Form Penilaian Karyawan</h3>
  <table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>No</th>
        <th>Area Kinerja Utama</th>
        <th>Kpi</th>
        <th>Bobot</th>
        <th>Pencapaian</th>
      </tr>
    </thead>
    <tbody>
    <input type="hidden" id="countlist" value={{ $countlist }}>
      @php
        $no = 1;
      @endphp
      @foreach ($listInsert as $list)      
      <tr> 
        <td>@php echo $no++ @endphp</td>
        <input class="list_id{{ $no }}" type="hidden" value="{{ $list->LIST_ID }}">
        <td>{{ $list->KINERJA_NAME }}</td>
        <td>{{ $list->KPI_NAME }}</td>
        <td>{{ $list->BOBOT_GP }}</td>
        <td>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <select class="form-control bobot_list{{ $no }}">
            <option value="">Choose Score</option>
            <option value=4>A</option>
            <option value=3>B</option>
            <option value=2>C</option>
            <option value=1>D</option>
            <option value=0>E</option>
          </select>
        </div>
        </td>
      </tr>
      @endforeach
      @foreach ($rolepmo as $ele)
            <input id="role_id_inst" type="hidden" value="{{ $ele->ROLE_ID }}">
      @endforeach
    </tbody>
  </table>

  <table class="table table-bordered">
        <thead>
           <tr>                           
             <th style="text-align: center;">Alfabet</th>
             <th style="text-align: center;">Skor</th>
           </tr>
       </thead>
       <tbody>
           <tr>                          
              <td style="text-align: center;">A</td>
              <td style="text-align: center;">4</td>
           </tr>
           <tr>                          
              <td style="text-align: center;">B</td>
              <td style="text-align: center;">3</td>
           </tr>
           <tr>                          
              <td style="text-align: center;">C</td>
              <td style="text-align: center;">2</td>
           </tr>
           <tr>                          
              <td style="text-align: center;">D</td>
              <td style="text-align: center;">1</td>
           </tr>
           <tr>                          
              <td style="text-align: center;">E</td>
              <td style="text-align: center;">0</td>
           </tr>
       </tbody>
    </table>

  <h3>Kritik dan Saran</h3>

  <div class="form-group">      
      <textarea class="form-control" rows="5" id="comment"></textarea>
  </div>
    
  <div class="form-group">
    <div class="col-md-9 col-sm-9 col-xs-12 col-md-9">
      <button id="btn-input-pmo" class="btn btn-success pull-right">Submit</button>
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

    // CSRF Setup
    $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.unitname').change(function(){

        var id = $('.unitname').val();
        var op = "";

        $.ajax({
              
            type  :'get',
            url   :'{{URL::to('getEmployeeFromUnitpmo')}}',
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

    $('.unitname1').change(function(){

        var id = $('.unitname1').val();
        var op = "";

        $.ajax({
              
            type  :'get',
            url   :'{{URL::to('getEmployeeFromUnit1pmo')}}',
            data  : {'id':id},
            beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
            },
            success:function(data){
              
              $('#idemp option').remove();

              if(data.length == ""){
                op+='<option value="" >Empty</option>';
              }else{

                op+='<option value="" >Choose Employee</option>';
                for(var i = 0 ; i < data.length ; i++){
                  op+='<option value="'+data[i].EMPLOYEE_ID+'">'+data[i].EMPLOYEE_NAME+'</option>';
                }
              }
                                 
              $('#idemp').append(op);
                        
            },
            complete: function(){
             $('.ajax-loader').css("visibility", "hidden");
           }
            
        });
    });

    function count_total(angka){
      var nilai_awal = 0;
      var nilai_sementara = nilai_awal + angka;
      var nilai_awal = nilai_sementara;

      if(nilai_sementara > 16){
         nilai_sementara = 16
         return nilai_sementara;
      }

      return nilai_sementara;
    }

    $(this).on('click', '.btn-search-pmo',function(e){
        var nama = $('#f_nama').val();
        var tahun = $('#f_tahun').val();
        var bulan = $('#f_bulan').val();
        var role = $('#f_role_id').val();

        if( nama == "" || tahun == "" || bulan == ""){
            $("#error1").html("Your Data is not complete!");
            $('#myModal1').modal("show");
        }else{

            $.ajax({
                url : baseUrl +'/pmo/search',
                type: 'POST',
                data: {'nama': nama, 'tahun' : tahun, 'bulan' : bulan, 'role' : role},
                dataType: 'json',
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                success:function(r){
                    var t = '';
                    var no = 1;
                    var na = 0;
                    var tn;

                    $('.result-search-pmo tr').remove();
                    $.each(r.content, function(k, v){

                      t += '<tr>';
                      t += '<td style="text-align:center">'+no+'</td>';
                      t += '<td>' + v.KINERJA_NAME + '</td>';
                      t += '<td>' + v.KPI_NAME + '</td>';
                      t += '<td style="text-align:center">' + v.BOBOT + '</td>';
                      t += '<td style="text-align:center">' + v.BOBOT_GP + '</td>';//PENCAPAIAN
                      t += '</td>'+ count_total(v.BOBOT) + '</td>';
                      t += '</tr>';
                      
                      if(v.BOBOT == '-'){
                      
                        tn = '-';
                      
                      }else{
                      
                        tn = na + v.BOBOT;
                      
                      }
                     
                      na = tn;
                      no++;

                  });

                    t += '<tr>';
                    t += '<td colspan="2" style="text-align:center">TOTAL</td>';
                    t += '<td colspan="2" style="text-align:center">'+tn+'</td>';
                    t += '</tr>';              
                    
                    $('.result-search-pmo').append(t);
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
                }  
            });
        }
    });
    //e.preventDefault();

    $('#contt').hide();
    $('#openContainer').click(function(){
      var nama = $('#idemp').val();
      var bulan = $('#idbln').val();
      var tahun = $('#idthn').val();

      if(nama == "" || bulan == "" || tahun == ""){     
        $("#error1").html("Your Data is not complete!");
        $('#myModal1').modal("show");
        $('#contt').hide();
         
      }else{
        $('#contt').show();
      }

    });

    $('#btn-input-pmo').click(function(){
      var nama = $('#idemp').val();
      var bulan = $('#idbln').val();
      var tahun = $('#idthn').val();
      var kritik = $('#comment').val();
      var roles = $('#role_id_inst').val();
      var na = 0;
      var tn;
      var countlist = $('#countlist').val();
      var x = [];
      var flag = "bobotOk";

      if(kritik.length < 20){
      
        $("#error1").html("The number of characters your fill is "+kritik.length+".</br>you must fill more than 20 characters");
        $('#myModal1').modal("show");

      }else{

          for(var i = 0; i < countlist; i++){
             no = 2 + i;
             var bobot = $('.bobot_list' + no).val();
             x.push({
                list_id: $('.list_id' + no).val(),
                bobot: bobot
             });
            
            tn = na + parseInt(bobot);
            na = parseInt(tn);

            if(x[i]['bobot'] == "")
            {flag="bobotEror"; break;}
            
            no ++;
          
          }
            
          if(flag == "bobotOk"){

            var data = {
              'nama':nama,
              'bulan':bulan,
              'tahun':tahun,
              'kritik':kritik,
              'total':tn,
              'role':roles,
              'list_bobot': x
            };

            $.ajax({
                url : baseUrl +'/pmo/input',
                type: 'POST',
                data: data,      
                dataType: 'json',
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                success:function(r){
                  if(r.msg == 'Success Insert'){
                    $("#error2").html(r.msg);
                    $('#myModal2').modal("show");
                  }else if(r.msg == 'Assembly Error!'){
                    $("#error1").html(r.msg);
                    $('#myModal1').modal("show");
                  }else if(r.msg == 'Data is already available!'){
                    $("#error1").html(r.msg);
                    $('#myModal1').modal("show");
                  }
                  
                  setTimeout(function(){// wait for 5 secs(2)
                    location.reload(); // then reload the page.(3)
                  }, 1000);
                  
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
               }
            });

          }else{

              $("#error1").html("Please check again, there is an empty assessment!");
              $('#myModal1').modal("show");
          }      
      }
    
    });

});   
</script>

@endsection