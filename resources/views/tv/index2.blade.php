<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Entrega de turnos</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css" rel="stylesheet" />

</head>
<body>
<!--
	#################################
		- THEMEPUNCH BANNER -
	#################################
	-->
	 <div id="carousel-top" class="carousel slide-video slide  video-responsive carousel-banner" data-ride="carousel">
                <!-- Indicators -->
                <ol class="hidden carousel-indicators" style="display:none">
                    <li data-target="#carousel-top" data-slide-to="0" class=""></li>
                    <li class="" data-target="#carousel-top" data-slide-to="1"></li>
                    <li class="active" data-target="#carousel-top" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img src="img/banner-movil/bienvenido.jpg" >
                    </div>
                    <div class="item hide-on-mobile">
                        <video id="videoBanner" muted loop width="100%">
                               <source src="/upload/4.mp4" type='video/mp4' />
                        </video>
                    </div>
                    <div class="item hide-on-desktop">
                        <img src="img/banner-movil/multimodal.jpg" >
                    </div>
                    <div class="item hide-on-desktop">
                        <img src="img/banner-movil/servicioaereo.jpg" >
                    </div>

                    <div class="item hide-on-desktop">
                        <img src="img/banner-movil/UchuvasExportación.jpg" >
                    </div>


                </div>

                   <!-- Controls -->
                <a class=" left carousel-control" href="#carousel-top" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class=" right carousel-control" href="#carousel-top" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"></script>
	<script type="text/javascript">

                var revapi;

                jQuery(document).ready(function () {

                    revapi = jQuery('.tp-banner').revolution(
                            {
                                delay: 5000,
                                startwidth: 1170,
                                startheight: 700,
                                hideThumbs: 10,
                                fullWidth: "on",
                                hideCaptionAtLimit: 920,
                                forceFullWidth: "on"
                            });
			</script>
</body>
</html>