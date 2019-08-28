@extends('Painel.Template.Padrao')

@section('assets')
<link rel="stylesheet" href="{{ asset('vendor/bruno/css/projeto.css') }}">
@endsection

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/projeto/') }}"> {{$Objeto->projetodescricao or 'Projeto'}} / </a>  
	<a class="LinkNavegacao" > {{$Objeto->descricaofase}} </a>

</div>

<div class="Conteudo">

	<header class="subTitulo" > 
		Gerenciamento de Fase
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


			<div class="form-row">
				<div class="form-group col-md-2">
					<span class="nomeCampo" >Fase *</span>
					{!! Form::text('descricaofase', null, ['class' => 'form-control CampoText', 'placeholder'=>'Fase']) !!}
				</div>

				<div class="form-group col-md-10">
					<span class="nomeCampo" >Descrição *</span>
					{!! Form::text('descricao', null, ['class' => 'form-control CampoText', 'placeholder'=>'Descrição']) !!}
				</div>
			</div>
			

			<div class="form-row">
				<div class="form-group col-md-6">
					<span class="nomeCampo" > Data de Inicio</span>
					{!! Form::date('datainicio', null, ['class' => 'form-control CampoText']) !!}
				</div>

				<div class="form-group col-md-6">
					<span class="nomeCampo" > Previsão de término</span>
					{!! Form::date('dataprevisao', null, ['class' => 'form-control CampoText']) !!}
				</div>
			</div>

			<div class="form-row">
				<div class="form-row">
					<div class="form-group col-md-4">
						<span class="nomeCampo" > Situação</span>
						{!! Form::select('situacao',['1'=>'Em andamento','2'=>'Concluido','3'=>'Cancelado'], null,['class'=>'form-control CampoText']) !!}
					</div>	
				</div>

				<div class="form-group col-md-8">
					<span class="nomeCampo " > Observação</span>
					<textarea class="form-control CampoText"></textarea>
				</div>	

			</div>
		</div>
		





		<!-- Imagens, Fase do projeto-->
		<hr>
		<div class="ProjetoFases" >

			<div class="TituloContainer">
				<span class="Titulo">
					<a href="#" data-toggle="tooltip" title="Adicione as Imagens que fazem parte dessa Fase" > Imagens </a>
				</span> 
				<a id="AbrirImagem" href="" class="pull-right">
					<i id="LogoImg" class="fa fa-arrow-down Icones"  aria-hidden="true"></i>
				</a>
			</div>

			<div id="DivImagens" class="row"> <!-- Imagens --> 

				<!--
				 Bruno Aparecido da Silva
				<table id="TableImagens" class="table table-striped">
					<tbody>
						
					</tbody>
				</table>
				

				<div class="col-md-4 col-sm-6" >
					<div class="CardImagem informacoes">	
						<img class="card-img-top" src="http://www.teclasap.com.br/wp-content/uploads/2008/11/sky-x-heaven.jpg" alt="Card image cap">					
						<div class="CardDescricaoImagem" >
							<textarea class="CardTextArea" rows="4" placeholder="Descrição da imagem"></textarea>
						</div>
					</div>
				</div>
				-->

				


			</div>
			

			<span class="btn btn-default btnFile">
    			Pesquisar Imagens <input type="file" accept="image/*" name="UploadIMG" multiple class="form-control" id="UploadIMG">
			</span>
			
		</div>





		<!-- Documentos, Fase do projeto-->
		<hr>
		<div class="ProjetoFases" >

			<div class="TituloContainer">
				<span class="Titulo">
					<a href="#" data-toggle="tooltip" title="Adicione os Documentos que fazem parte dessa Fase" > Documentos </a>
				</span> 
				<a id="AbrirDocumento" href="" class="pull-right">
					<i id="LogoDoc" class="fa fa-arrow-down Icones"  aria-hidden="true"></i>
				</a>
			</div>

			<div id="DivDocumentos" class="row"> <!-- Documentos -->
				

				<!--
				<table id="TableDocumentos" class="table table-striped">
					<tbody>
																	
					</tbody>
				</table>
				

				<div class="col-md-3 col-sm-6" >
					<div class="CardFiles informacoes">
						<p class="CardTitle"> .SVG </p>
						<p>  Planta do Projeto </p>
					</div>
				</div>

				-->




			</div>



			<span class="btn btn-default btnFile">
    			Pesquisar Documentos 
    			<input type="file" name="UploadDOC" multiple class="form-control" id="UploadDOC"
    			accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf" >
			</span>

		</div>


		{!!Form::close()!!}

		<hr>
		<button id="btnSalvar" class="btn btn-success BotaoPadrao">Salvar</button>

		<!-- Modal Imagem -->
		
		<div id="shortModal" class="modal modal-wide fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						
					</div>
					<div class="modal-body">
						<img src="" style="max-width:1000px;" class="enlargeImageModalSource center-block" >
						
						<p id="ObsImagem"></p>
					</div>
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- -->

	</div>
