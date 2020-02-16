<!DOCTYPE html>
<html>
<head>
	<title>Juan's Auto Paint</title>
	<script type="text/javascript" src="../public/assets/js/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../public/assets/css/site.css">
	@yield('page-spec')
</head>
<body>
	<div class="header-container">
		<div class="title-box">
			<h1 class="site-title">JUAN'S AUTO PAINT</h1>
		</div>
		<div class="navbar">
			<div class="options">
				<a href="new-paint-job" class='option new-paint'>NEW PAINT JOB</a>
				<a href="paint-queue" class='option job-list'>PAINT JOBS</a>
			</div>
		</div>
	</div>

	<div class="content">
		<h1 class="content-title">@yield('page-name')</h1>
		@yield('content')
	</div>
</body>
</html>