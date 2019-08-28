@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/tipoconstrucao/') }}"> Tipos de Construção / </a>  
	<a class="LinkNavegacao" > Gerenciamento Tipo de construção </a>

</div>

<div class="Conteudo">

	<header class="subTitulo" > 
		Gerenciamento de Tipo de Construção
	</header>

	<div class="FormsTables" >
		<form>			

			<div class="form-row">
				<div class="form-group ">
					<label for="inputEmail4">Descrição</label>
					<input type="email" class="form-control CampoText"  placeholder="Descrição">
				</div>
			</div>

			<div class="form-row">
				<div class="form-group">
					<input class="form-check-input CampoCheck" type="checkbox" id="gridCheck">
					<label class="form-check-label" for="gridCheck">
						Ativo? 
					</label>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group ">
					<label for="inputCity">Observação</label>
					 <textarea class="form-control CampoText" rows="2" placeholder="Observação"></textarea>
				</div>
			</div>

			

				



			<hr >

			<button type="submit" class="btn btn-success BotaoPadrao">Salvar</button>

		</form>
	</div>


</div>

@endsection