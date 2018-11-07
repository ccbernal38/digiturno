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
	<header class="row">
		<div class="col-md-3">
			<img src="/img/logo-analizar-web-2017.png" alt="">
		</div>
		<div class="col-md-7" style="margin: auto">
			<ul class="nav nav-pills">
				<li class="nav-item">
					<a class="nav-link active" href="/create/role">Crear rol</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="/create/user">Crear Usuario</a>
				</li>
				
			</ul>
		</div>
	</header>

	<div class="form-group">
		<h1 style="text-align: center;width: 100%; font-weight: bold;">Registro de rol</h1>
	</div>
	<div>
		<div class="border-container">
			<div class="container" style="background-color: white;">
				<form action="/create/role" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label for="role_name">Rol:</label>
						<input type="text" id="role_name" name="role_name" class="form-control" aria-describedby="role_name" placeholder="Ingrese el nombre del rol">
					</div>
					<div class="form-group">
						<label for="role_description">Descripción:</label>
						<input type="text" id="role_description" name="role_description" class="form-control" aria-describedby="role_description" placeholder="Ingrese la descripción del rol">
					</div>
					<button type="submit" class="btn btn-primary">Registrar</button>
				</form>
				@if (isset($tipo))
					@if ($tipo == 0)
						<div class="alert alert-primary" role="alert">
							{{ $mensaje }}
						</div>
					@else 
						<div class="alert alert-danger" role="alert">
							{{$mensaje}}
						</div>
					@endif
					
				@endif

			</div>
		</div>
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>