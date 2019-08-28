@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/projeto/') }}"> Projetos  </a>  


</div>





<div class="Conteudo">

	<header class="subTitulo" > 
		Projetos
	</header>

	
	<div class="container-fluid ConteudoProjeto" >
		<div class="row-fluid " style="font-size: 18px;">

			<div class="col-md-3 " style="border-left: 10px solid #E1E1E1;" >
				 
				  <a href="#" data-toggle="tooltip" title="Projetos que estão sendo executados" style="color: black;"><b>5</b> Em execução</a>
			</div>

			<div class="col-md-3 " style="border-left: 10px solid #E3E3E3;" >
				<a href="#" data-toggle="tooltip" title="Projetos que já foram concluidos" style="color: black;"><b>2</b> Concluidos</a> 
			</div>

			<div class="col-md-3 " style="border-left: 10px solid #E5E5E5;" >
				<a href="#" data-toggle="tooltip" title="Projetos que foram cancelados" style="color: black;"><b>3</b>  Cancelado</a>
			</div>

			<div class="col-md-3 "  style="border-left: 10px solid #E7E7E7;">
				<a href="#" data-toggle="tooltip" title="Projeto que estão em fase de Orçamento" style="color: black;"><b>6</b>  Orçamento</a>
			</div>

		</div>

	</div>


	<hr>
	<div class="FormsTables" >

		<a class="btn btn-success btnCadastrar" href="{{ url('/painel/projeto/create') }}" > Novo Projeto </a>    

		
			<table class="table ">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Inicio</th>
						<th>Tipo Projeto</th>
						<th>Situação</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($Obj as $o)
					<tr>
						<td> {{ $o->descricao  }} </td>
						<td> {{  date("d/m/Y", strtotime($o->datainicio))  }} </td>
						<td> {{ $o->tipoprojetodescricao }} </td>
						<td> Em andamento </td>
						<td> 
							<a href="{{route('projeto.edit',$o->id)}}"> Editar </a> 
						 	<a href="{{route('projeto.show',$o->id)}}"> Exibir </a> 
						</td>
					</tr>
					@endforeach

				</tbody>

			</table>
		
	</div>


</div>

@endsection