<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//
use App\Models\Painel\Cliente;
use App\Models\Painel\Contato;
use App\Models\Painel\Endereco;
use File;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
     protected $rules = [
        'nome'=>'required|min:3|max:100',
    ];

    private $ModelCliente;  
    public function __construct(Cliente $ModelCliente){
        $this->ModelCliente = $ModelCliente;
    }

    public function index()
    {      
        $Titulo = 'Gerenciamento de clientes';
        $Obj = $this->ModelCliente->paginate(5);
        return view('painel.cliente.index',compact('Obj','Titulo') );
    }

   
    public function create()
    {
        $sexo = [ '0'=>'Escolha o sexo', '1'=>'Masculino', '2'=>'Feminino', '3'=>'Indiferente' ];
        return view('painel.cliente.create-edit',compact('sexo'));
    }

  
    public function store(Request $request)
    {
        $dataForm = $request->all();

        $valida = validator($dataForm, $this->rules);
        
        if($valida->fails()) 
            return response()->json(['error'=>$valida->errors()->all()]);
        else 
        {   
            // Configurando e formatando os dados
            if( isset($dataForm['datanascimento']) && $dataForm['datanascimento']!=null )
            {
               $time = strtotime(str_replace('/','-',$dataForm['datanascimento']));
               $newformat = date('Y-m-d',$time);
               $dataForm['datanascimento'] = $newformat;
            }
            
            $dataForm['status'] = ( !isset($dataForm['status']) ) ? 0 : 1 ; 

            // Salvando informação
            $insert = $this->ModelCliente->create($dataForm);
 
            if( $insert ){

                $dataContatos =  isset($dataForm['inputcontatos' ]) ? $dataForm['inputcontatos' ] : false ;                
                $dataEnderecos = isset($dataForm['inputenderecos']) ? $dataForm['inputenderecos'] : false ;                
                $this->SalvaContatoEndereco($insert->id,'update', $dataContatos, $dataEnderecos );               
                // Salva imagem
                if($request->hasFile('UploadIMG'))
                {
                    $TamanhoArquivo = $request->file('UploadIMG')->getClientSize();
                    
                    if($TamanhoArquivo != 0)
                    {  
                        $image    = $request->file('UploadIMG');
                        $fileName = md5(($insert->id).'18997458242') . '.' . $image->getClientOriginalExtension();
                        $request->file('UploadIMG')->storeAs('public/clientes',$fileName);

                        //Atualiza o campo da foto
                        $this->ModelCliente->where('id', $insert->id)->update(['foto' => $fileName]);
                    }  
                }

                return response()->json(['success'=>'Cliente salvo com sucesso!']);
            }
            else        
                return response()->json(['error'=>'Erro ao salvar cliente!']);
        }     
    }


    public function show($id)
    {
      
    }


    public function edit($id)
    {
        $Objeto =  $this->ModelCliente->find($id);
        
        if($Objeto == null)
            return redirect()->route('cliente.index');
  
        // Recupera o entedeço e contato do cliente.
        $ModelContato = new Contato();
        $contatos = $ModelContato->where('iduc',$Objeto->id)->where('tipo','cliente')->get();

        // Recupera o entedeço e contato do cliente.
        $ModelEndereco = new Endereco();
        $enderecos = $ModelEndereco->where('iduc',$Objeto->id)->where('tipo','cliente')->get();
        


        $sexo = [ '0'=>'Escolha o sexo', '1'=>'Masculino', '2'=>'Feminino', '3'=>'Indiferente' ];
        return view('Painel.cliente.create-edit',compact('Objeto','sexo','contatos','enderecos'));
    }

 
    public function update(Request $request, $id)
    {
          
        $dataForm = $request->all();
        
        $valida = validator($dataForm, $this->rules);
        
        if($valida->fails()) 
            return response()->json(['error'=>$valida->errors()->all()]);
        else 
        {   
         
            // Configurando e formatando os dados
            if( isset($dataForm['datanascimento']) && $dataForm['datanascimento']!=null )
            {
               $time = strtotime(str_replace('/','-',$dataForm['datanascimento']));
               $newformat = date('Y-m-d',$time);
               $dataForm['datanascimento'] = $newformat;
            }
            
            $dataForm['status'] = ( !isset($dataForm['status']) ) ? 0 : 1 ; 
            

            // Salvando informação
            $Cliente = $this->ModelCliente->find($id);
            $update =  $Cliente->update($dataForm);
 
            if( $update ){
                //                 
                $dataContatos =  isset($dataForm['inputcontatos' ]) ? $dataForm['inputcontatos' ] : false ;                
                $dataEnderecos = isset($dataForm['inputenderecos']) ? $dataForm['inputenderecos'] : false ;                
                $this->SalvaContatoEndereco($id,'update', $dataContatos, $dataEnderecos );
               
                // Apaga a imagem
                //$caminhoImagem = 'public/clientes/'.$id.'.png';
                //$exists = Storage::disk('local')->exists($caminhoImagem);
                //if( $exists )
                //Storage::delete($caminhoImagem);

                // Salva imagem
                if($request->hasFile('UploadIMG'))
                {
                    $TamanhoArquivo = $request->file('UploadIMG')->getClientSize();
                    
                    if($TamanhoArquivo != 0)
                    {  
                        $image    = $request->file('UploadIMG');
                        $fileName = md5(($id).'18997458242') . '.' . $image->getClientOriginalExtension();
                        $request->file('UploadIMG')->storeAs('public/clientes',$fileName);

                        //Atualiza o campo da foto
                        $this->ModelCliente->where('id', $id)->update(['foto' => $fileName]);
                    }  
                
                }

                return response()->json(['success'=>'Cliente alterado com sucesso!']);
            }
            else        
                return response()->json(['error'=>'Erro ao alterar cliente!']);
        }
    }


    public function destroy($id)
    {
        
    }

    public function GetClientes($id){
        return $this->ModelCliente->select('id','nome','cpf','email')->get();
    }


    // 
    public function SalvaContatoEndereco($id, $acao, $dataContatos, $dataEnderecos)
    {
        $ModelContato = new Contato();
        $ModelEndereco = new Endereco();

        if($acao == 'update'){
            $ModelContato->where('iduc',$id)->where('tipo','cliente')->delete();
            $ModelEndereco->where('iduc',$id)->where('tipo','cliente')->delete();
        }
        
        // Recuperando contatos
        if($dataContatos!=false){
            $contatos = $this->ArrayContatos( $dataContatos );
            if(isset($contatos)){
                            
                foreach ($contatos as $value) 
                {
                    $value['iduc'] = $id;
                    $insertContato = $ModelContato->create($value);
                }
            }
        }
        
        // Recuperando Endereços
        if($dataEnderecos!=false){
            $enderecos = $this->ArrayEnderecos( $dataEnderecos );           
            if(isset($enderecos)){                    
                foreach ($enderecos as $value) 
                {
                    $value['iduc'] = $id;
                    $insertEndereco = $ModelEndereco->create($value);
                }
            }
        }   

    }
   
    // Regras de negócio    
    private function ArrayContatos($Contatos)
    {
        $Contatos = explode("=", $Contatos);

        $celular;$telefone;$email;$id;

        $i=1;
        $posArray=0;
        $ArrayC='';
        foreach ($Contatos as $value) 
        {
            $value = trim($value);
            // Organiza informações
            switch ($i) {
                case 1: $id      = $value  ; break;
                case 2: $celular = $value  ; break;
                case 3: $telefone= $value  ; break;
                case 4: $email   = $value  ; break;
            }

            // Hora de jogar as informações em um array
            if($i==4)
            {
                $ArrayC[$posArray]['id']       = $id; 
                $ArrayC[$posArray]['celular']  = $celular; 
                $ArrayC[$posArray]['telefone'] = $telefone;
                $ArrayC[$posArray]['email']    = $email;
                $ArrayC[$posArray]['tipo']    = "cliente";

                $i=1;
                $posArray++;
            }
            else
                $i++;
        }

        return $ArrayC;
    }


    private function ArrayEnderecos($Enderecos)
    {   
        $Enderecos = explode("=", $Enderecos);

        $id;$cep;$estado;$cidade;$bairro;$numero;$endereco;

        $i=1;
        $posArray=0;
        $ArrayC='';
        foreach ($Enderecos as $value) 
        {
            $value = trim($value);
            // Organiza informações
            switch ($i) {
                case 1: $id     = $value  ; break;
                case 2: $cep    = $value  ; break;
                case 3: $estado = $value  ; break;
                case 4: $cidade = $value  ; break;
                case 5: $bairro = $value  ; break;
                case 6: $numero = $value  ; break;
                case 7: $endereco = $value  ; break;

            }

            // Hora de jogar as informações em um array
            if($i==7)
            {
                $ArrayC[$posArray]['id'] = $id; 
                $ArrayC[$posArray]['cep']  = $cep; 
                $ArrayC[$posArray]['estado'] = $estado;
                $ArrayC[$posArray]['cidade'] = $cidade;
                $ArrayC[$posArray]['bairro'] = $bairro; 
                $ArrayC[$posArray]['numero'] = $numero;
                $ArrayC[$posArray]['endereco'] = $endereco;
                $ArrayC[$posArray]['tipo']    = "cliente";

                $i=1;
                $posArray++;
            }
            else
                $i++;
        }

        return $ArrayC;
    }


}
