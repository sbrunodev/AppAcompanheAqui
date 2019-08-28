@extends('Login.Padrao')

@section ('content')
<p class="Entrar">Entrar</p>

{!! Form::open(['id'=>'Formulario','route' => ['login.login'],'class'=>'form']) !!}

	{!! csrf_field() !!}

	@if ($errors->any())    
        @foreach ($errors->all() as $error)
            <span class="ErrorLogin"> {{ $error }} </span>
        @endforeach
     	<br>
	@endif

	<input id="Email" type="text" class="form-control Text" placeholder="Email" name="email"     value="{{old('email')}}">
	<input id="Senha" type="password" class="form-control Text" placeholder="Senha" name="senha" ">
	<button type="submit" class="btn btn-default form-control Text btnEntrar"> Entrar </button>

{!! Form::close() !!}

<p> <a href="#"> Esqueçe a senha ? </a> <a href="{{url('/crieja')}}" class="pull-right"> Não tem uma conta? Crie já. </a> </p>

@endsection

@section('page-script')

<script type="text/javascript">

	

</script>

@endsection



