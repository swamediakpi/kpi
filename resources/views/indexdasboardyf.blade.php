@extends('layouts.masteryf')

@section('content')
@if ($dashboard== '1')
			<div class="row">
				<div id=\"yfReportContainera17406ec-c9ed-44a2-8f7e-b9e248fbe107\"></div>
			</div>

<script type="text/javascript" src="http://149.129.217.187:8080/JsAPI?reportUUID=15284fd5-838a-41aa-b7c7-fd0f86a0a735"></script>
@elseif ($dashboard== '2')
			<div class="row">
				<div id=\"yfReportContainera17406ec-c9ed-44a2-8f7e-b9e248fbe107\"></div>
			</div>
<script type="text/javascript" src="http://149.129.217.187:8080/JsAPI?reportUUID=9ea8aa63-1645-4f94-a7f6-3da255dcbc6e"></script>
@elseif ($dashboard== '3')
			<div class="row">
				<div id=\"yfReportContainera17406ec-c9ed-44a2-8f7e-b9e248fbe107\"></div>
			</div>
<script type="text/javascript" src="http://149.129.217.187:8080/JsAPI?reportUUID=077e75cf-c6d3-42ad-b748-fd1e78094776"></script>
		
@else
		    <div class="row">
				<div id=\"yfReportContainera17406ec-c9ed-44a2-8f7e-b9e248fbe107\"></div>
			</div>
			<script type="text/javascript" src="http://149.129.217.187:8080/JsAPI?reportUUID=8d33151a-3aee-4fa6-be1b-9025e81f7685&amp;width=939&amp;height=617"></script>
@endif
@endsection