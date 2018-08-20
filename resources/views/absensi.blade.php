@extends('layouts.master')

@section('content')
<div class="col-md-12 col-sm-4 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>ABSENSI</h2>
			<div class="clearfix"></div>
			<div class="form-horizontal form-label-left">
			@if (Auth::user()->ROLE_ID == '1' || Auth::user()->ROLE_ID == '2' || Auth::user()->ROLE_ID == '3' || Auth::user()->ROLE_ID == '5'|| Auth::user()->ROLE_ID == '6' || Auth::user()->ROLE_ID == '7' || Auth::user()->ROLE_ID == '8')
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
					<label class="control-label col-md-1 col-sm-3 col-xs-12">Employee Name</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select class="form-control empname">
							<option value="" disabled="true" selected="true">Choose Unit First</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12">Periode</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select class="form-control periode">
							<option value="">Select Periode</option>
							<option value="bulanan">Bulanan</option>
							<option value="kumulatif">Kumulatif</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12">Month</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select class="form-control month">
							<option value="" disabled="true" selected="true">Choose Periode First</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12">Year</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select class="form-control year">
							<option value="">Select Unit</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
						</select>
					</div>
				</div>

			@elseif(Auth::user()->ROLE_ID == '4')
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12">Month</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select class="form-control month">
							<option value="">Select Month</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
				</div>

				<input type="hidden" class="empname" value="{{ Auth::user()->EMPLOYEE_ID }}">
				<div class="form-group">
					<label class="control-label col-md-1 col-sm-3 col-xs-12">Year</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select class="form-control year">
							<option value="">Select Year</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<!--<option value="2018">2018</option>-->
						</select>
					</div>
				</div>
			@endif
				<div class="form-group">
					<div class="col-md-9 col-sm-9 col-xs-12 col-md-9">
						<button class="btn btn-success pull-right btn-search-absen">Search</button>
					</div>
				</div> 
			</div>
		</div>

		<div class="x_content">
			<div class="result-search-absen"></div>
			<table class="table table-hover table-bordered">
				<th>Poin Presentase:</th>
				<th>Skor</th>
				<tr>
					<td>90 - 95</td>
					<td>20</td>
				</tr>
				<tr>
					<td>85 - 89</td>
					<td>17</td>
				</tr>
				<tr>
					<td>80 - 84</td>
					<td>15</td>
				</tr>
				<tr>
					<td>75 - 79</td>
					<td>13</td>
				</tr>
				<tr>
					<td>70 - 74</td>
					<td>11</td>
				</tr>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.periode').change(function() {
			var per = $('.periode').val(); var op = "";
			
			$('.month option').remove();
			if(per == "bulanan") {
				op+='<option value="">Select Month</option>';
				op+='<option value="01">Januari</option>';
				op+='<option value="02">Februari</option>';
				op+='<option value="03">Maret</option>';
				op+='<option value="04">April</option>';
				op+='<option value="05">Mei</option>';
				op+='<option value="06">Juni</option>';
				op+='<option value="07">Juli</option>';
				op+='<option value="08">Agustus</option>';
				op+='<option value="09">September</option>';
				op+='<option value="10">Oktober</option>';
				op+='<option value="11">November</option>';
				op+='<option value="12">Desember</option>';
			}else {
				op+='<option value="komulatif">KUMULATIF</option>';
			}
			$('.month').append(op);
		});
		
		$('.unitname').change(function(){
			var id = $('.unitname').val(); var op = "";

			$.ajax({
				type  :'get',
				url   :'{{URL::to('getEmployeeFromUnit')}}',
				data  : {'id':id},
				beforeSend: function(){
					$('.ajax-loader').css("visibility", "visible");
				},
				success:function(data){
					$('.empname option').remove();
					if(data.length == "") {
						op+='<option value="" >Empty</option>';
					}else {
						op+='<option value="" >Choose Employee</option>';
						for(var i = 0 ; i < data.length ; i++) {
							op+='<option value="'+data[i].EMPLOYEE_ID+'">'+data[i].EMPLOYEE_NAME+'</option>';
						}
					}
					$('.empname').append(op);
				},
				complete: function(){
					$('.ajax-loader').css("visibility", "hidden");
				}
			});
		});

		//result-search-absen
		$('.btn-search-absen').click(function() {
			var emp_id = $('.empname').val(); var month  = $('.month').val();
			//var year   = $('.year').val();

			if(emp_id == "" || emp_id == null || month == "" || month == null) {
				$("#error1").html("Your Data must be filled!");
				$('#myModal1').modal("show");
			}else {
				$.ajax({
					url : baseUrl +'/absensi/search',
					type: 'POST',
					data: {'emp_id': emp_id , 'month': month }, //, 'year': year
					dataType: 'json',
					beforeSend: function(){
						$('.ajax-loader').css("visibility", "visible");
					},
					success:function(r){
						var t = ''; var na = 0; var tn;

						$('.result-search-absen table').remove();
						$.each(r.content, function(k, v){
							t += '<table class="table table-hover table-bordered">';
							t += '<tr>';
							t +=    '<td>Nama Karyawan:</td>';
							t +=    '<td colspan="3">'+v.EMPLOYEE_NAME+'</td>';
							t +=    '<td colspan="2">Total Hari Kerja</td>';
							t +=    '<td>'+v.hari_kerja+'</td>';
							t += '</tr>';
							t += '<tr>';
							t +=    '<td>Jabatan / Posisi</td>';
							t +=    '<td colspan="3">'+v.EMPLOYEE_TITLE+'</td>';
							t +=    '<td colspan="2">Total Jam Kerja</td>';
							t +=    '<td>'+v.jam_kerja+'</td>';
							t += '</tr>';
							t += '<tr>';
							t +=    '<td>Unit</td>';
							t +=    '<td colspan="3">'+v.unit+'</td>';
							t +=    '<td colspan="2">Total Menit Kerja</td>';
							t +=    '<td>'+v.menit_kerja+'</td>';
							t += '</tr>';
							t += '<tr>';
							t +=    '<td></td>';
							t +=    '<td colspan="3"></td>';
							t +=    '<td colspan="2" style="color: red">*Asumsi Kerja 8 jam sehari</td>';
							t +=    '<td rowspan="2"></td>';
							t += '</tr>';
							t += '<tr>';
							t +=    '<td></td>';
							t +=    '<td colspan="3"></td>';
							t +=    '<td colspan="2" style="color: red">*Tidak ada perhitungan lembur</td>';
							t += '</tr>';
							t += '</table>';

							t+=  '<table class="table table-hover table-bordered">';
							t+=  '<tr>';
							t+=    '<td>Jumlah Hari Masuk Kerja:</td>';
							t+=    '<td style="width: 30%">'+v.jumlah_hari_kerja+'</td>';
							t+=  '</tr>';
							t+=  '<tr>';
							t+=     '<td>Total Jam Masuk Kerja :</td>';
							t+=     '<td style="width: 30%">'+v.total_jam_kerja+'</td>';  
							t+=  '</tr>';
							t+=  '<tr>';
							t+=    '<td>Total Ijin (menit) :</td>';
							t+=    '<td style="width: 30%">'+v.ijin+'</td>';  
							t+=  '</tr>';
							t+=  '<tr>';
							t+=    '<td>Total Telat Masuk (menit) :</td>';
							t+=    '<td style="width: 30%">'+v.telat+'</td>'; 
							t+=  '</tr>';
							t+=  '<tr>';
							t+=    '<td>Total Telat + Ijin (menit) :</td>';
							t+=    '<td style="width: 30%">'+v.ijin_telat+'</td>';  
							t+=  '</tr>'
							t+=  '<tr>'
							t+=    '<td style="color: white"></td>';
							t+=    '<td style="width: 30%"></td>';  
							t+=  '</tr>';
							t+=  '<tr>';
							t+=    '<td>Total Jam Kerja ( dikurangi ijin ) (menit ) :</td>';
							t+=    '<td style="width: 30%">'+v.grand_total+'</td>';
							t+=  '</tr>';
							t+=  '<tr>';
							t+=    '<td>Target KPI (%)</td>';
							t+=    '<td style="width: 30%"></td>';  
							t+=  '</tr>';
							t+=  '<tr>';
							t+=     '<td>Persentasi Kehadiran ( % ) :</td>';
							t+=   '<td style="width: 30%">'+v.final_total+'</td>'; 
							t+=  '</tr>';
							t+=  '<tr>';
							t+=    '<td>Skor :</td>';
							t+=    '<td style="width: 30%">'+v.skor+'</td>';  
							t+=  '</tr>';
							t+= '</table>';
						});
						$('.result-search-absen').append(t);
					},
					complete: function(){
						$('.ajax-loader').css("visibility", "hidden");
					}
				});
			}
		});
	});
</script>

@endsection