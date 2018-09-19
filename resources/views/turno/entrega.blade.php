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
	<header>
		<img src="/img/logo-analizar-web-2017.png" alt="">
	</header>

	<div>
		<div class="border-container">
			
				
				<div class="container">
					<a class="botonEntrega" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">ATENCIÓN</a>
					<div class="collapse" id="collapseExample">
						<div class="card card-body">
							<label for="inputState">Seleccione el tipo de paciente</label>
							
							
								<select name="recepcion" id="inputState" class="form-control">
									@foreach ($tipoPaciente as $item)
									    <option value="{{ $item->sigla }}"> {{ $item->nombre }} </option>
	  								@endforeach    
  								</select>
  								<input type="submit" value="Turno" id="submitrecepcion">
							
						</div>
						<div>
							
						</div>
					</div>
				</div>
				<div class="container"><a class="botonEntrega" href="#">RESULTADOS</a></div>
				<div class="container"><a class="botonEntrega" href="#">MUESTRAS PENDIENTES</a></div>
				<div class="container"><a class="botonEntrega" href="#">PREPARACION DEL PACIENTE / RECIPIENTES</a></div>
				<div class="container"><a class="botonEntrega" href="#">INFORMACIÓN</a></div>
				<div class="container"><a class="botonEntrega" href="#">BACTERIOLOGA ANALIEXPRESS</a></div>
			
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
		 $("#submitrecepcion").click(function (e) {
		 	
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			e.preventDefault(); 

			var formData = {
				recepcion: $('#inputState').val(),
			};

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/turno/entrega',
				data: formData,
				dataType: 'json',
				success: function (data) {
					console.log(data);
					alert(data);					
				},
				error: function (data) {
					alert("Turno "+data.responseText);
					console.log('Error:', data);
				}
			});
		 });
	});

</script>
</html>