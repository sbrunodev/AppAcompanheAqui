@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/cliente/') }}"> Clientes  </a>  


</div>

<div class="Conteudo">

	<header class="subTitulo" > 
		Clientes
	</header>

	<div class="FormsTables" >
	    
	    <a class="btn btn-success btnCadastrar" href="{{ url('/painel/cliente/create') }}" > Cadastrar </a>    

			<table class="table ">
				<thead>
					<tr>
						<th>Nome</th>
						<th>CPF</th>
						<th>Email</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($Obj as $o)
					<tr>
						<td> {{ $o->nome  }} </td>
						<td> {{ $o->cpf   }} </td>
						<td> {{ $o->email }} </td>
						<td> {{ ($o->status==1)?'Ativo':'Desativo'}} </td>
						<td> 
							<a href="{{route('cliente.edit',$o->id)}}"> Editar </a> 
						 	<a> Exibir </a> 
						</td>
					</tr>
					@endforeach

				</tbody>

			</table>
		
	</div>


</div>

@endsection