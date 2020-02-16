@extends('site-header')

@section('page-spec')
	<style type="text/css">
		.job-list{
			color: black;
			border-bottom: 2px solid black;
		}
	</style>
	<script type="text/javascript">
		setInterval(function(){
		    $('#paint-queue-page').load('paint-queue #paint-queue-page');
		}, 5000);
	</script>
@endsection

@section('page-name')
	Paint Jobs
@endsection

@section('content')
	<div id="paint-queue-page">
		<h4>Paint Jobs In Progress</h3>
		<table id="in-progress">
			<tr class="normal-header">
				<th>Plate No.</th>
				<th>Current Color</th>
				<th>Target Color</th>
				<th>Action</th>
			</tr>
			@foreach($active as $car)
				<tr>
					<td>{{ $car->plate_no }}</td>
					<td>{{ $car->current_color }}</td>
					<td>{{ $car->target_color }}</td>
					<td><a href="mark-finished/{{$car->plate_no}}" class="completer" name="{{$car->plate_no}}">Mark As Completed</a></td>
				</tr>
			@endforeach
		</table>

		<div id="performance">
			<div class="performance-header">SHOP PERFORMANCE</div>
			<div class="stats-box">
				Total Cars Painted: <div class="stat-num">{{ $total_cars }}</div><br>
				Breakdown: <br>
				<div id="breakdown">
					Blue: <div class="stat-num">{{ $blue_cars }}</div><br>
					Red: <div class="stat-num">{{ $red_cars }}</div><br>
					Green: <div class="stat-num">{{ $green_cars }}</div><br>
				</div>
			</div>
		</div>

		<h4 id="queue-title">Paint Queue</h3>
		<table id="queued">
			<tr class="normal-header">
				<th>Plate No.</th>
				<th>Current Color</th>
				<th>Target Color</th>
			</tr>
			@foreach($queued as $car)
				<tr>
					<td>{{ $car->plate_no }}</td>
					<td>{{ $car->current_color }}</td>
					<td>{{ $car->target_color }}</td>
				</tr>
			@endforeach
		</table>
	</div>
@endsection