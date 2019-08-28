@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/cliente/') }}"> Clientes / </a>  
	<a class="LinkNavegacao" > Cliente </a>

</div>

<div class="Conteudo EspacoBottom" >

	<header class="subTitulo" > 
		Gerenciamento de Cliente
	</header>

	<div class="FormsTables" >

		<!-- Conteudo -->				
		@if( isset($Objeto) )
		{!! Form::model($Objeto, ['id'=>'Formulario','class' => 'form', 'method' => 'put' ])  !!}
		@else
		{!! Form::open(['id'=>'Formulario','class'=>'form']) !!}
		@endif
		{!! csrf_field() !!}
		{!! Form::hidden('id', null,['id'=>'ID']) !!}
		<div class="row">

			<div class="alert alert-danger print-error-msg" style="display:none">
				<ul></ul>
			</div>

			<!-- Div informações -->
			<div  class="col-lg-9"> 
				<div class="form-row">
					<div class="form-group col-md-8">
						<span class="nomeCampo" >Nome Completo *</span>
						{!! Form::text('nome', null, ['class' => 'form-control CampoText', 'placeholder'=>'Nome']) !!}
					</div>

					<div class="form-group col-md-4">
						<span class="nomeCampo" >Apelido</span>
						{!! Form::text('apelido', null, ['class' => 'form-control CampoText', 'placeholder'=>'Apelido']) !!}
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-4">
						<span class="nomeCampo" >CPF</span>
						{!! Form::text('cpf', null, [ 'id'=>'cpf', 'class' => 'form-control CampoText', 'placeholder'=>'CPF']) !!}
					</div>

					<div class="form-group col-md-4">
						<span class="nomeCampo" > Data de Nascimento</span>
						{!! Form::date('datanascimento', null, ['class' => 'form-control CampoText', 'placeholder'=>'Data de Nascimento']) !!}
					</div>

					<div class="form-group col-md-4">
						<span class="nomeCampo" >Sexo</span>
						{!! Form::select('sexo',$sexo, null, ['class'=>'form-control CampoText']) !!}
					</div>
				</div>





				<div class="form-group col-md-12 form-inline">
		

					{!! Form::checkbox('status', 1, null, ['class'=>'form-check-input CampoCheck Cheked']) !!}

					<label class="form-check-label" for="gridCheck">
						Ativo? 
					</label>


				</div>


				<div class="form-row" id="divClienteLogin" >
					<div class="form-group col-md-12">
						<span class="nomeCampo" >Email *</span>
						{!! Form::text('email', null, ['class' => 'form-control CampoText', 'placeholder'=>'Email']) !!}
					</div>


				</div>

				<input type="hidden" name="inputcontatos" id='inputcontatos' value="">	
				<input type="hidden" name="inputenderecos" id='inputenderecos' value="">

			</div>

			<!-- Div foto -->
			<div class="col-lg-3"> 
				<span class="nomeCampo" >Foto</span><br/>
				<img id="thumbnail"

				@if( isset($Objeto->foto) ) 
					src = "{{asset('storage/clientes/'.$Objeto->foto )}}"
				@else
					src = "http://localhost/Projetos-Laravel/WebServiceAppFollow/public/imgClientePadrao"
				@endif

				class="img-circle img-responsive center-block" alt="Imagem Perfil" width="150"></img>


				<input type="file" name="UploadIMG" class="form-control" id="UploadIMG">
			</div>
		</div>
	</form>

	@include('Painel/Pacote/contato')

	@include('Painel/Pacote/endereco')			
	<hr>

	<button id="btnSalvar" class="btn btn-success BotaoPadrao">Salvar</button>

</div>
</div>

@endsection


@section('page-script')
<script src="{{asset('vendor/bruno/js/buscacep.js')}}"></script>
<script src="{{asset('vendor/bruno/js/contatoendereco.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

<script type="text/javascript">

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ready(function(){
		
		// Seta mascara
		$("#cpf").mask('000.000.000-00', {reverse: true});      
		$("#contatoCelular").mask('(00) 00000-0000', {reverse: false}); 
		$("#contatoTelefone").mask('(00) 00000-0000', {reverse: false});        
		$("#eCep").mask('00000-000',{reverse:false});
	    //$("#FormularioCliente :input").prop("disabled", true);





	    // Carrega a Imagem e já atualiza o Img Src
	    $(document).on("change", "#UploadIMG", function(e) {
	    	showThumbnail(this.files);
	    });


	    function showThumbnail(files) {
	    	if (files && files[0]) 
	    	{
	    		var reader = new FileReader();
	    		reader.onload = function (e) {
	    			$('#thumbnail').attr('src', e.target.result);
	    		}
	    		reader.readAsDataURL(files[0]);
	    	}
	    }



	    // Salva e Edita o Cliente
	    $("#btnSalvar").click(function()
	    { 
	    	var Url = 'http://127.0.0.1:8000/index.php/painel/cliente';

	    	CarregaContatos();
	    	CarregaEnderecos();

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