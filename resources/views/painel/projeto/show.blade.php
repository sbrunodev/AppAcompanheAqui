@extends('Painel.Template.Padrao')

@section('assets')
<link rel="stylesheet" href="{{ asset('vendor/bruno/css/projeto.css') }}">
@endsection

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/projeto/') }}"> Projetos / </a>  
	<a class="LinkNavegacao" > Gerenciamento de Projeto </a>

</div>

<div class="Conteudo">

	<header class="subTitulo" > 
		Gerenciamento de Projeto
	</header>

	<div class="FormsTables" >

		<div class="row">

			<div class="alert alert-danger print-error-msg" style="display:none">
				<ul></ul>
			</div>

			<!-- Div informações -->
			<div  class="col-md-8"> 
				<div class="form-row">
					<div class="form-group col-md-8">
						<span class="nomeCampo" >Descrição *</span>
						
						<br><span class="Informacao"> {{$Objeto->descricao}} </span>


					</div>

					<div class="form-group col-md-4">
						<span class="nomeCampo" > Tipo de Projeto</span>
						<br><span class="Informacao"> {{$Objeto->tipoprojetodescricao}} </span>

					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<span class="nomeCampo" > Data de Inicio</span>
						<br><span class="Informacao">
						{{ date("d/m/Y", strtotime($Objeto->datainicio))  }}
						</span>
					</div>

					<div class="form-group col-md-6">
						<span class="nomeCampo" > Previsão de término</span>
						<br><span class="Informacao">
						{{ date("d/m/Y", strtotime($Objeto->dataprevisao)) }}
						</span>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<span class="nomeCampo " > Observação</span>
						
					</div>


				</div>

			</div>


			<!-- Div Clientes -->
			<div class="col-md-4" style="background: "> 
	

				<table id="TabClientesAdicionados" class="table table-hover">
					<thead>
						<tr>
							<th> Clientes </th>
							
						</tr>
					</thead>
					<tbody>
						@if(isset($clientes) && count($clientes)>0)
						@foreach($clientes as $o)
						<tr>
							<td class="inf"  data-visao="v" data-addc="{{$o->idcliente}}"> {{ $o->nome }} </td>
							
						</tr>
						@endforeach
						@endif


					</tbody>
				</table>

			</div>
		</div>

	<!-- Fim, formulário projeto-->




	<!-- Mapa, Longitude e Latitude-->	
	<hr>
	<div class="ProjetoLocalizacao" >				
		<div class="TituloContainer">
			<span class="Titulo">
				<a href="#" data-toggle="tooltip" title="Clique com o botão esquerdo do mapa em cima da localidade do seu projeto" >Localização do projeto </a>  
			</span> 

			<a id="AbrirMapa" class="pull-right" href="">
				<i id="LogoLocalizacao" class="fa fa-arrow-down Icones" aria-hidden="true"></i>
			</a>

			<span id="campoLongitudeLatitude" > 

				@if(isset($Objeto->latitude) && isset($Objeto->longitude) )
				Latitude:{{$Objeto->latitude}} Longitude:{{$Objeto->longitude}}
				@endif

			</span>

		</div>

		<div id="map" ></div>

	</div>




	<!-- Fases, Fase do projeto-->
	<hr>
	<div class="ProjetoFases" >

		<div class="TituloContainer">
			<span class="Titulo">
				<a href="#" data-toggle="tooltip" title="Clique com o botão esquerdo do mapa em cima da localidade do seu projeto" > Fases do projeto </a>
			</span> 

			<a id="AbrirFase" class="pull-right" href="">
				<i id="LogoFases" class="fa fa-arrow-down Icones"  aria-hidden="true"></i>
			</a>

		

		</div>

		<div id="DivFases" ><!-- Fases -->
			
			@if(isset($fases) && count($fases)>0)
			@foreach($fases as $o)
				
				<div class="row EstiloFase" >
				<div class="pull-right"> 
				<a class="" href="" >
				<i class="icon-user glyphicon glyphicon-remove IconRemoveFase Icones"></i>
				</a>
				<a class="" href="#" >
				<i class="fa fa-share-alt Icones"></i>
				</a>
				</div>
	  			<div class="informacoes">
				<h4 class="NumeroFase"> Fase {{$o->descricaofase}} </h4> 
				<p > <b> Descrição:</b>
				<span class="DescricaoFase">{{ $o->descricao}}</span> </p>				
				<b> Situação: </b> Em andamento
						
				<br>
				<p> <a href="{{ url('/Painel/Projeto/'.$Objeto->id.'/Fase/'.$o->id) }}"> Abrir Fase </a> </p>
				</div>
				</div>


			@endforeach
			@endif

		</div>

	</div>





	
