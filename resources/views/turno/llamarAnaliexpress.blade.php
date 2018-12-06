<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Entrega de turnos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<header class="row">
		<img src="/img/logo-analizar-web-2017.png" alt="">
		<h1 style="vertical-align: middle; margin: auto;margin-right: 5%;color:#00408b;"><strong>{{ $nombre }}</strong></h1>
	</header>
	<input id="user_id" type="hidden" value="{{ $user_id }}">

	<div>
		
		<div class="row">
			<h1 style="text-align: center;width: 100%; font-weight: bold;">{{ $nombreModulo }}</h1>
			<input id="modulo" type="hidden" value="{{ $id }}">
			<input id="nombreRecepcion" type="hidden" value="{{ $nombre }}">
		</div>
		<div class="row">
			<div class="offset-md-4 col-md-4">
				<div class="border-llamar">
					<h3 style="text-align: center;">Turno</h3>			
				</div>
			</div>	
			<div class="body-llamar row" style="width: 100%">
				<h5 id="next" style="font-size: 10vw;text-align: center;"></h5>			
			</div>
			<div class="offset-md-4 col-md-4">				
				<input id="turno" type="hidden" value="{{ $id }}">
				<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;" type="submit" id="nextTurno" value="Llamar turno">
				<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" disabled="true" type="submit" id="tomaMuestra" value="Pasar a toma de muestra" >
				<input class="btn btn-primary" style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" type="submit" id="atender" value="Atender turno" >
				<h2 id="cuentaRegresiva" style="text-align: center;"></h2>
				<input class="btn btn-success" style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" type="submit" id="finish" value="Finalizar turno"  data-toggle="modal" data-target="#modal-finalizar" >		
			</div>
		</div>
	</div>
	<div class="row">
		<div class="offset-md-1 col-md-5">
			<input type="submit" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter" style="width: 100%;" name="pausar" value="Pausar servicio">
		</div>
		<div class="col-md-5">
			<input type="submit" class="btn btn-info" style="width: 100%;" name="espera" value="Turno en espera">
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Pausar servicio</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<select name="pausa" id="selectpausa"  class="form-control">
						@foreach ($motivoPausa as $item)
						    <option value="{{ $item->id }}"> {{ $item->nombre }} </option>
						@endforeach    
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button id="aceptarModalPausar" type="button" class="btn btn-primary">Aceptar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-finalizar" tabindex="-1" role="dialog">
		<div class="modal-dialog  modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Finalizar turno</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea finalizar el turno actual?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="finalizar">Finalizar</button>
				</div>
			</div>
		</div>
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
		 $("#nextTurno").click(function (e) {		 	
			e.preventDefault(); 			
			llamarTurno();			
		 });
		 $("#atender").click(function (e) {		 	
			e.preventDefault(); 			
			detener = 1;
			totalTiempo = 30;
		 });

		$("#finalizar").click(function (e) {		 	
			//e.preventDefault(); 			
			finalizar();
			
			$("#modal-finalizar").modal('hide');

		});	
		$('#aceptarModalPausar').click(function(event) {
			event.preventDefault();
			window.location.replace("/");
		});
	});
	function llamarTurno(){
		clearTimeout(timeout);
		$("#nextTurno").prop('disabled', true);
		var json = {
			"id":$('#modulo').val(),
			"user_id":$('#user_id').val(),
		};
		console.log(json);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			url: '/llamarTurnoAnaliexpress',
			dataType: 'json',
			data: json,
			success: function (data) {
				console.log(data);
				$("#nextTurno").prop('disabled', false);
				$('.body-llamar').empty();
				if(data.estado == 1){
					$("<h5 id=\"next\" style=\"font-size: 10vw;text-align: center;margin: auto\">"+data.turno+"</h5>").appendTo('.body-llamar');
					$('#next').css('font-size', '4vw');
					$('#next').text(data.turno);						
					$("#tomaMuestra").hide();
					$("#atender").hide();
					$("#finish").hide();
					$("#nextTurno").show();
					$('#cuentaRegresiva').text('');
				}else{
					$("<h5 id=\"next\" style=\"font-size: 10vw;text-align: center;margin: auto\">"+data.turno+"</h5>").appendTo('.body-llamar');
					$('#next').css('font-size', '10vw');
					$('#next').text(data.turno);
					$('#turno').val(data.id);
					$("#tomaMuestra").show();
					$("#atender").show();
					$("#finish").show();
					$("#nextTurno").hide();
					temporizador();
				}	
				
					
			},
			error: function (data) {
				
				console.log( data);
			}
		});
	}
	function finalizar(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			url: '/finalizarAnaliexpress',
			dataType: 'json',
			data:{
				'id':$('#turno').val(),
				"id_modulo":$('#modulo').val(),
				"user_id":$('#user_id').val(),
			},
			beforeSend: function(){
				$('#finalizar').attr("disabled", true);
			},			
			success: function (data) {
				clearTimeout(timeout);
				$('.body-llamar').empty();
				if(data.estado == 1){
					totalTiempo = 30;
					$("<h5 id=\"next\" style=\"font-size: 10vw;text-align: center;margin: auto\">No hay turnos disponibles</h5>").appendTo('.body-llamar');	
					$('#next').css('font-size', '4vw');					
					$("#tomaMuestra").hide();
					$("#atender").hide();
					$("#finish").hide();
					$("#nextTurno").show();
					$('#cuentaRegresiva').text('');
				}else{
					$("<h5 id=\"next\" style=\"font-size: 10vw;text-align: center;margin: auto\">"+data.turno+"</h5>").appendTo('.body-llamar');
					$('#next').css('font-size', '10vw');
					$('#next').text(data.turno);
					$('#turno').val(data.id);
					$("#tomaMuestra").show();
					$("#atender").show();
					$("#finish").show();
					$("#nextTurno").hide();
					temporizador();
				}	
				$('#finalizar').attr("disabled", false);
			},
			error: function (data) {
				
				console.log(data);
			}
		});
	}
	function distraido(){
		var json = {
			'id':$('#turno').val(),
			"id_modulo":$('#modulo').val(),
			"user_id":$('#user_id').val(),
		};
		console.log(json);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			url: '/distraidoAnaliexpress',
			dataType: 'json',
			data:{
				'id':$('#turno').val(),
				"id_modulo":$('#modulo').val(),
				"user_id":$('#user_id').val(),
			},
			success: function (data) {
				console.log(data);
				if(data.estado == 1){
					totalTiempo = 30;
					$('#next').css('font-size', '4vw');
					$('#next').text(data.turno);
					$('#turno').empty();
					$("#tomaMuestra").hide();
					$("#atender").hide();
					$("#finish").hide();
					$("#nextTurno").show();
					$('#cuentaRegresiva').text('');
				}else{
					$('#next').css('font-size', '10vw');
					$('#next').text(data.turno);
					$('#turno').val(data.id);
					$("#tomaMuestra").show();
					$("#atender").show();
					$("#finish").show();
					$("#nextTurno").hide();
					temporizador();
				}											
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	}
	var totalTiempo = 30;

	var detener = 0;
	var timeout;
	function temporizador(){
		/* Determinamos la url donde redireccionar */
		document.getElementById('cuentaRegresiva').innerHTML = "Enviando a distraido en "+totalTiempo+" segundos";
		if(totalTiempo == 0)
		{
			if(detener == 0){
				distraido();
			 	totalTiempo = 30;	
			 	clearTimeout(timeout);
			}else{
				clearTimeout(timeout);
				detener = 0;
			}
			 return;
		}else{
			/* Restamos un segundo al tiempo restante */
			totalTiempo -= 1;
			/* Ejecutamos nuevamente la función al pasar 1000 milisegundos (1 segundo) */
			if (detener == 0) 
			{
				timeout = setTimeout("temporizador()", 1000);
			}else{
				totalTiempo = 30;
				detener = 0;
				clearTimeout(timeout);
				return;
			}
		}
	}
</script>
</html>