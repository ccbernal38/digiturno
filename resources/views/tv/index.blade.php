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
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">


	<style>
		html{
			cursor: all;
		}

		html,body{height:100%;}
.carousel,.item,.active{height:100%;}
.carousel-inner{height:100%;}
/* Standard syntax */

	</style>

</head>
<body>
<!--<body>-->
	<div style="margin-left: 0px; margin-right: 0px; height: 100%;background-color: white;">
		<div class="row" style="height: 100%; width: 100%">
			<div class="col-md-8">
				<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block h-100" src="/upload/2.jpg" alt="First slide" height="100%" width="100%">
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/1.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/3.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/4.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/5.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/6.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/7.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/8.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/9.mp4"  type="video/mp4" />
							</video>
						</div>
						<div class="carousel-item video">
							<video class="d-block h-100"  height="100%" width="100%" autoplay>
								<source src="/upload/10.mp4"  type="video/mp4" />
							</video>
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

				@for ($i = 0; $i < 5 ; $i++)
				<div id="row{{ $i }}" class="row turno-tv">
					<div class="col-md-6">
						<div id="turno{{ $i }}" class="turno">
							<h3></h3>
						</div>
					</div>					
					<div class="col-md-6">
						<div id="modulo{{ $i }}"class="turno">
							<h3 class="moduloClass"></h3>
						</div>
					</div>
				</div>					
				@endfor  
			</div>	
		</div>	
	
	</div>
	<audio id="buzzer" src="/sound/timbre.ogg" type="audio/ogg"/>

 <script src=" {{ asset('js/app.js') }} " type="text/javascript" charset="utf-8" async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
	$(document).ready(function(){
		 $(".video .active").get(0).play();
		var i = 0;	
		window.setInterval(function() {
    		//consultarTurnos();
		}, 1000);
		
	});
	function isEmpty( el ){
		return !$.trim(el.html())
	}
	async function stopAnimation(ms, comp1) {
	  return new Promise(resolve => {
	    setTimeout(function(){
			comp1.removeClass('infinite');
			document.getElementById("buzzer").play();
	    }, ms);
	  });
	}
	async function wait(ms, comp1, comp2) {
	  return new Promise(resolve => {
	    setTimeout(function(){
			comp1.text("");
			comp2.text("");


	    }, ms);
	  });
	}
</script>
<script type="text/javascript">
    
    $('video').on('play', function (e) {
    	$("#carouselExampleFade").carousel('pause');
	});
	$('video').on('stop pause ended', function (e) {
	    $("#carouselExampleFade").carousel();
	});

	
</script>
</body>
</html>