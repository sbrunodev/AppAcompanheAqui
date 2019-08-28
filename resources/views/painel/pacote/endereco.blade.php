<div class="form-row DivContatoEndereco">
	
	<div>		
		<span class="TituloContatoEndereco"> Endereço </span>
		<!--<a  href="" data-toggle="modal"  data-target="#ModalEndereco"> Adicionar Endereço</a> -->
		<a id="AbrirModalEndereco" href="" > Adicionar Endereço</a>			
	</div>

	
	<table id="enderecos" class="table table-hover table-sm ">		

		<thead> 
			<tr>	
				<th>Id</th>	   
				<th>CEP</th>		   
				<th>Estado</th>		   
				<th>Cidade</th>	
				<th>Bairro</th>
				<th>Número</th>			
				<th>Endereço</th>	
				<th>Ações</th>			   		 
			</tr>		 
		</thead>
		<tbody>
			@if(isset($enderecos) && count($enderecos)>0)

			@foreach($enderecos as $e)

			
			<tr>		
				<td class="inf" data-codigo="{{ $e->id }}" >  {{ $e->id }}</td>
				<td class="inf" data-cep="{{ $e->cep }}" >  {{ $e->cep }}</td>		   
				<td class="inf" data-estado="{{ $e->estado }}" >  {{ $e->estado }}</td>		   
				<td class="inf" data-cidade="{{ $e->cidade }}" >  {{ $e->cidade }}</td>
				<td class="inf" data-bairro="{{ $e->bairro }}" >  {{ $e->bairro }}</td>
				<td class="inf" data-numero="{{ $e->numero }}" >  {{ $e->numero }}</td>
				<td class="inf" data-endereco="{{ $e->endereco }}" >  {{ $e->endereco }}</td>

				<td>		     
					<a class='btnRemoverEndereco btnPadraoTabela'  href="">Remover</a>
					<a class='btnAlterarEndereco btnPadraoTabela' href="">Alterar</a>	

				</td>
			</tr>

			@endforeach

			@endif

			<!--
			<tr>		
				<td class="inf" >  </td>
				<td class="inf" >  19210-000</td>		   	   
				<td class="inf" >  Tarabai - SP</td>
				<td class="inf" >  Jardim Candeias</td>
				<td class="inf" >  1432</td>
				<td class="inf" >  Av. Marechal Castelo Branco </td>

				<td>		     
					<a class='btnRemoverEndereco btnPadraoTabela'  href="">Remover</a>
					<a class='btnAlterarEndereco btnPadraoTabela' href="">Alterar</a>	

				</td>
			</tr>

			<tr>		
				<td class="inf" >  </td>
				<td class="inf" >  19220-000</td>		      
				<td class="inf" >  Presidente Prudente - SP</td>
				<td class="inf" >  Brasil Novo</td>
				<td class="inf" >  879</td>
				<td class="inf" >  Av. </td>

				<td>		     
					<a class='btnRemoverEndereco btnPadraoTabela'  href="">Remover</a>
					<a class='btnAlterarEndereco btnPadraoTabela' href="">Alterar</a>	

				</td>
			</tr>
		-->

	</tbody>		

</table>




<!-- Modal Endereço -->

<div class="modal fade" id="ModalEndereco" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
				<h4 id="exampleModalLabel" class="modal-title">Endereço</h4>
				

			</div>
			<div class="modal-body">

				<div class="form-row">
					<div class="form-group col-md-12">
						<span class="nomeCampo" >CEP</span>

						<div class="form-inline">

							<input type="text" id="eCep" placeholder="Cep" class="form-control" value="">

							<button class='btn btn-default ' id="btnBuscaCEP"  type="button"> Pesquisar CEP </button>

						</div>
					</div>
				</div>

				<div class="form-row">

					<div class="form-group col-md-8">	
						<span class="nomeCampo" >Cidade</span>
						<input type="text" id="eCidade" placeholder="Cidade" class="form-control" value="">
					</div>

					<div class="form-group col-md-4">
						<span class="nomeCampo" >Estado</span>
						<input type="text" id="eEstado" placeholder="Estado" class="form-control" value="">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-8">
						<span class="nomeCampo" >Bairro</span>
						<input type="text" id="eBairro" placeholder="Bairro" class="form-control" value="">
					</div>

					<div class="form-group col-md-4">	
						<span class="nomeCampo" >Número</span>
						<input type="text" id="eNumero" placeholder="Numero" class="form-control" value="">
					</div>

				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<span class="nomeCampo" >Endereço</span>
						<input type="text" id="eEndereco" placeholder="Endereço" class="form-control" value="">
					</div>
				</div>



			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default  BotaoPadrao" data-dismiss="modal">Cancelar</button>
				<button type="button" id="AddTableEndereco" class="btn btn-success  BotaoPadrao">Salvar</button>
			</div>
		</div>

	</div>
</div>

<!-- Fim -->
</div>