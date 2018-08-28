@extends('layouts.master_obuPln')

@if($dashboard == '1')
	@section('contentLevel')
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard active"></i> Dashboard OBU YellowFin</a></li>
		</ol>
	@endsection

	@section('content')
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title" style="height: 35px;">
						<div class="col-md-3">
							<h2><i class="fa fa-bar-chart"></i>&nbsp;Title Graph</h2>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<div class="col-md-12">
							<div id="barDrilldown" name="barDrilldown"></div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title" style="height: 35px;">
						<h2><i class="fa fa-pie-chart"></i>&nbsp;Title Graph</h2>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<div class="col-md-12">
							Content
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection

	@push('scripts')
		<script>
			$(function() {
				$('#Liobu').addClass('active');
				barDrildownChart();
				// $.ajax({
				// 	url : baseUrl +'/obu/GrafMnd',
				// 	type: 'POST',
				// 	data: {'p_tahun': '2017'},
				// 	dataType: 'json',
				// 	beforeSend: function(){
				// 		$('.ajax-loader').css("visibility", "visible");
				// 	},
				// 	success : function(data){
				// 		// var seriesData = data.seriesData;
				// 		// var drilldownData = data.drilldownData;

				// 		barDrildownChart();
				// 	},
				// 	complete: function(){
				// 		$('.ajax-loader').css("visibility", "hidden");
				// 	}
				// });
			});

			function barDrildownChart(){
				Highcharts.chart('barDrilldown', {
					chart: { type: 'column' },
					title: { text: '' },
					subtitle: { text: '' },
					xAxis: { type: 'category' },
					yAxis: {
						title: { text: '' }
					},
					legend: { enabled: false },
					plotOptions: {
						series: {
							borderWidth: 0,
							dataLabels: {
								enabled: true,
								format: '{point.y:.1f}%'
							}
						}
					},

					tooltip: {
						headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
					},
					series: [{
						name: "Test",
						colorByPoint: true,
						data: [{
							name: "Chrome",
							y: 62.74,
							drilldown: "Chrome"
						},{
							name: "Firefox",
							y: 10.57,
							drilldown: "Firefox"
						},{
							name: "Internet Explorer",
							y: 7.23,
							drilldown: "Internet Explorer"
						}]
					}],
					drilldown: {
						series: [{
							name: "Chrome",
							id: "Chrome",
							data: [
								["v65.0", 0.1],
								["v64.0", 1.3],
								["v63.0", 53.02],
								["v62.0", 1.4 ],
								["v61.0", 0.88],
								["v60.0", 0.56],
								["v59.0", 0.45],
								["v58.0", 0.49],
								["v57.0", 0.32],
								["v56.0", 0.29],
								["v55.0", 0.79],
								["v54.0", 0.18],
								["v51.0", 0.13],
								["v49.0", 2.16],
								["v48.0", 0.13],
								["v47.0", 0.11],
								["v43.0", 0.17],
								["v29.0", 0.26]
							]
						},{
							name: "Firefox",
							id: "Firefox",
							data: [
								["v58.0", 1.02],
								["v57.0", 7.36],
								["v56.0", 0.35],
								["v55.0", 0.11],
								["v54.0", 0.1],
								["v52.0", 0.95],
								["v51.0", 0.15],
								["v50.0", 0.1],
								["v48.0", 0.31],
								["v47.0", 0.12]
							]
						},{
							name: "Internet Explorer",
							id: "Internet Explorer",
							data: [
								["v11.0", 6.2],
								["v10.0", 0.29],
								["v9.0", 0.27],
								["v8.0", 0.47]
							]
						}]
					}
				});
			}
		</script>
	@endpush
@elseif($dashboard == '2')
	@section('contentLevel')
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard active"></i> Dashboard OBU YellowFin</a></li>
		</ol>
	@endsection

	@section('content')
		Dashboard OBU YF
	@endsection

	@push('script')
		<script>
			$(function() {
				$('#LiobuYf').addClass('active');
			});
		</script>
	@endpush
