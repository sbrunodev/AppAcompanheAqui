@extends('Login.Padrao')

@section ('content')
<p class="Entrar">Criar sua conta</p>

<span style="margin-bottom: 15px; color:#356BC4"> Consiga gerenciar seus projetos de uma forma simples e rápida. </span>

<p class="ErrorLogin erronome" > </p>
<input id="Nome" type="text" class="form-control Text" placeholder="Nome" name="">


<p class="ErrorLogin erroemail" > </p>
<input id="Email" type="text" class="form-control Text" placeholder="Email" name="email">

<p class="ErrorLogin errosenha" > </p>
<input id="Senha" type="password" class="form-control Text" placeholder="Senha" name="senha">

<input id="SenhaConfirmacao" type="password" class="form-control Text" placeholder="Confirmação de senha" name="">

<input id="Termo" type="checkbox" name="cb" > Aceito os <a href="#"> termos de uso </a>

<a href="#"  class="btn btn-default form-control Text btnEntrar"> Vamos lá ! </a>


@endsection

@section('page-script')

<script type="text/javascript">

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ready(function(){

		 // Salva e Edita o Cliente
	    $(".btnEntrar").click(function()
	    { 
	    	var Nome = $('#Nome').val();
			var Email = $('#Email').val();
			var Senha = $('#Senha').val();

			var Termo =  ($('#Termo').is(':checked') )?'1':'0';
				
			var Data = {
	           nome: Nome,
	           email: Email,
	           senha: Senha,
	           termo: Termo	          
	       	};

	    	var Url = 'http://127.0.0.1:8000/index.php/criacontasave';
			Type = 'POST';
			
			$.ajax({

				type:Type,
				url: Url,
				dataType: 'JSON',
				data: Data,
		
				success:function(data){
					if($.isEmptyObject(data.error)){
						window.location.href = "{{url('/login')}}";
			
							
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
		  
			$('.erroemail').html('');
			$('.erronome').html('');
			$('.errosenha').html('');

		    $.each( msg, function( key, value ) {

		    	if(value.search('email') != -1)
		    		$('.erroemail').html(value);
		    	else
		    	{
		    		if(value.search('nome') != -1)
		    			$('.erronome').html(value);
		    		else
		    		{
		    			if(value.search('senha') != -1)
		    			$('.errosenha').html(value);
		    		}
		    	}
		    	

		    });
		    
		}






	});

</script>

@endsection