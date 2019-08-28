$(document).ready(function(){
	
	LinhaContato  = "";
	LinhaEndereco = "";
	Alterar = false;

	function AbreModal(titulo, conteudo) {

		$("#myModal").modal('show');

		$("#modaltitle").text(titulo);
		$("#modalconteudo").html(conteudo);
	}

	$("#btnExcluir").click(function(){
		
		$("#myModal").modal('hide');
		//
		//$('body').removeClass('modal-open');
		//$('.modal-backdrop').remove();	

		var Linha;
		if(LinhaContato!="")
		{
			//alert('É contato AJAX');
			Linha = LinhaContato;
			LinhaContato = "";
		}
		else
		{
			//alert('É endereço AJAX');
			Linha = LinhaEndereco;
			LinhaEndereco = "";
		}

		Linha.fadeOut(400, function() {		      
			Linha.remove();  		    
		});		

	});


	
	$('#AbrirModalContato').click(function(){
		$('#ModalContato').appendTo("body").modal('show');
		return false; 
	});

	$('#AbrirModalEndereco').click(function(){
		$('#ModalEndereco').appendTo("body").modal('show');
		return false; 
	});

	// Contato //

	$('#AddTableContato').click(function(){

		var celular = $('#contatoCelular').val();
		var telefone = $('#contatoTelefone').val();
		var email = $('#contatoEmail').val();

		if(celular=="" && telefone=="" && email=="")
			alert('É necessario informa ao menos um item: Celular, Telefone ou Email');
		else
		{
			// Altera coluna existente
			if(Alterar)
			{
				Linha = LinhaContato;
				var Posicao = 1;
				// 1 = Id, 2 = Celular, 3 = Telefone, 4 = Email, 5,6 ... Buttons
				Linha.find('td').each(function(){

					switch(Posicao)
					{
						case 2: $(this).text(celular) ;  $(this).data('celular',celular)   ;break;
						case 3: $(this).text(telefone);  $(this).data('telefone',telefone) ;break;
						case 4: $(this).text(email)   ;  $(this).data('email',email)       ;break;
					}
					Posicao++;

				});
			}
			else
			{
				// Cria nova coluna
				var newRow = $("<tr>");		    
				var cols = "";		

				

				cols += '<td class="inf" data-codigo   ="#"          >#</td>'; // Id
			    cols += '<td class="inf" data-celular  ='+celular+'  >'+celular+ '</td>'; // Celular	    
			    cols += '<td class="inf" data-telefone ='+telefone+' >'+telefone+'</td>'; // Telefone		    
			    cols += '<td class="inf" data-email    ='+email+'    >'+email+   '</td>'; // Email
			    cols += '<td>';		    
			    cols+=	'<a class="btnRemoverContato btnPadraoTabela" href="#">  Remover </a>'
			    cols+=	'<a class="btnAlterarContato btnPadraoTabela" href="#">  Alterar </a>'
			    cols += '</td>';	

			    newRow.append(cols);		    
			    $("#contatos").append(newRow);
			}
			
			//Limpa campo
			$('#contatoCelular').val('');
			$('#contatoTelefone').val('');
			$('#contatoEmail').val('');	 

			$("#ModalContato").modal('hide');
			// Antes era só utilizar o modal hide que a tela já se limpava por completo, agora tenho que usar 
			// as seguintes instruções
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();  

			Alterar = false;
			LinhaContato = false;
		}
		return false;	
	});



	$(document).on('click','.btnAlterarContato',function() {

		var Linha = $(this).closest('tr');
		$(Linha).find('td[data-codigo]').data('codigo');

		// Recupera dados
		var Codigo   = $(Linha).find('td[data-codigo]').data('codigo');
		var Celular  = $(Linha).find('td[data-celular]').data('celular');
		var Telefone = $(Linha).find('td[data-telefone]').data('telefone');
		var Email    = $(Linha).find('td[data-email]').data('email');

	
	 	// Abre modal
	 	$('#ModalContato').modal('show');

	 	// Carrega informações
	 	$('#contatoCelular').val(Celular);
	 	$('#contatoTelefone').val(Telefone);
	 	$('#contatoEmail').val(Email);

	 	Alterar = true;
	 	LinhaContato = Linha;
	 	return false;
	 });



	$(document).on('click', '.btnRemoverContato', function(e) {	

		var Linha = $(this).closest('tr');

		// Recupera elementos que fazem parte da linha:
		var Codigo   = $(Linha).find('td[data-codigo]').data('codigo');
		var Celular  = $(Linha).find('td[data-celular]').data('celular');
		var Telefone = $(Linha).find('td[data-telefone]').data('telefone');
		var Email    = $(Linha).find('td[data-email]').data('email');

		var msg = 'Não informado.';
		if(Codigo==''   || typeof Codigo == 'undefined')   Codigo = msg;
		if(Celular==''  || typeof Celular == 'undefined')  Celular = msg;
		if(Telefone=='' || typeof Telefone == 'undefined') Telefone = msg;
		if(Email==''    || typeof Email == 'undefined')    Email = msg;

		var Exibe = '';
		Exibe =  "<p> <b>Código:</b> " +Codigo+ "</p>"     ;
		Exibe += "<p> <b>Celular:</b> " +Celular+ "</p>"   ;
		Exibe += "<p> <b>Telefone:</b> " +Telefone+ "</p>" ;
		Exibe += "<p> <b>Email:</b> " +Email+ "</p>"       ;

		LinhaContato = Linha;
		LinhaEndereco = "";

		AbreModal('Deseja realmente excluir esse Contato?',Exibe);

		return false;
	});






    // Endereco

    $('#AddTableEndereco').click(function(){
		// eCep, eEstado, eCidade, eBairro, eNumero, eEndereco
		var Cep      = $('#eCep').val();
		var Estado   = $('#eEstado').val();
		var Cidade   = $('#eCidade').val();
		var Bairro   = $('#eBairro').val();
		var Numero   = $('#eNumero').val();
		var Endereco = $('#eEndereco').val();

		if(Cep=="" && Cidade =="" && Estado=="")
			alert('É necessario informar o CEP, Cidade e Estado');
		else
		{
			if(Alterar)
			{
				Linha = LinhaEndereco;
				var Posicao = 1;
				// 1 = Id, 2 = Cep, 3 = Estado, 4 = Cidade, 5 = Bairro, 6 = Numero, 7 = Endereço ... Buttons
				Linha.find('td').each(function(){

					switch(Posicao)
					{
						case 2: $(this).text(Cep) ;  $(this).data('cep',Cep)  ;break;
						case 3: $(this).text(Estado);  $(this).data('estado',Estado)  ;break;
						case 4: $(this).text(Cidade)   ;  $(this).data('cidade',Cidade)  ;break;
						case 5: $(this).text(Bairro)   ;  $(this).data('bairro',Bairro)  ;break;
						case 6: $(this).text(Numero)   ;  $(this).data('numero',Numero)  ;break;
						case 7: $(this).text(Endereco)   ;  $(this).data('endereco',Endereco)  ;break;
					}
					Posicao++;

				});
			}
			else
			{
				// Cria nova coluna
				var newRow = $("<tr>");		    
				var cols = "";		

				cols += '<td class="inf" data-codigo   ="#"         > #           </td>';  // Id
			    cols += '<td class="inf" data-cep      ='+Cep+'     > '+Cep+     '</td>'; // Celular	    
			    cols += '<td class="inf" data-estado   ='+Estado+'  > '+Estado+  '</td>'; // Telefone		    
			    cols += '<td class="inf" data-cidade   ='+Cidade+'  > '+Cidade+  '</td>'; // Email
			    cols += '<td class="inf" data-bairro   ='+Bairro+'  > '+Bairro+  '</td>'; // Email
			    cols += '<td class="inf" data-numero   ='+Numero+'  > '+Numero+  '</td>'; // Email
			    cols += '<td class="inf" data-endereco ='+Endereco+'> '+Endereco+'</td>'; // Email
			    
			    cols += '<td>';		    
			    cols+=	'<a class="btnRemoverEndereco btnPadraoTabela"  href="" > Remover </a>'
			    cols+=	'<a class="btnAlterarEndereco btnPadraoTabela" href="">   Alterar </a>'		    
			    cols += '</td>';	

			    newRow.append(cols);		    
			    $("#enderecos").append(newRow);
			}
			

		    //Limpa campo
		    Cep      = $('#eCep').val('');
		    Estado   = $('#eEstado').val('');
		    Cidade   = $('#eCidade').val('');
		    Bairro   = $('#eBairro').val('');
		    Numero   = $('#eNumero').val('');
		    Endereco = $('#eEndereco').val('');

		    $("#ModalEndereco").modal('hide');
			//
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();  

			Alterar = false;
			LinhaContato = false;

		}

		return false;
	});



    $(document).on('click', '.btnAlterarEndereco', function() {

    	var Linha = $(this).closest('tr');

		// Recupera dados
		var Codigo   = $(Linha).find('td[data-codigo]').data('codigo');
		var Cep      = $(Linha).find('td[data-cep]').data('cep');
		var Estado   = $(Linha).find('td[data-estado]').data('estado');
		var Cidade   = $(Linha).find('td[data-cidade]').data('cidade');
		var Bairro   = $(Linha).find('td[data-bairro]').data('bairro');
		var Numero   = $(Linha).find('td[data-numero]').data('numero');
		var Endereco = $(Linha).find('td[data-endereco]').data('endereco');

	 	// Abre modal
	 	$('#ModalEndereco').modal('show');

	 	// Carrega informações
	 	$('#eCep').val(Cep);
	 	$('#eEstado').val(Estado);
	 	$('#eCidade').val(Cidade);
	 	$('#eBairro').val(Bairro);
	 	$('#eNumero').val(Numero);
	 	$('#eEndereco').val(Endereco);


	 	Alterar = true;
	 	LinhaEndereco = Linha;
	 	return false;
	 });



	// função para remover da tabela de endereço
	$(document).on('click', '.btnRemoverEndereco', function(e) {
		e.preventDefault;

        // eCep, eEstado, eCidade, eBairro, eNumero, eEndereco       
        var Linha = $(this).closest('tr');

		// Recupera elementos que fazem parte da linha:
		var Codigo   = $(Linha).find('td[data-codigo]').data('codigo');
		var Cep      = $(Linha).find('td[data-cep]').data('cep');
		var Estado   = $(Linha).find('td[data-estado]').data('estado');
		var Cidade   = $(Linha).find('td[data-cidade]').data('cidade');
		var Bairro   = $(Linha).find('td[data-bairro]').data('bairro');
		var Numero   = $(Linha).find('td[data-numero]').data('numero');
		var Endereco = $(Linha).find('td[data-endereco]').data('endereco');

		var msg = 'Não informado.';
		if(Codigo=='' || typeof Codigo == 'undefined') Codigo = msg;
		if(Cep==''    || typeof Cep == 'undefined'   ) Cep =    msg;
		if(Estado=='' || typeof Estado == 'undefined') Estado = msg;
		if(Cidade=='' || typeof Cidade == 'undefined') Cidade = msg;
		if(Bairro=='' || typeof Bairro == 'undefined') Bairro = msg;
		if(Numero=='' || typeof Numero == 'undefined') Numero = msg;
		if(Endereco=='' || typeof Endereco == 'undefined') Endereco = msg;

		var Exibe = '';
		Exibe =  "<p> <b>Código:  </b> " +Codigo+ "</p>" ;
		Exibe += "<p> <b>Cep: </b> " +Cep+ "</p>"    ;
		Exibe += "<p> <b>Estado:</b> " +Estado+ "</p>" ;
		Exibe += "<p> <b>Cidade:</b> " +Cidade+ "</p>"    ;
		Exibe += "<p> <b>Bairro:</b> " +Bairro+ "</p>"    ;
		Exibe += "<p> <b>Número:</b> " +Numero+ "</p>"    ;	 	
		Exibe += "<p> <b>Endereço:</b> " +Endereco+ "</p>"  ;

		LinhaContato  = "";
		LinhaEndereco = Linha;

		AbreModal('Deseja realmente excluir esse Endereço?',Exibe);

		return false;
	});


});

// Carrega as informações
function CarregaContatos() {

	// Serializa tabela para passar junto com o formulário
	TabelaContatos = $("#contatos").serialize();

	var separador = '';
	$('#contatos').find('.inf').each(function(){
		// Caso ocorra erros por conta do @ é só utilizar o encodeURIComponent($(this).text())
		TabelaContatos += separador+ ($(this).text()).trim() ;
		separador = '=';
	});

	TabelaContatos.replace(' ','');
	$('#inputcontatos').val(TabelaContatos);
}


function CarregaEnderecos() {

	// Serializa tabela para passar junto com o formulário
	TabelaEnderecos = $("#enderecos").serialize();

	var separador = '';
	$('#enderecos').find('.inf').each(function(){
		// Caso ocorra erros por conta do @ é só utilizar o encodeURIComponent($(this).text())
		TabelaEnderecos += separador + ($(this).text()).trim() ;
		separador = '=';
	});

	
	$('#inputenderecos').val(TabelaEnderecos);
}