@elseif($dashboard == '3')
	@section('contentLevel')
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard active"></i> Dashboard PLN</a></li>
		</ol>
	@endsection

	@section('content')
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-bar-chart"></i> Jumlah Kontrak Periode 2017</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>

					<div class="box-body">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">
										<input type="radio" name="kontrak_type" class="flat-red kontrak_radio" value="kontrak_type_p" checked> PRK&nbsp;&nbsp;
										<input type="radio" name="kontrak_type" class="flat-red kontrak_radio" value="kontrak_type_r"> Rupiah
									</label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<select class="form-control" id="bulan_kontrak" name="bulan_kontrak">
										<option value="" selected>- Semua Bulan -</option>
										<option value="January">January</option>
										<option value="February">February</option>
										<option value="March">March</option>
										<option value="April">April</option>
										<option value="May">May</option>
										<option value="June">June</option>
										<option value="July">July</option>
										<option value="August">August</option>
										<option value="September">September</option>
										<option value="October">October</option>
										<option value="November">November</option>
										<option value="December">December</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-9">
								<div id="ChartKontrak"></div>
							</div>
							<div class="col-lg-3">
								<div id="miniChartKontrak"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><br/>

		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-pie-chart"></i> Anggaran Vs Paket (HPaket) Periode 2017</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>

					<div class="box-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="col-md-2">
									<div class="form-group">
										<select class="form-control" id="unit" name="unit">
											<option value="JTBN">JTBN</option>
											
										</select>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<select class="form-control" id="bulan_VS" name="bulan_VS">
											<option value="" selected>- Semua Bulan -</option>
											<option value="January">January</option>
											<option value="February">February</option>
											<option value="March">March</option>
											<option value="April">April</option>
											<option value="May">May</option>
											<option value="June">June</option>
											<option value="July">July</option>
											<option value="August">August</option>
											<option value="September">September</option>
											<option value="October">October</option>
											<option value="November">November</option>
											<option value="December">December</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div id="ChartVsPRK"></div>
							</div>

							<div class="col-lg-6">
								<div id="ChartVsAnggaran"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection

	@push('scripts')
		<script>
			$(function() {
				$('#Lipln').addClass('active');
				$.ajaxSetup({
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') }
				});

				google.charts.load('upcoming', {'packages':['corechart', 'map']});

				$('input[type="radio"].flat-red').iCheck({
					checkboxClass: 'icheckbox_flat-green',
					radioClass: 'iradio_flat-green'
				});

				$('input[name="kontrak_type"]').on('ifChecked', function(){
					if ( $(this).is(':checked') ) { drawKontrakChart(); }
				});

				$('#bulan_kontrak').change(function() { drawKontrakChart(); });

				$('#unit').change(function(){ drawChartVs(); });

				$('#bulan_VS').change(function() { drawChartVs(); });

				drawKontrakChart();
				drawChartVs();
			});

			var titleText = "";
			var seriesText = "";
			var pointFormatStr = "";
			var titleStr = "";

			function drawKontrakChart(){
				var type = $("input[name='kontrak_type']:checked").val();
				var bulan = $('#bulan_kontrak').val();

				if(type == 'kontrak_type_p'){
					titleText = 'Total Kontrak';
					seriesText = '<span style="font-size:8px">{point.y}</span><br>';
					pointFormatStr = '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>';
				}else {
					titleText = 'Total Rupiah';
					seriesText = '<span style="font-size:8px">Rp. {point.y}</span><br>';
					pointFormatStr = '<span style="color:{point.color}">{point.name}</span>: <b>Rp. {point.y} M</b><br/>';
				}

				if(bulan == '') {
					if(type == 'kontrak_type_p') titleStr = 'Data from January to October, 2017';
					else titleStr = 'Data from January to October, 2017';

					var val = {
						type: type
					};

					httpSend('getKontrakData', val).done(r => {
						if(type == 'kontrak_type_p'){
							tempData = r.legend;
							for (var i=0; i < tempData.length; i++) {
								tempData[i].jmlh = formatStrRupiah(tempData[i].jmlh);
							}
							r.legend = tempData;
						}else {
							var tempDataSeries = r.seriesData.data;
							var tempDataDrilldown = r.drilldownData;
							for (var i= 0; i < tempDataSeries.length; i++) {
								tempDataSeries[i].y = formatBillion(tempDataSeries[i].y);

							};
							r.seriesData.data = tempDataSeries;
							for (var i= 0; i < tempDataSeries.length; i++) {
								for (var j= 0; j < tempDataDrilldown[i].data.length; j++) {
									tempDataDrilldown[i].data[j][1] = formatBillion(tempDataDrilldown[i].data[j][1]);
								}
							};
							r.drilldownData = tempDataDrilldown;
						}
						drawKontrak(r);
					});
				}else {
					if(type == 'kontrak_type_p') titleStr = 'Data '+bulan+', 2017';
					else titleStr = 'Data '+bulan+', 2017';

					var val = {
						_token: $('meta[name="csrf-token"]').attr('content'),
						type: type,
						bulan: bulan
					};
					httpSend('getKontrakBulanData', val).done(r => {
						if(type == 'kontrak_type_p'){
							tempData = r.legend;
							for (var i=0; i < tempData.length; i++) {
								tempData[i].jmlh = formatStrRupiah(tempData[i].jmlh);
							}
							r.legend = tempData;
						}else {
							var tempDataSeries = r.seriesData.data;
							var tempDataDrilldown = r.drilldownData;
							for (var i= 0; i < tempDataSeries.length; i++) {
								tempDataSeries[i].y = formatBillion(tempDataSeries[i].y);

							};
							r.seriesData.data = tempDataSeries;
							for (var i= 0; i < tempDataSeries.length; i++) {
								for (var j= 0; j < tempDataDrilldown[i].data.length; j++) {
									tempDataDrilldown[i].data[j][1] = formatBillion(tempDataDrilldown[i].data[j][1]);
								}
							};
							r.drilldownData = tempDataDrilldown;
						}
						drawKontrak(r);
					});
				}
			}

			function drawKontrak(data) {
				$('#miniChartKontrak').html('');

				var legend = data.legend;
				var strLegend = '<ul class="chart-legend clearfix">';
				for (var i= 0; i < legend.length; i++) {
					strLegend +=
						'<li>'+
							'<i class="fa fa-caret-right"></i> '+
							legend[i].name+' - '+legend[i].jmlh+
						'</li>';
				};
				strLegend += '</ul>';
				$('#miniChartKontrak').html(strLegend);
				var seriesData = data.seriesData;
				var drilldownData = data.drilldownData;

				Highcharts.chart('ChartKontrak', {
					chart: { type: 'column' },
					title: { text: titleStr },
					subtitle: { text: 'Click the columns to view details.' },
					xAxis: { type: 'category' },
					yAxis: {
						title: { text: titleText }
					},
					legend: { enabled: true },
					plotOptions: {
						series: { borderWidth: 0, dataLabels: {
								enabled: true,
								format: seriesText
							}
						}
					},
					tooltip: {
						headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
						pointFormat: pointFormatStr
					},
					series: [seriesData],
					drilldown: {
						series: drilldownData
					}
				});
			}

			function drawChartVs(){
				var unit = $('#unit').val();
				var bulan = $('#bulan_VS').val();

				if(bulan == '') {
					var val = {
						_token: $('meta[name="csrf-token"]').attr('content'),
						unit: unit,
						bulan: bulan
					};
					httpSend('getVsData', val).done(r => {
						drawVs(r);
					});
				}else {
					var val = {
						_token: $('meta[name="csrf-token"]').attr('content'),
						unit: unit,
						bulan: bulan
					};
					httpSend('getVsDataBulan', val).done(r => {
						drawVs(r);
					});
				};
			}

			function drawVs(data) {
				var seriesDataPRK = data.seriesDataPRK;
				var drilldownDataPRK = data.drilldownDataPRK;

				var seriesDataAnggaran = data.seriesDataAnggaran;
				var drilldownDataAnggaran = data.drilldownDataAnggaran;

				//Vs PRK
				Highcharts.chart('ChartVsPRK', {
					chart: { type: 'pie' },
					title: { text: 'PRK' },
					subtitle: { text: 'Click the slices to view details' },
					plotOptions: {
						series: {
							dataLabels: { enabled: true, format: '{point.name}: {point.y:.1f}%' }
						}
					},

					tooltip: {
						headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
					},
					series: [ seriesDataPRK ],
					drilldown: {
						series: drilldownDataPRK
					}
				});

				//Vs Anggaran
				Highcharts.chart('ChartVsAnggaran', {
					chart: { type: 'pie' },
					title: { text: 'Anggaran' },
					subtitle: { text: 'Click the slices to view details' },
					plotOptions: {
						series: {
							dataLabels: { enabled: true, format: '{point.name}: {point.y:.1f}%' }
						}
					},

					tooltip: {
						headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
						pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
					},
					series: [ seriesDataAnggaran ],
					drilldown: {
						series: drilldownDataAnggaran
					}
				});
			}

			function formatStrRupiah(number) {
				var val = 0;
				var str = "";
				val = number / 1000000000;
				str = "Rp. "+Highcharts.numberFormat(val,0,',','.')+" M";
				return str;
			}

			function formatBillion(number){
				var val = 0;
				val = number / 1000000000;
				val = Math.round(val);
				return val;
			}

			function formatValue(tipe, number) {
				var valuefmt = "";
				switch(tipe) {
					case 'prk':
						valuefmt = Highcharts.numberFormat(number,0,',','.')  + ' PRK';
					break;
					case 'aki':
					case 'ai':
						valuefmt = 'Rp. ' + Highcharts.numberFormat(number,2,',','.');
					break;
					case 'spm':
						if(window.spm_type != 'spm_type_r')
							valuefmt = Highcharts.numberFormat(number,0,',','.')  + ' PRK';
						else
							valuefmt = 'Rp. ' + Highcharts.numberFormat(number,2,',','.');
					break;
					case 'metode':
						if(window.metode_type != 'metode_type_r')
							valuefmt = Highcharts.numberFormat(number,0,',','.')  + ' PRK';
						else
							valuefmt = 'Rp. ' + Highcharts.numberFormat(number,2,',','.');
					break;
					case 'program':
						if(window.program_type != 'program_type_r')
							valuefmt = Highcharts.numberFormat(number,0,',','.')  + ' PRK';
						else
							valuefmt = 'Rp. ' + Highcharts.numberFormat(number,2,',','.');
					break;
					case 'strategi':
						if(window.strategi_type != 'strategi_type_r')
							valuefmt = Highcharts.numberFormat(number,0,',','.')  + ' PRK';
						else
							valuefmt = 'Rp. ' + Highcharts.numberFormat(number,2,',','.');
					break;
					default:
						valuefmt = Highcharts.numberFormat(number,0,',','.');
					break;
				}
				return valuefmt;
			}
		</script>
	@endpush
@endif