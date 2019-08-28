<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Painel\Projeto;
use App\Models\Painel\ClienteProjeto;
use App\Models\Painel\Cliente;
use App\Models\Painel\Fase;
use App\Models\Painel\TipoProjeto;

class ProjetoController extends Controller
{
    protected $rules = [
        'descricao'=>'required|min:3|max:100',
    ];

    private $ModelProjeto;  
    public function __construct(Projeto $ModelProjeto){
        $this->ModelProjeto = $ModelProjeto;
    }


    public function index()
    {
        $Obj = $this->ModelProjeto->select('projeto.*','tipoprojeto.descricao as tipoprojetodescricao')
        ->join('tipoprojeto','tipoprojeto.id','=','projeto.tipoprojeto')
        ->paginate(5);

        return view ('Painel.Projeto.index',compact('Obj'));
    }

    public function create()
    {
        $TProjetos = $this->getTiposProjeto();        
        return view('painel.projeto.create-edit',compact('TProjetos'));
    }

    private function getTiposProjeto(){
        $ModelTipoProjeto = new TipoProjeto();
        return $ModelTipoProjeto->where('status',1)->select('id','descricao')->get();
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
            if( isset($dataForm['datainicio']) && $dataForm['datainicio']!=null )
            {
               $time = strtotime(str_replace('/','-',$dataForm['datainicio']));
               $newformat = date('Y-m-d',$time);
               $dataForm['datainicio'] = $newformat;
            }
            
            // Configurando e formatando os dados
            if( isset($dataForm['dataprevisao']) && $dataForm['dataprevisao']!=null )
            {
               $time = strtotime(str_replace('/','-',$dataForm['dataprevisao']));
               $newformat = date('Y-m-d',$time);
               $dataForm['dataprevisao'] = $newformat;
            }

            // Configurando e formatando os dados
            if( isset($dataForm['datafinalizacao']) && $dataForm['datafinalizacao']!=null )
            {
               $time = strtotime(str_replace('/','-',$dataForm['datafinalizacao']));
               $newformat = date('Y-m-d',$time);
               $dataForm['datafinalizacao'] = $newformat;
            }

           
            
            $insert = $this->ModelProjeto->create($dataForm);

            if( $insert )
            {
                if( isset($dataForm['inputclientes']) )
                    $this->SalvaClientes($insert->id, $dataForm['inputclientes']);
                   
                if( isset($dataForm['inputfases']) )
                    $this->SalvaFases($insert->id, $dataForm['inputfases']);
               
                return response()->json(['success'=>'Projeto salvo com Sucesso']);
            }
            else
                return response()->json(['error'=>'Erro ao salvar Projeto']);
        }    
    }

    public function SalvaClientes($id, $strClientes)
    {
        $Clientes = explode("=",$strClientes);

        foreach($Clientes as $Value)
        {
            $Cliente = explode ("visao",$Value);
            $ClienteProjeto = new ClienteProjeto();
            $ClienteProjeto->create([ 'idprojeto' => $id,
                                      'idcliente' => $Cliente[0],
                                      'situacao'  => $Cliente[1],
                                    ]);
        }

  
    }

    public function SalvaFases($id, $strFases)
    {
        $Fases = explode("=",$strFases);        
        foreach($Fases as $Value)
        {
            $Fase = explode ("descript:",$Value);
            $FaseModel = new Fase();
            $FaseModel->create(['idprojeto' => $id,
                                'descricaofase' => $Fase[0],
                                'descricao' => $Fase[1],
                                'situacao'  => '1',
                                ]);
        }
        

    }  


    public function show($id)
    {
         
    }


    public function edit($id)
    {
        $Objeto = $this->ModelProjeto->find($id);

        if($Objeto == null)
            return null;
        else
        {
            $TProjetos = $this->getTiposProjeto();   

            $FaseModel = new Fase();
            $fases = $FaseModel->where('idprojeto',$Objeto->id)->get();

            $ClienteModel = new ClienteProjeto();
            $clientes = $ClienteModel->select('idcliente','situacao','nome')
            ->join('cliente','cliente.id','=','clienteprojeto.idcliente')
            ->where('clienteprojeto.idprojeto',$Objeto->id)
            ->get();
            
            return view('painel.projeto.create-edit',compact('TProjetos','Objeto','fases','clientes'));
        }    
    }

 
    public function update(Request $request, $id)
    {
         
    }


    public function destroy($id)
    {
        
    }


    // Gerenciamento da Fase do Projeto
    public function Fase($idProjeto, $idFase)
    {
        $ModelFase = new Fase();
       
        $Objeto = $ModelFase->select('fase.*','projeto.descricao as projetodescricao')
        ->join('projeto','projeto.id','=','fase.idprojeto')
        ->where('fase.id',$idFase)
        ->where('fase.idprojeto',$idProjeto)
        ->first();

        return view ('Painel.Fase.create-edit',compact('Objeto'));
    }


  


}
