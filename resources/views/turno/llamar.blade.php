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
		<div class="row">
			<h3>{{ $nombre }}</h3>
			<input id="modulo" type="hidden" value="{{ $id }}">
		</div>
		<div class="row">
			<div class="offset-md-4 col-md-4">
				<div class="border-llamar">
					<h3 style="text-align: center;">Turno</h3>			
				</div>
				<div class="body-llamar">
					<h5 id="next" style="font-size: 10vw;text-align: center;"></h5>
				</div>
				<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;" type="submit" id="nextTurno" value="Llamar turno">
				<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" type="submit" id="tomaMuestra" value="Pasar a toma de muestra" >
				<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" type="submit" id="distraido" value="Distraido" >
				<input style="align-content: center; align-content: center; text-align: center;margin: 0 auto;float: none;width: 100%;display: none;" type="submit" id="finish" value="Finalizar turno">		
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
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/llamarTurno',
				dataType: 'json',
				data:{
					"id":$('#modulo').val()
				},
				success: function (data) {
					if(data.estado == 1){
						$('#next').css('font-size', '4vw');
						$('#next').text(data.turno);
					}else{
						$('#next').css('font-size', '10vw');
						$('#next').text(data.turno);
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
				url: '/distraido',
				dataType: 'json',
				success: function (data) {
					if(data.estado == 1){
						$('#next').css('font-size', '4vw');
						$('#next').text(data.turno);
					}else{
						$('#next').css('font-size', '10vw');
						$('#next').text(data.turno);
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