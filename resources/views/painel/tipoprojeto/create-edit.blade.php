@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao">

	<a class="LinkNavegacao" href="{{ url('/painel') }}"> Inicio / </a>  
	<a class="LinkNavegacao" href="{{ url('/painel/tipoprojeto/') }}"> Tipos de Projeto / </a>  
	<a class="LinkNavegacao" > Gerenciamento Tipo de projeto </a>

</div>

<div class="Conteudo">

	<header class="subTitulo" > 
		Gerenciamento de Tipo de Projeto
	</header>

	<div class="FormsTables" >
		@if(isset($errors) && count($errors)>0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
				<p>{{$error}}</p>
				@endforeach
			</div>
		@endif 
	
		<!-- Conteudo -->				
		@if( isset($Objeto) )
			{!! Form::model($Objeto, ['id'=>'Formulario','route' => ['tipoprojeto.update',$Objeto->id],'class' => 'form', 'method' => 'put' ])  !!}
		@else
			{!! Form::open(['id'=>'Formulario','route' => ['tipoprojeto.store'],'class'=>'form']) !!}
		@endif
		{!! csrf_field() !!}
		{!! Form::hidden('id', null,['id'=>'ID']) !!}		

			<div class="form-row">
				<div class="form-group ">
					<label for="inputEmail4">Descrição</label>
					{!! Form::text('descricao', null, ['class' => 'form-control CampoText', 'placeholder'=>'Descrição']) !!}
				</div>
			</div>

			<div class="form-row">
				<div class="form-group">
						
					{!! Form::checkbox('status', 1, null, ['class'=>'form-check-input CampoCheck']) !!}

					<label class="form-check-label" for="gridCheck">
						Ativo? 
					</label>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group ">
					<label for="inputCity">Observação</label>
					 {!! Form::textarea('observacao',null,['class'=>'form-control CampoText', 'rows' => 2, 'placeholder'=>'Observações']) !!}
				</div>
			</div>

		
			<hr >

			<button type="submit" class="btn btn-success BotaoPadrao">Salvar</button>

		{!! Form::Close() !!}
	</div>


</div>

@endsection