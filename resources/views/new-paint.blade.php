
@extends('site-header')

@section('page-spec')
	<style type="text/css">
		.new-paint{
			color: black;
			border-bottom: 2px solid black;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#current-color').change(function(){
				var color = $('#current-color').val();
  				$('#current-car').removeAttr('class');
  				$('#current-car').addClass(color.toLowerCase()+'-color car');	
  			});

  			$('#target-color').change(function(){
				var color = $('#target-color').val();
  				$('#target-car').removeAttr('class');
  				$('#target-car').addClass(color.toLowerCase()+'-color car');	
  			});
  		});
	</script>
@endsection

@section('page-name')
	New Paint Job
@endsection

@section('content')
	<div id="preview">
		<div id="current-car" class='default-color car'></div>
		<img src="../public/assets/images/arrow.png" id='arrow'>
		<div id="target-car" class='default-color car'></div>
	</div>
	<br>
	<br>
	<h3>Car Details</h3>
	<form method="post" action="/auto-paint/public/process-paint-job">
		@csrf
		<div class="plate-no-label form-label">Plate No.</div>
		<input type="text" id="plate-no" class="car-form" name="plate_no">
		<br>
		<br>
		<div class="current-color-label form-label"> Current Color </div>
		<select id="current-color" class="car-form" name='current_color'>
			<option disabled selected value></option>
			<option value="Red">Red</option>
			<option value="Blue">Blue</option>
			<option value="Green">Green</option>
		</select>
		<br>
		<br>
		<div class="target-color-label form-label"> Target Color </div>
		<select id="target-color" class="car-form" name='target_color'>
			<option disabled selected value></option>
			<option value="Red">Red</option>
			<option value="Blue">Blue</option>
			<option value="Green">Green</option>
		</select>
		<br>
		<br>
		<input type="submit" class="submit-button" value="Submit">
	</form>
@endsection
