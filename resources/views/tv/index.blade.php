<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Entrega de turnos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<style>
		html,body{height:100%;}
.carousel,.item,.active{height:100%;}
.carousel-inner{height:100%;}
	</style>
</head>
<body  onload="setInterval(onTimerElapsed, 1000);">
<!--<body>-->
	<div style="margin-left: 0px; margin-right: 0px; height: 100%;">
		<div class="row" style="height: 100%; width: 100%">
			<div class="col-md-8">
				<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block h-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(15).jpg" alt="First slide" height="100%" width="100%">
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%">
								<source src="/video/video.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item">
							<img class="d-block h-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(16).jpg" alt="Second slide" height="100%" width="100%">
						</div>
						<div class="carousel-item">
							<img class="d-block h-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(17).jpg" alt="Third slide" height="100%" width="100%">
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<header>
					<img src="/img/logo-analizar-web-2017.png" alt="" width="300px" class="center">
				</header>
				<div class="row header-tv">
					<div class="col-md-6"><h3 >Turno</h3></div>					
					<div class="col-md-6"><h3 >Modulo</h3></div>					
				</div>

				@foreach ($turnos as $item)
				<div class="row turno-tv">
					<div class="col-md-6">
						<div class="turno">
							<h3 >{{ $item->codigo }}</h3>
						</div>
					</div>					
					<div class="col-md-6">
						<div class="turno">
							<h3 >{{ $item->modulo }}</h3>
						</div>
					</div>
				</div>					
				@endforeach    
			</div>	
		</div>	
	
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
    function onTimerElapsed() {
        setTimeout(function(){
		   window.location.reload(1);
		}, 1000);
    }
</script>
<script type="text/javascript">
    
    $('video').on('play', function (e) {
    	$("#carouselExampleFade").carousel('pause');
	});
	$('video').on('stop pause ended', function (e) {
	    $("#carouselExampleFade").carousel();
	});
	$('video .active').get(0).play();
</script>
</html>