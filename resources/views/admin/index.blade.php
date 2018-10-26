<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Digiturno</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="background-color: white;">
	<header>
		<div class="row">
			
			<div class="col-md-4">
				<img src="/img/logo-analizar-web-2017.png" alt="">		
			</div>
			<div class="col-md-6 offset-md-1" >
				<ul class="nav nav-pills" style="height:100%; align-items: center;">
					<li class="nav-item">
						<a class="nav-link active" href="/admin/turnos">Cola de turnos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/admin/modulos">Modulos</a>
					</li>
				</ul>
			</div>		
		
		</div>
	</header>
	<div class="container">			
		<div id="contenido" class="col-md-12">
			<div class="row">			
				<h5 style="color: white">Cargando...</h5>
			</div>
		</div>			
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
		update();
		var t=setInterval(update,1000);
	});
	function update(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			url: '/admin/turnos',
			dataType: 'json',
			success: function (data) {
				$('#contenido').empty();
				var j = 0;
				for (var i = 0; i < Math.round((data.length/4)+0.5); i++) {
					$( "#contenido" ).append( "<div id=\"row"+i+"\" class=\"row\" style=\"margin-top:1%\">" );
					for (; j < data.length; j++) {
						var estado = "En sala";
						if(data[j].estado == 2)
							estado = "Distraido";
						var tiempoCreado = new Date(data[j].turnos[0].created_at);
						var now = Date.now();
						

						$("#row"+i).append("<div class=\"col-md-4\">"+
								"<div class=\"card\" style=\"width: 100%;\">"+
									"<div class=\"card-body\">"+
										"<h5 class=\"card-title\"><strong>Turno "+data[j].turnos[0].codigo+"</strong></h5>"+
										"<p class=\"card-text\">Tiempo en sala: <strong>"+msToTime(now - tiempoCreado)+"</strong></p>"+
										"<p class=\"card-text\">Estado: <strong>"+estado+"</strong></p>"+
										"<p class=\"card-text\">Cantidad de llamados: <strong>"+data[j].turnos[0].cantLlamados+"</strong></p></div></div></div>");
						//console.log(data[j].turnos);
						if(j > 0 && (j+1)%3 == 0){							
							j++;
							break;
						}
					}
				}
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
		function msToTime(duration) {
			var milliseconds = parseInt((duration % 1000) / 100),
			seconds = parseInt((duration / 1000) % 60),
			minutes = parseInt((duration / (1000 * 60)) % 60),
			hours = parseInt((duration / (1000 * 60 * 60)) % 24);

			hours = (hours < 10) ? "0" + hours : hours;
			minutes = (minutes < 10) ? "0" + minutes : minutes;
			seconds = (seconds < 10) ? "0" + seconds : seconds;

			return hours + ":" + minutes + ":" + seconds;
		}
	}

</script>
</html>