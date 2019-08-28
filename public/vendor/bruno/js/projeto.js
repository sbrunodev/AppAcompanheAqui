$(document).ready(function(){


	$('#AbrirMapa').click(function(){

		var Visivel  = $('#map').is(':visible');
		
		if (Visivel)
		{
			$('#LogoLocalizacao').removeClass("fa-arrow-down").addClass("fa-arrow-up");
			$('#map').hide(0);
		}
		else 
		{
			$('#LogoLocalizacao').removeClass("fa-arrow-up").addClass("fa-arrow-down");
			$('#map').show(0);
		}

		return false;
	});

	$(document).on('click','.IconRemoveFase', function(e){
		return false;
	});

	


	$('#AbrirFase').click(function(){
		
		var Visivel  = $('#DivFases').is(':visible');
		
		if (Visivel)
		{
			$('#LogoFases').removeClass("fa-arrow-down").addClass("fa-arrow-up");
			$('#DivFases').hide(0);
		}
		else 
		{
			$('#LogoFases').removeClass("fa-arrow-up").addClass("fa-arrow-down");
			$('#DivFases').show(0);
		}

		return false;
	});



	$('#AbrirImagem').click(function(){
		
		var Visivel  = $('#DivImagens').is(':visible');
		
		if (Visivel)
		{
			$('#LogoImg').removeClass("fa-arrow-down").addClass("fa-arrow-up");
			$('#DivImagens').hide(0);
		}
		else 
		{
			$('#LogoImg').removeClass("fa-arrow-up").addClass("fa-arrow-down");
			$('#DivImagens').show(0);
		}

		return false;
	});



	$('#AbrirDocumento').click(function(){
		
		var Visivel  = $('#DivDocumentos').is(':visible');
		
		if (Visivel)
		{
			$('#LogoDoc').removeClass("fa-arrow-down").addClass("fa-arrow-up");
			$('#DivDocumentos').hide(0);
		}
		else 
		{
			$('#LogoDoc').removeClass("fa-arrow-up").addClass("fa-arrow-down");
			$('#DivDocumentos').show(0);
		}

		return false;
	});



	$('#btnAdicionarFase').click(function(){

		$('#ModalAddFase').appendTo("body").modal('show');
		return false;
	});





	$('#btnSalvarFase').click(function(){
	
		var Div='';

		var Descricao = $('#FaseDescricao').val();
	
		if(Descricao=="")
			alert('A descrição é um campo obrigátorio');
		else
		{
			var NroFase = $('div.Card').filter(function(idx){
	        	return $(this).text() != ""
	    	}).length;

			Div+='<div class="col-md-4 col-sm-6" >';
			Div+='	<div class="Card informacoes">';
			Div+='	<span class="CardTitle NumeroFase">Fase '+(NroFase+1)+'</span>';
			Div+='	<p class="DescricaoFase">'+ Descricao+' </p>';
			Div+='	<p>Situação: Em andamento</p>';
			Div+='	<br>';
			Div+='	<a href="#" class="pull-right CardMessage text-nowrap" >abrir Fase</a>';

			Div+='	</div>';
			Div+='</div>';


										

			$('#DivFases').append(Div);

			$("#ModalAddFase").modal('hide');
			
			$('#FaseDescricao').val('');
		}

	
		return false;

	});



	// ----- Pesquisar Clientes
	$('#PesquisarCliente').click(function(){
		$('#ModalPesquisarCliente').modal('show');

		var Linhas = $('#tabClientes >tbody >tr').length; 

		if(Linhas==0)
			RecuperaClientes();
		
		return false;
	});


	// Salva e Edita o Cliente
	function RecuperaClientes()
	{ 
		
		var Url = 'http://127.0.0.1:8000/index.php/painel/cliente/getclientes/1';

		$.ajax({

			type:'GET',
			url: Url,
			data: 'JSON',
			success:function(data){
				ExibeClientes(data);
			},
			error:function(e){
				alert('Ocorreu um erro !');
				console.log(e);
			},
		});

	}


	$(document).on("click", "#tabClientes tbody tr", function(e) {
		
		var data = { nome: '', id: '' };

		$(this).css('background','#57E451');

		$(this).children('td').each(function() {

			var nome = $(this).data('nomec');
			if (nome) {
				data.nome = nome;
			}

			var id = $(this).data('idc');
			if (id) {
				data.id = id;
			}      
		});

		AdicionarCliente(data);
	});

	function ExibeClientes (Clientes) {
		
		$("#tabClientes td").remove();

		$.each( Clientes, function( key, value ) {
    				// Cria nova coluna
    		var newRow = $("<tr>");		    
    		var cols = "";		

			cols += '<td class="inf idcliente" data-idc ='+value.id+  '>'+ value.id+   '</td>'; 
			cols += '<td class="inf" data-nomec   ='+value.nome+'>'+ value.nome+ '</td>'; 

			//var APP_URL = {!! json_encode(url('/')) !!}
			    
			var Caminho = '';//APP_URL+'/painel/clientes/'+value.id+'/edit'; 

			if(value.cpf==null)
			   	value.cpf = 'CPF não informado';
			if(value.email==null)
			   	value.email = 'Email não informado';

			cols += '<td class="inf" data-cpfc      ='+value.cpf+'>'      + value.cpf+       '</td>';
			cols += '<td class="inf" data-emailc    ='+value.email+'>'      + value.email+       '</td>'; 		    

			cols += '<td>';		    
			cols += '<a class="btnRemoverContato btnPadraoTabela" href="" > Selecionar </a>';	
			cols += '<a class="btnRemoverContato btnPadraoTabela" href="'+Caminho+'" target="_blank" > Detalhar </a>';			    
			cols += '</td>';	

			newRow.append(cols);		    
			$("#tabClientes").append(newRow);
		});
	}

	function AdicionarCliente(Cliente){
		
		var newRow = $("<tr>");		    
		var cols = "";		
		//var APP_URL = {!! json_encode(url('/')) !!}
		var Caminho = '';//APP_URL+'/painel/clientes/'+value.id+'/edit'; 
		
		cols += '<td class="inf"  data-visao="v" data-addc    ='+Cliente.id+'>'      + Cliente.nome+       '</td>';	    
		cols += '<td >';		    
		cols += '<a class="btnRemoverContato btnPadraoTabela "   href="" > <i class="fa fa-eye Icones" aria-hidden="true" style="font-size: 20px;"></i> </a>';			    
		cols += '<a class="btnRemoverContato btnPadraoTabela " href="" > Detalhar </a>';	
		cols += '</td>';	

		newRow.append(cols);		    
		$("#TabClientesAdicionados").append(newRow);
	}




});



function CarregaFases()
{
	var separador = '';
	var Tabela = '';
	$('#DivFases .informacoes').each(function(i){ 
        // Aplica a cor de fundo 
        Tabela += separador + $(this).find('.NumeroFase').html()  +'descript:'+  $(this).find('.DescricaoFase').html()  ;
        separador = '=';
    }); 

    $('#inputfases').val(Tabela);
}

function CarregaClientes() {

	// Serializa tabela para passar junto com o formulário
	Tabela = $("#TabClientesAdicionados").serialize();

	var separador = '';
	$('#TabClientesAdicionados').find('.inf').each(function(){
		// Caso ocorra erros por conta do @ é só utilizar o encodeURIComponent($(this).text())
		Tabela += separador + $(this).data('addc') + 'visao' +$(this).data('visao') ;
		
		separador = '=';
	});

	$('#inputclientes').val(Tabela);
}