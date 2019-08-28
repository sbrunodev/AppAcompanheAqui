@extends('Painel.Template.Padrao')

@section ('content')

<div class="AreaNavegacao subTitulo">				
	Painel de Controle					
</div>

<div class="Conteudo ConteudoIndex" >

	<div class="col-md-4 col-sm-6" >
		<div class="Card">
			<span class="CardTitle">Projetos</span>
			<p> Em andamento: 4 </p>
			<br><br><br><br>
			<a href="#" class=" CardMessage text-nowrap" >abrir Gerenciamento de Projetos</a>

		</div>
	</div>

	<div class="col-md-4 col-sm-6" >
		<div class="Card">
			<span class="CardTitle">Clientes</span>
			<p> Ativos: 23 </p>
			<p> Desativos: 23 </p>
			<p> Com projetos em andamento: 23 </p>
			<br>
			<a href="#" class="pull-right CardMessage text-nowrap" >abrir Gerenciamento de Clientes</a>

		</div>
	</div>







<!--
	<div class="container-fluid MarginPadding" >
		<div class="row-fluid">

			<div class="col-md-3 CaixinhaIndex BordaDireita" >
				<p  class="CaixinhaNumero MarginPadding">185</p> 
				<p  class="MarginPadding" >Clientes  </p>
			</div>

			<div class="col-md-3 CaixinhaIndex BordaDireita" >
				<p  class="CaixinhaNumero MarginPadding">5</p> 
				<p  class="MarginPadding" >Usuarios  </p>
			</div>

			<div class="col-md-3 CaixinhaIndex BordaDireita" >
				<p  class="CaixinhaNumero MarginPadding">10</p> 
				<p  class="MarginPadding" >Construções  </p>
			</div>

			<div class="col-md-3 CaixinhaIndex " >
				<p  class="CaixinhaNumero MarginPadding">2</p> 
				<p  class="MarginPadding" >Projetos  </p>
			</div>

		</div>
	</div>
	-->
</div>

@endsection