$(document).ready(function(){

	function LimpaForm() {
		('#eEstado').val('');
		('#eCidade').val('');
		('#eBairro').val('');
		('#eNumero').val('');
		('#eEndereco').val('');
	}

	$("#btnBuscaCEP").click(function(){	    	
		
		// eCep, eEstado, eCidade, eBairro, eNumero, eEndereco
		var cep = $('#eCep').val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") 
        {
        	//Expressão regular para validar o CEP.
        	var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) 
            {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#eEndereco").val("...");
                $("#eBairro").val("...");
                $("#eCidade").val("...");
                $("#eEstado").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(Dados) {

                   	if (!("erro" in Dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#eEndereco").val(Dados.logradouro+Dados.complemento);
                        $("#eBairro").val(Dados.bairro);
                        $("#eCidade").val(Dados.localidade);
                        $("#eEstado").val(Dados.uf);

                   } //end if.
                   else {
                        //CEP pesquisado não foi encontrado.
                        LimpaForm();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else 
            {
                LimpaForm();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else 
        {
            LimpaForm();
        }
           
	});




});