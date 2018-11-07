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
	<input id="modulo" type="hidden" value="{{ $id }}">
	<div>
		<div class="border-container">
			<div class="container">
				<a class="botonEntrega" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">ATENCIÓN</a>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						<label for="inputState0">Seleccione el tipo de paciente</label>
						<select name="recepcion" id="inputState0" class="form-control">
							@foreach ($tipoPaciente as $item)
						    <option value="{{ $item->sigla }}"> {{ $item->nombre }} </option>
								@endforeach    
						</select>
						<a class="btn btn-primary addOther" style="width: fit-content;" href="#">+</a>
					</div>
					<input type="submit" class="btn btn-success" value="Turno" id="submitrecepcion">
				</div>
			</div>
			<div class="container">
				<a class="botonEntrega" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">RESULTADOS</a>
				<div class="collapse" id="collapseExample1">
					<div class="card card-body">
						<input type="submit" value="Turno" id="submitResultados">					
					</div>
				</div>
			</div>

			<div class="container"><a class="botonEntrega"  data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">MUESTRAS PENDIENTES</a>
				<div class="collapse" id="collapseExample2">
					<div class="card card-body">
						<input type="submit" value="Turno" id="submitPendientes">					
					</div>
				</div>
			</div>
			<div class="container"><a class="botonEntrega"  data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">PREPARACION DEL PACIENTE / RECIPIENTES</a>
				<div class="collapse" id="collapseExample3">
					<div class="card card-body">
						<input type="submit" value="Turno" id="submitPreparacion">					
					</div>
				</div>
			</div>
			<div class="container"><a class="botonEntrega"  data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">INFORMACIÓN Y OTROS</a><div class="collapse" id="collapseExample4">
				<div class="card card-body">
						<input type="submit" value="Turno" id="submitInformacion">					
					</div>
				</div>
			</div>
			<div class="container"><a class="botonEntrega"  data-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample5">BACTERIOLOGA ANALIEXPRESS</a>
				<div class="collapse" id="collapseExample5">
					<div class="card card-body">
						<input type="submit" value="Turno" id="submitAnaliExpress">					
					</div>
				</div>
			</div>
		</div>
	</div>

  	<div class="row" style="padding-bottom: 50px;">
		<div class="offset-md-4 col-md-4">
			<div class="border-llamar">
				<h3 style="text-align: center; font-weight: bold;">Llamado de turnos</h3>			
			</div>
			<div class="body-llamar">
				<h5 id="next" style="font-size: 10vw;text-align: center;"></h5>
				<input id="turno" type="hidden" value="{{ $id }}">
			</div>
			<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;" type="submit" id="nextTurno" value="Llamar turno">
			<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" type="submit" id="distraido" value="Distraido" >
			<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" type="submit" id="finish" value="Finalizar turno">		
		</div>
	</div>

