<!DOCTYPE html>
<html>
<head>
	<title>Acompanhe aqui</title>
	<meta charset="utf-8">

	<!-- ===== Arquivos css -->	

	<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


	<link rel="stylesheet" href="{{ asset('vendor/bruno/css/estilo.css') }}">

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
	<script type="text/javascript" src=" {{ asset('vendor/bruno/js/funcoes.js') }} "> </script>
	
	<!-- Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script>
		$(document).ready(function(){

		});
	</script>
	
</head>

<body>
	
	<header class="MenuHorizontal"  >
		<nav class="NavHorizontal"  >

			<a href="{{ url('/painel') }}">

				<div class="LogoGrande TextoBranco" > <span>Acompanhe<b>Aqui</b></span></div>
				<div class="LogoPequeno"> <strong>Aq</strong> </div>

			</a>

			<i id="btnMenuVertical" class="fa fa-arrow-right btnMenuVertical" style="font-size:20px;" aria-hidden="true"></i>

			
			<a class="Logout " href="" data-toggle="modal" data-target="#ModalLogout"> Logout  <i style="font-size:18px;" class="fa fa-sign-out"></i> </a> 

		</nav>
		
	</header>


	
	<div class="Flex">
		
		<nav class="MenuVertical"   > 

			<div class="CardUsuario" >
				
				<div class="ImagemUsuario text-center" >
					<img src="https://www.shareicon.net/data/256x256/2016/08/18/813782_people_512x512.png" class="img-circle" alt="Perfil" width="65" height="65" />					
				</div>

				<div class="InformacaoUsuario" > 
					<b class="InformacaoNome">Bruno Silva</b>  
					<span class="InformacaoEmail">bruhhnno@live.com<span> 
					</div>

				</div>

				<span class="Descricao"> Menu </span>
				
				<!-- Menu -->				

				<ul class="list-unstyled">

					<li><a href="{{ url('/painel') }}" class="Ativo"> Inicio </a></li>		

					<li ><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> Cadastro </a>
						<ul id="exampledropdownDropdown" class="collapse list-unstyled ">
							
							<li ><a href="{{ url('/painel/cliente') }}"> Cliente   </a> </li>
							<li ><a href="#"> Usuario   </a> </li>							
							<li ><a href="{{ url('/painel/tipoprojeto') }}"> Tipo Projeto   </a> </li>
							<li ><a href="{{ url('/painel/tipoconstrucao') }}"> Tipo Construção   </a> </li>
							
						</ul>
					</li>
					
					<span class="Descricao" > Funções </span>
					
					<li ><a href="{{ url('/painel/projeto') }}"> Projetos   </a> </li>
					<li ><a href="#"> Orçamentos </a> </li>
					
					
					
				</ul>
				
		</nav>
			
		<div class="Container">					
			@yield('content')					
		</div>
			
	</div>
		
		
		

		
		<!-- Modals -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">

						<h4 id="modaltitle" class="modal-title"> Titulo </h4>
						<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>


					</div>
					<div class="modal-body">
						<p id="modalconteudo" class="modal-conteudo"> Conteudo  </p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default BotaoPadrao" data-dismiss="modal">Cancelar</button>
						<button type="button" id="btnExcluir" class="btn btn-danger BotaoPadrao">Excluir</button>
					</div>
				</div>

			</div>
		</div>


		<!-- Logout -->
		<div class="modal fade" id="ModalLogout" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"> Sair </h4>
					</div>
					<div class="modal-body">
						<p  class="modal-conteudo"> Deseja realmente sair? </b> </p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default BotaoPadrao" data-dismiss="modal">Cancelar</button>
						<button type="button" id="btnmodalSair" class="btn btn-danger BotaoPadrao">Sair</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Fim Modais -->




		@yield('page-script')
		<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip();   

		    $('#btnmodalSair').click(function(){
		    	window.location.href = "{{url('/login')}}";

			return false;

		    });
		    
		});
		</script>


	</body>
	</html>