<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\TipoProjeto;
use validator;

class TipoProjetoController extends Controller
{
    

    protected $rules = [
        'descricao'=>'required|min:3|max:100',
    ];

    private $ModelTipoProjeto;
    public function __construct(TipoProjeto $ModelTipoProjeto){
        $this->ModelTipoProjeto = $ModelTipoProjeto;
    }


    public function index()
    {
        $Titulo = 'Gerenciamento de Tipo de Projeto';
        $Obj = $this->ModelTipoProjeto->paginate(200);
        return view('painel.tipoprojeto.index',compact('Obj','Titulo') );
    }

   
    public function create()
    {
         return view('painel.tipoprojeto.create-edit');
    }

  
    public function store(Request $request)
    {
         $dataForm = $request->all();
        $valida = validator($dataForm, $this->rules);
      
        if($valida->fails()) 
            return redirect()
                ->route('tipoprojeto.create')->withErrors(['error'=>$valida->errors()->all()])->withInput();
        else
        {
            $dataForm['status'] = ( isset($dataForm['status']) ) ? 1 : 0 ;

            $dataForm['usuarioID'] = '1';
            $dataForm['empresaID'] = '1';

            $insert = $this->ModelTipoProjeto->create($dataForm);

             if($insert)
                 return redirect()->route('tipoprojeto.index');
            else        
                return redirect()
                    ->route('tipoprojeto.create')->withErrors(['error'=>'Ocorreu um erro ao salvar o tipo de projeto!'])->withInput();
        
        }
    }


    public function show($id)
    {
          
    }


    public function edit($id)
    {
        $Objeto = $this->ModelTipoProjeto->find($id);

        if( $Objeto == null )
            return redirect()->route('tipoprojeto.index');
        else
            return view('painel.tipoprojeto.create-edit',compact('Objeto'));
        
    }

 
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $valida = validator($dataForm, $this->rules);
      
        if($valida->fails()) 
            return redirect()
                ->route('tipoprojeto.create')->withErrors(['error'=>$valida->errors()->all()])->withInput();
        else
        {
            $dataForm['status'] = ( isset($dataForm['status']) ) ? 1 : 0 ;

            $dataForm['usuarioID'] = '1';
            $dataForm['empresaID'] = '1';

            $Objeto = $this->ModelTipoProjeto->find($id);
            $update = $Objeto->update($dataForm);

            if($update)
                return redirect()->route('tipoprojeto.index');
            else
                return redirect()
                ->route('tipoprojeto.create')->withErrors(['error'=>'Ocorreu um erro ao salvar o tipo de projeto.'])->withInput();
        }  
    }


    public function destroy($id)
    {
        
    }


    public function getProjetos($id)
    { 
        return $this->ModelTipoProjeto->where('status',1)->select('id','descricao')->get();
    }


}