</div>
</div>





<!-- Modal -->
<!-- Adicionar Fase -->
<div class="modal fade" id="ModalAddFase" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Adicionar Fase </h4>
			</div>
			<div class="modal-body">
				
				<span> Descrição </span> 
				<input id="FaseDescricao" class="form-control CampoText" type="text" >		

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btnPadrao" data-dismiss="modal">Cancelar</button>
				<button type="button" id="btnSalvarFase" class="btn btn-success btnPadrao">Salvar</button>
			</div>
		</div>
	</div>
</div>

<!-- Pesquisar Cliente-->
<div class="modal fade" id="ModalPesquisarCliente" role="dialog" style="text-align: left;">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Pesquisar Cliente </h4>
			</div>
			<div class="modal-body">
				
				<table id="tabClientes" class="table table-hover">

					<thead>
						<th> # </th>
						<th> Nome </th>
						<th> CPF </th>
						<th> Email </th>
						<th> Ações </th>
					</thead>
					<tbody>

					</tbody>

				</table>

			</div>
			
		</div>
	</div>
</div>
<!-- -->



@endsection


@section('page-script')
<!-- Replace the value of the key parameter with your own API key. -->
<script type="text/javascript" src=" {{ asset('vendor/bruno/js/projeto.js') }} "> </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCT3fot0cfDkIbuj-HAmlSImHYtQ09Z910&callback=initMap" async defer>
</script>

<script type="text/javascript">

	var map;
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {


			@if(isset($Objeto->latitude) && isset($Objeto->longitude) )
				center: {lat: {{$Objeto->latitude}}, lng: {{$Objeto->longitude}}},
			@else 
				center: {lat: -22.303649, lng: -51.557240},
			@endif

			


			zoom: 10
		});


		google.maps.event.addListener(map,'click',function(event) {
			var LatitudeLongitude = 'Latitude:'+event.latLng.lat()+" Longitude:"+event.latLng.lng();
			document.getElementById("campoLongitudeLatitude").innerHTML = LatitudeLongitude;			
			
			document.getElementById("latitude").value = event.latLng.lat();
			document.getElementById("longitude").value = event.latLng.lng();
		});

		google.maps.event.addListener(map,'mousemove',function(event) {
            //event.latLng.lat()
            // event.latLng.lng()
        });
	}


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ready(function(){

	    // Salva e Edita o Cliente
	    $("#btnSalvar").click(function()
	    { 
	    	CarregaClientes();
	    	CarregaFases();
	    	
	    	var Url = 'http://127.0.0.1:8000/index.php/Painel/Projeto';
			//var Dados = $('#FormularioCliente').serialize();			
			var ID = $('input#ID').val();

			if(ID=='')
				Type = 'POST';
			else
			{
				//O certo é envio com PUT porém o Controller não consegue ver o FormData, então tem que enviar como POST e adicionar o Method PUT, isso ele já faz automaticamente
				Type = 'POST';
				Url  = Url += '/' + ID;				
			}


			var form = $('#Formulario')[0];
			var formData = new FormData(form);

			// Exibe os elementos do FormData
			//for(var pair of formData.entries()) { console.log(pair[0]+ ', '+ pair[1]); }

			$.ajax({

				type:Type,
				url: Url,
				dataType: false,
				data: formData,
				cache:false,
				contentType: false,
				processData: false,
				success:function(data){

					if($.isEmptyObject(data.error)){
						alert(data.success);						
						location.reload();	
						window.scrollTo(0, 0);	
					}				
					else{
						window.scrollTo(0, 0);
						ExibeError(data.error);
					}
					
				},
				error:function(e){
					alert('Ocorreu um erro !');
					console.log(e);
				},
			});		
		});


	    function ExibeError (msg) {

	    	// Exibir objeto
	    	/*var acc = []
			$.each(msg, function(index, value) {
			    acc.push(index + ': ' + value);
			});
			alert(JSON.stringify(acc));*/


	    	$(".print-error-msg").find("ul").html('');
	    	$(".print-error-msg").css('display','block');
	    	
	    	if(Array.isArray(msg))
	    	{
	    		$.each( msg, function( key, value ) {
	    			$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
	    		});
	    	}
	    	else{
	    		$(".print-error-msg").find("ul").append('<li>'+msg+'</li>');
	    	}
	    }



	});

</script>

@endsection