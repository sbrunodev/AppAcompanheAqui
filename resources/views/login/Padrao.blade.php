<!DOCTYPE html>
<html>
<head>
	<title>Acompanhe aqui</title>
	<meta charset="utf-8">

	<!-- ===== Arquivos css -->	

	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


	<link rel="stylesheet" href="{{ asset('vendor/bruno/css/estilo.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/bruno/css/login.css') }}">

	<!-- ===== Fontes -->
	<link rel="stylesheet" href=" {{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<!-- Google fonts - Poppins -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">

	@yield('assets')

	<!-- ===== Arquivos js -->		
	<script type="text/javascript" src=" {{ asset('vendor/jquery/js/jquery-3.2.1.min.js') }} "> </script>
	<script type="text/javascript" src=" {{ asset('vendor/bootstrap/js/bootstrap.min.js') }} " > </script>

	<script type="text/javascript" src=" {{ asset('vendor/jquery/js/jquery-3.2.1.min.js') }} "> </script>
	<script type="text/javascript" src=" {{ asset('vendor/bootstrap/js/bootstrap.min.js') }} " > </script>

	
	<!-- Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script>
		$(document).ready(function(){

		});
	</script>
	
</head>

<body>


	<div class="Exterior">
		<div class="Meio">
			<div class="Interior">

				<p class="Titulo"> Acompanhe <b> Aqui </b> </p>


				@yield('content')


			</div>
		</div>
	</div>

		@yield('page-script')
		<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   
		});
		</script>

</body>
</html>