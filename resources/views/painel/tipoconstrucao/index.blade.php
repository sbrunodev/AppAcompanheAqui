@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/tipoconstrucao/') }}"> Tipos de Construção  </a>  


</div>

<div class="Conteudo">

	<header class="subTitulo" > 
		Tipos de Construção
	</header>

	<div class="FormsTables" >
	    
	    <a class="btn btn-success btnCadastrar" href="{{ url('/painel/tipoconstrucao/create') }}" > Cadastrar </a>    

			<table class="table ">
				<thead>
					<tr>

						<th>Descrição</th>
						<th>Quantidade de Construções</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Casa</td>
						<td>3</td>
						<td>Ativo</td>

						<td> 
							<a href=""> Editar </a> 
						 	<a> Exibir </a> 
						</td>

					</tr>


					<tr>
						<td>Prédio</td>
						<td>1</td>
						<td>Ativo</td>

						<td> 
							<a href=""> Editar </a> 
						 	<a> Exibir </a> 
						</td>
					</tr>



					<tr>
						<td>Urbano</td>
						<td>2</td>
						<td>Ativo</td>

						<td> 
							<a href=""> Editar </a> 
						 	<a> Exibir </a> 
						</td>
					</tr>


					<tr>
						<td>Reflorestamento</td>
						<td>6</td>
						<td>Ativo</td>

						<td> 
							<a href=""> Editar </a> 
						 	<a> Exibir </a> 
						</td>
					</tr>



					<tr>
						<td>Pontes</td>
						<td>5</td>
						<td>Ativo</td>

						<td> 
							<a href=""> Editar </a> 
						 	<a> Exibir </a> 
						</td>
					</tr>



					<tr>
						<td>Edifícios </td>
						<td>1</td>
						<td>Ativo</td>

						<td> 
							<a href=""> Editar </a> 
						 	<a> Exibir </a> 
						</td>
					</tr>
				


				</tbody>
			</table>
		
	</div>


</div>

@endsection