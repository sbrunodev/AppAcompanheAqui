@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/tipoprojeto/') }}"> Tipos de Projeto  </a>  


</div>

<div class="Conteudo">

	<header class="subTitulo" > 
		{{ $Titulo }}
	</header>

	<div class="FormsTables" >
	    
	    <a class="btn btn-success btnCadastrar" href="{{ url('/painel/tipoprojeto/create') }}" > Cadastrar </a>    

			<table class="table ">
				<thead>
					<tr>

						<th>Descrição</th>
						<th>Quantidade de Projetos</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					

				@foreach($Obj as $o)
					<tr>
						<td>{{ $o->descricao }}</td>
						<td>{{ $o->status==1?'Ativo':'Desativo' }}</td>
						<td>{{ $o->observacao }}</td>
						<td> 
							<a href=" {{route('tipoprojeto.edit',$o->id)}} "> Editar </a> 
						 	<a> Exibir </a> 
						</td>

					</tr>
				@endforeach



				</tbody>
			</table>
		
	</div>


</div>

@endsection