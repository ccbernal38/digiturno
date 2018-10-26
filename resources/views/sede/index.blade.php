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
<body style="background-color: white;">
	<header>
		<img src="/img/logo-analizar-web-2017.png" alt="">
	</header>

	<div>
		<div class="border-container">
			<div class="container" style="background-color: white;">
				<a class="botonEntrega" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"></a>
				<div class="card card-body">
					<label for="inputState">Sede:</label>							
					<select name="recepcion" id="inputState" class="form-control selector-sede">
							<option value="-1"></option>
						@foreach ($sedes as $item)
						    <option value="{{ $item->id }}"> {{ $item->nombre }} </option>
							@endforeach    
					</select>							
				</div>
			</div>
			<div class="container" style="background-color: white;">
				<a class="botonEntrega" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"></a>
				<div class="card card-body">
					<label for="inputState">Modulo:</label>							
					<select name="recepcion" id="inputState" class="form-control selector-modulo">
							<option value="-1"></option>

					</select>							
				</div>
			</div>
			<div class="container" style="background-color: white;">
				<a class="botonEntrega" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"></a>
				<div class="card card-body">
					<label for="recepcionInput">Recepcionista:</label>							
					<input id="recepcionInput" type="text" class="form-control" placeholder="Ingrese su nombre">							
					<input type="submit" class="btn btn-primary" id="entrar" value="Entrar" style="margin: auto;margin-top: 20px;">
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
		$('#entrar').click(function(event) {
			if ($('#recepcionInput').val() != "") {
				if($(".selector-modulo").val() != -1){
					if($(".selector-modulo option:selected").text() == "Administracion"){
						window.location="/admin/turnos";	
					}
					else if($(".selector-modulo").val() == 21){
						window.location="/turno/"+$(".selector-modulo").val()+"/"+encodeURI($('#recepcionInput').val());	
					}else{
						window.location="/llamar/"+$(".selector-modulo").val()+"/"+encodeURI($('#recepcionInput').val());		
					}				
				}else{
					alert("Debe seleccionar un modulo");
				}
			}else{
				alert("Debe ingresar su nombre antes de continuar");
			}
		});

		$(".selector-sede").change(function() {
			$(".selector-modulo").empty();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/sede/modulos',
				dataType: 'json',
				data:{
					"id_sede": $('.selector-sede').val()
				},
				success: function (data) {
					console.log(data);
					$(".selector-modulo").append('<option value="-1">Seleccione un modulo</option>');
					$.each(data, function(id,value){
						console.log(id+" "+value);
						$(".selector-modulo").append('<option value="'+value.id+'">'+value.nombre+'</option>');
					});
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
	});

</script>
</html>