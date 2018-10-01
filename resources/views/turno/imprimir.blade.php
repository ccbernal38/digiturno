<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Entrega de turnos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
		html, body{
		    width: 100%;
		    margin: 0;
		    padding: 0;
		    left: 0px;
        top: 0px;
        bottom: 0px;
        right: 0px;
		}
		
		h2{
			line-height: 1;
			margin: 0;
			font-size: 8vw;	
		}
		
		h3{
			line-height: 1;
			margin: 0;
			font-size: 8vw;
		}
		h1{
			line-height: 1;
			margin: 0;
			font-size: 60vw;
			text-align: center;
		}
		#content{
			width: 100%
		}
		@media print {
    body * { visibility: hidden; }

    #content * {
        visibility: visible;
    }
    #content {
        left: 0px;
        top: 0px;
        bottom: 0px;
        right: 0px;
        position:absolute;
        margin: 0;
        padding: 0;
    }
    div {
        page-break-before: always;
    }
}

	</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body onload="window.print(); window.close(); " style="writing-mode: vertical-lr;">
	<div id="content">
		
		<div>
			<h3>ANALIZAR LABORATORIO CLINICO</h3>
			<h3>BIENVENIDO</h3>
		</div>
		<div>
			<h2>{{$time}}</h2>
		</div>
		<div>
			<h1 style="font-weight: bold; text-align: center;">{{$turno}}</h1>
		</div>
	</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>