</div>

@endsection


@section('page-script')
<!-- Replace the value of the key parameter with your own API key. -->
<script type="text/javascript" src=" {{ asset('vendor/bruno/js/projeto.js') }} "> </script>


<script type="text/javascript">

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ready(function(){

		$("#btnSalvar").click(function()
	    { 
	    	var Url = 'http://127.0.0.1:8000/index.php/painel/projeto/fase/1';

			var form = $('#Formulario')[0];
			var formData = new FormData(form);

			// Exibe os elementos do FormData
			//for(var pair of formData.entries()) { console.log(pair[0]+ ', '+ pair[1]); }

			$.ajax({

				type:'POST',
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

		function CarregaFiles()
		{
			alert('CarregaFiles');
			var separador = '';
			var Tabela = '';
			$('#DivDocumentos .informacoes').each(function(i){ 
		        // Aplica a cor de fundo 
		        Tabela += separador + $(this).find('.CardTitle').html()  +'*'+  $(this).find('.CardNameFile').html();
		        separador = '=';
		    }); 

			alert(Tabela);
		    //$('#inputfases').val(Tabela);
		}



		// Carrega a Documentos 
	    $(document).on("change", "#UploadDOC", function(e) {
	    	showDoc(this.files);
	    });

	    // Quando você adiciona o tooltip dinamicamente ele não é carregado, pois ele não faz parte do DOM inicial.
	    $(document).ready(function() {
		    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
		});


	    function showDoc(files) {
	    	var TotalArquivos = files.length;
	    	//$('#DivImagens').html('');
				
			var Acoes = getAcoes();
				    	
	    	for(var i=0; i<TotalArquivos;i++)
	    	{
	    		
  	    	 	//$($.parseHTML('<img>')).attr('src', event.target.result).appendTo('#DivImagens').width(150);
                var file = files[i];
                var fileName = file.name;
                var fileExt = '.' + fileName.split('.').pop();
                var fileName = fileName.replace(fileExt,"");

                var EstruturaImg = '';
                /*EstruturaImg = '<tr>';
         		EstruturaImg += '<td class="col-md-9">'+fileName+'</td>';	         
                EstruturaImg +=Acoes;
                EstruturaImg +='</tr>';*/

				EstruturaImg = '<div class="col-md-3 col-sm-6" >';
				EstruturaImg +=	'<div class="CardFiles informacoes">';
				EstruturaImg +=		'<p class="CardTitle"> '+fileExt.toUpperCase()+' </p>';
				EstruturaImg +=		'<p class="CardNameFile">  '+fileName+' </p>';
				EstruturaImg +=	'</div>';
				EstruturaImg +='</div>';
               
                //$(EstruturaImg).appendTo('#DivDocumentos').tooltip();
                $('#DivDocumentos').append(EstruturaImg);
	    	}
	    }


	 

	    $(document).on('click','.btnDocumentoOlho',function(e) {
		
	    	Elemento = $(this).find('i');
	    	var Visivel = false;
	    	// Está visivél?
	    	if( Elemento.hasClass('fa-eye') )
	    		Visivel = true;
	    	
	    	// Se está visivél, deixa invisivél e vice versa.
	    	var msg = "";
	    	if(Visivel)
	    	{
	    		$(Elemento).removeClass('fa-eye').addClass('fa-eye-slash');
	    		msg = "Situação: Invisivél para os clientes";
	    	}
	    	else
	    	{
	    		$(Elemento).removeClass('fa-eye-slash').addClass('fa-eye');
	    		msg = "Situação: Visivél para os clientes";
	    	}

	    	$(this).attr('title', msg).tooltip('fixTitle').tooltip('show');

	    	
	    	return false;
		});

	    
	    $(document).on("click", ".Imagem", function(e) {
		   	$('.enlargeImageModalSource').attr('src', $(this).attr('src'));

		   	//var Observacao = $(this).closest('td').next('td').html();
		   	var Observacao = $(this).closest('td').next('td').find('textarea').html();
		 
    	    $('#ObsImagem').html(Observacao);
			$('#shortModal').modal('show');
		});

		

		// Carrega a Imagem e já atualiza o Img Src
		$(document).on("change", "#UploadIMG", function(e) {
		   	showThumbnail(this.files);
		});


	    function showThumbnail(files) {
	    	var TotalArquivos = files.length;
	    	//$('#DivImagens').html('');
	    	var Acoes = getAcoes();
	    	for(var i=0; i<TotalArquivos;i++)
	    	{
		    		
  	    	 	var reader = new FileReader();
                reader.onload = function(event) {       

                    var EstruturaImg = '';	
                    /*
					EstruturaImg = '<div>';
	         		
		         		EstruturaImg += '<td class="col-md-2 " >';	         
		                EstruturaImg +=	'<img id="thumbnail'+i+'"';
						EstruturaImg +=	'src = "'+event.target.result+'"' ;
						EstruturaImg +=	'class="img-responsive Imagem" alt="Imagem'+i+' " width="100"/>	' ;
		         		EstruturaImg +='</td>';

		         		EstruturaImg +='<td class="col-md-7" >';
		         		EstruturaImg +='<p><span class="nomeCampo " > Observação</span></p><textarea class="form-control CampoText"></textarea>';
		         		EstruturaImg +='</td>';



		                EstruturaImg +=Acoes;
	                EstruturaImg +='</div>';
	               */
	               
	                
	                
	                EstruturaImg += '<div class="col-md-3 col-sm-6" >';
					EstruturaImg += '	<div class="CardImagem informacoes">';	
					EstruturaImg += '		<img class="img-responsive center-block Imagem"  src="'+event.target.result+'" >	';				
					EstruturaImg += '		<div class="CardDescricaoImagem" >';
					EstruturaImg += '			<textarea class="CardTextArea" rows="6" placeholder="Descrição da imagem"></textarea>';
					EstruturaImg += '		</div>';
					EstruturaImg += '	</div>';
					EstruturaImg += '</div>';

					$('#DivImagens').append(EstruturaImg);
					
					
	                //$(EstruturaImg).appendTo('#DivImagens').tooltip();
	                //$('#DivImagens').prepend($('<div> new div </div>'));
                }

                reader.readAsDataURL(files[i]);
		    	
	    	}

	    }

	    function getAcoes(){
	    	Acoes=  '<td class="col-md-2 Acoes" >';
			Acoes+=	    '<a class="btnDocumentoOlho" href="#" data-toggle="tooltip" title="Situação: Visivél para os Clientes" >';
			Acoes+=			'<i id="IconOlho" class="fa fa-eye" aria-hidden="true"></i>';
			Acoes+=		'</a>';
			Acoes+=		'<a class="btnDocumentoLixo" href="#" data-toggle="tooltip" title="Deseja excluir arquivo?">';
			Acoes+=			'<i id="IconLixo" class="fa fa-trash-o" aria-hidden="true"></i>';
			Acoes+=		'</a>';
			Acoes+=		'<a class="btnDocumentoDownload" href="#" data-toggle="tooltip" title="Download do Documento">';
			Acoes+=				'<i id="IconDownload" class="fa fa-download" aria-hidden="true"></i>';
			Acoes+=		'</a>';
			Acoes+=	'</td>';
			return Acoes;
	    }

	});

</script>

@endsection