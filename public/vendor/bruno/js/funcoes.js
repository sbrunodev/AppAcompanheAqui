
// ===== Arquivo de funções Js ===== // 

$(document).ready(function(){
	
	var Op=0;
	
	$('#btnMenuVertical').click(function(){
		
		//alert('Hello');
		var Tamanho = $('.MenuVertical').width();
		var TamanhoWindow = $(window).width();
		
		// Tablet/Mobile
		if(TamanhoWindow < 1000)
		{
			$('.MenuVertical').css( "flex", "0 0 100px" );	
			$('.ImagemUsuario').css( "width", "100%" );	
			if( $(".MenuVertical").css('display') == 'none') {
				
				$('.MenuVertical').css( "display", "block" );	
				$('#btnMenuVertical').removeClass("fa-arrow-right").addClass("fa-arrow-left");
			}
			else
			{
				$('.MenuVertical').css( "display", "none" );
				$('#btnMenuVertical').removeClass("fa-arrow-left").addClass("fa-arrow-right");
			}
		}
		else
		{			
			
			switch(Op)
			{
				case 0:
				{
					$('.MenuVertical').css( "flex", "0 0 100px" );			
					$('#btnMenuVertical').removeClass("fa-arrow-right").addClass("fa-arrow-left");	
					$('.ImagemUsuario').css( "width", "100%" );	
					$('.InformacaoUsuario').css( "display", "none" );	
					Op++;

				}break;

				case 1:
				{
					$('.MenuVertical').css( "display", "none" );
					$('#btnMenuVertical').removeClass("fa-arrow-left").addClass("fa-arrow-down");
					$('.ImagemUsuario').css( "width", "0"); 
					Op++;

				}break;

				case 2:
				{
					$('.MenuVertical').css( "display", "block" );
					$('.MenuVertical').css( "flex", " 0 0 250px" );
					$('#btnMenuVertical').removeClass("fa-arrow-down").addClass("fa-arrow-right");
					$('.ImagemUsuario').css( "width", "80px"); 
					$('.InformacaoUsuario').css( "display", "block" );
					Op=0;
				}break;
			}


		}
		


		
		
	
		
	});
	
});