</body>
<footer>
	<div class="container-footer">
		<div class="col-md-4">
			<img class="img-footer" src="/img/logo-blanco-1.png" alt="">
			<p>Analizar Laboratorio Clínico, tu Laboratorio de confianza desde 1.978.</p>
		</div>
	</div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>

	$(document).ready(function(){

		var countUpload = 1;
		$(document).on('click', '.addOther', function(e) {
			e.preventDefault();
			var formgroup = $(this).parent(); 
			$(`<div class="card card-body">
							<label for="inputState">Seleccione el tipo de paciente</label>
							<select name="recepcion" id="inputState`+countUpload+`" class="form-control">
								@foreach ($tipoPaciente as $item)
							    <option value="{{ $item->sigla }}"> {{ $item->nombre }} </option>
  								@endforeach    
							</select>
							<a class="btn btn-danger delete" style="width: fit-content;" href="#">-</a>
						</div>`).insertAfter(formgroup);
			countUpload = countUpload + 1;
		});
		$(document).on('click', '.delete', function(e) {
			e.preventDefault();
			console.log("click delete");
			var inputfile = $(this).parent(); 
			$(inputfile).remove();
		});
 		$("#submitResultados").click(function (e) {
 			e.preventDefault(); 
 			var id_modulo = $('#modulo').val();
 			entregaTurno(1, id_modulo);
		});
		$("#submitPendientes").click(function (e) {
 			e.preventDefault(); 
 			var id_modulo = $('#modulo').val();
 			entregaTurno(2, id_modulo);
		});
		$("#submitPreparacion").click(function (e) {
 			e.preventDefault(); 
 			var id_modulo = $('#modulo').val();
 			entregaTurno(3, id_modulo);
		});
		$("#submitInformacion").click(function (e) {
 			e.preventDefault(); 
 			var id_modulo = $('#modulo').val();
 			entregaTurno(4, id_modulo);
		});
		$("#submitAnaliExpress").click(function (e) {
 			e.preventDefault(); 
 			var id_modulo = $('#modulo').val();
 			entregaTurno(5, id_modulo);
		});

		$("#submitrecepcion").click(function (e) {
		 	e.preventDefault(); 
		 	countUpload = 1;
		 	var send = "{";
		 	$('.card > select').each(function(index) {
		 		if(index == 0){
					send += '"recepcion'+index+'":"'+$(this).val()+'"';
		 		}else{
		 			send += ',"recepcion'+index+'":"'+$(this).val()+'"';	
		 		}
		 		
		 	});
		 	send += "}";
			
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/turno/entrega',
				data: JSON.parse(send),
				dataType: 'json',
				success: function (data) {
					console.log(data);
					window.open('/imprimir/'+(data), '_blank');
					location.reload(true);
			 					
				},
				error: function (data) {
					
					console.log('Error:', data);
				}
			});
		 });

		 function entregaTurno($tipoTurno, $id_modulo){
		 	
			var formData = {
				tipo: $tipoTurno,
				id: $id_modulo
			};

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/turno/entregaInfo',
				data: formData,
				dataType: 'json',
				success: function (data) {
					console.log(data);		

				},
				error: function (data) {
					
					window.open('/imprimir/'+serialize(data), '_blank');
					console.log('Error:', data);
				}
			});
		 }

		 $("#nextTurno").click(function (e) {		 	
			e.preventDefault(); 			
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/llamarTurnoInfo',
				dataType: 'json',
				data:{
					"id":$('#modulo').val()
				},
				success: function (data) {
					if(data.estado == 1){
						$('#next').css('font-size', '4vw');
						$('#next').text(data.turno);
						
						$("#tomaMuestra").hide();
						$("#distraido").hide();
						$("#finish").hide();
						$("#nextTurno").show();
					}else{
						$('#next').css('font-size', '10vw');
						$('#next').text(data.turno);
						console.log(data);
						$('#turno').val(data.id);
						$("#tomaMuestra").show();
						$("#distraido").show();
						$("#finish").show();
						$("#nextTurno").hide();
					}		
				},
				error: function (data) {
					
					console.log('Error:', data);
				}
			});
		 });
		 $("#distraido").click(function (e) {		 	
			e.preventDefault(); 			
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/distraidoInfo',
				dataType: 'json',
				data:{
					'id':$('#turno').val(),
					"id_modulo":$('#modulo').val()
				},
				success: function (data) {
					console.log(data);
					if(data.estado == 1){
						$('#next').css('font-size', '4vw');
						$('#next').text(data.turno);
												$('#turno').empty();

						$("#tomaMuestra").hide();
						$("#distraido").hide();
						$("#finish").hide();
						$("#nextTurno").show();

					}else{
						$('#next').css('font-size', '10vw');
						$('#next').text(data.turno);
						$('#turno').val(data.id);
						$("#tomaMuestra").show();
						$("#distraido").show();
						$("#finish").show();
						$("#nextTurno").hide();
					}							
				},
				error: function (data) {
					
					console.log('Error:', data);
				}
			});
		 });

		 $("#finish").click(function (e) {		 	
			e.preventDefault(); 			
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/finalizarInfo',
				dataType: 'json',
				data:{
					'id':$('#turno').val(),
					"id_modulo":$('#modulo').val()
				},
				success: function (data) {
					console.log(data);
					if(data.estado == 1){
						$('#next').css('font-size', '4vw');
						$('#next').text(data.turno);
						$('#turno').empty();
						$("#tomaMuestra").hide();
						$("#distraido").hide();
						$("#finish").hide();
						$("#nextTurno").show();
					}else{
						$('#next').css('font-size', '10vw');
						$('#next').text(data.turno);
						$('#turno').val(data.id);
						$("#tomaMuestra").show();
						$("#distraido").show();
						$("#finish").show();
						$("#nextTurno").hide();
					}							
				},
				error: function (data) {
					
					console.log('Error:', data);
				}
			});
		 });
	});
	

</script>
</html>