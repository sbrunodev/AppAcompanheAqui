<div class="form-row DivContatoEndereco">
	
	<div>
		<span class="TituloContatoEndereco"  > Contato </span> 			
		<!--<a  href="" data-toggle="modal"  data-target="#ModalContato"> Adicionar Contato</a>-->
		<a id="AbrirModalContato" href="" > Adicionar Contato</a>
	</div>


	<table id="contatos" class="table table-hover table-sm ">		
		<thead>	 
			<tr>	
				<th>#</th>	   
				<th>Celular</th>		   
				<th>Telefone</th>		   
				<th>Email</th>	
				<th>Ações</th>		   		 
			</tr>	
		</thead>
		<tbody>	
			@if(isset($contatos) && count($contatos)>0)
			@foreach($contatos as $c)					

			<tr>		
				<td class="inf" data-codigo="{{ $c->id }}">         {{ $c->id }}      </td>
				<td class="inf" data-celular="{{ $c->celular }}">   {{ $c->celular }} </td>		   
				<td class="inf" data-telefone="{{ $c->telefone }}"> {{ $c->telefone }}</td>		   
				<td class="inf" data-email="{{ $c->email }}">       {{ $c->email }}   </td>		   

				<td>		     
					<a class='btnRemoverContato btnPadraoTabela'  href="" > Remover</a>
					<a class='btnAlterarContato btnPadraoTabela' href="">   Alterar</a>	   
				</td>
			</tr>

			@endforeach

			@endif

			<!--
			<tr>		
				<td class="inf" > </td>
				<td class="inf" > (18) 99757-8242</td>		   
				<td class="inf" > (18) 3289-5167 </td>		   
				<td class="inf" > bruhhnno@live.com   </td>		   

				<td>		     
					<a class='btnRemoverContato btnPadraoTabela'  href="" > Remover</a>
					<a class='btnAlterarContato btnPadraoTabela' href="">   Alterar</a>	   
				</td>
			</tr>


			<tr>		
				<td class="inf" > </td>
				<td class="inf" > (18) 97457-2456</td>		   
				<td class="inf" >  </td>		   
				<td class="inf" > teste   </td>		   

				<td>		     
					<a class='btnRemoverContato btnPadraoTabela'  href="" > Remover</a>
					<a class='btnAlterarContato btnPadraoTabela' href="">   Alterar</a>	   
				</td>
			</tr>
-->

		</tbody>
	</table>
	



	<!-- Modal Contato -->

	<!-- Modal Contato -->
	<div class="modal fade " id="ModalContato" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
					<h4 id="exampleModalLabel" class="modal-title">Contato</h4>
					
				</div>

				<div class="modal-body" id="CamposAddContato">

					
				<div class="form-row col-md-12">
					<div class="form-group col-md-6">
						<span class="nomeCampo" >Celular</span>
						<input type="text" id="contatoCelular" placeholder="Celular" class="form-control" value="">
					</div>

					<div class="form-group col-md-6">
						<span class="nomeCampo" >Telefone</span>
						<input type="text" id="contatoTelefone" placeholder="Telefone" class="form-control" value="">
					</div>
				</div>

				<div class="form-row col-md-12 ">
					<div class="form-group col-md-12">
						<span class="nomeCampo" >Email</span>
						<input type="text" id="contatoEmail" placeholder="Email" class="form-control" value="">
					</div>
				</div>

				</div>
				
				<div class="modal-footer">

					<button type="button" class="btn btn-default  BotaoPadrao" data-dismiss="modal">Cancelar</button>
					<button type="button" id="AddTableContato" class="btn btn-success  BotaoPadrao">Salvar</button>
				</div>

			</div>
		</div>
	</div>


	<!-- Fim -->
</div>