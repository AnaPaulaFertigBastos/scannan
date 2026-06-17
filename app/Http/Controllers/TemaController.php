<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Tema;
use Illuminate\Http\Request;
use Exception;
class TemaController extends Controller
{
    public function criar(Request $request)
    {
        try {
            $request->validate([
                'descricao' => 'required|string|max:255'
            ]);

            $tema = Tema::create([
                'descricao' => $request->descricao
            ]);

            return ResponseHelper::success($tema,'Tema criado com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function visualizar($id)
    {
        try {
            $tema = Tema::find($id);

            if (!$tema) {
                return ResponseHelper::error('Tema não encontrado',404);
            }

            return ResponseHelper::success($tema,'Tema encontrado'
            );

        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function atualizar(Request $request, $id)
    {
        try {
            $tema = Tema::find($id);

            if (!$tema) {
                return ResponseHelper::error('Tema não encontrado',404);
            }

            $request->validate([
                'descricao' => 'required|string|max:255'
            ]);

            $tema->descricao = $request->descricao;

            $tema->save();

            return ResponseHelper::success($tema,'Tema atualizado com sucesso');

        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function deletar($id)
    {
        try {
            $tema = Tema::find($id);

            if (!$tema) {
                return ResponseHelper::error('Tema não encontrado',404);
            }

            $tema->delete();

            return ResponseHelper::success(null,'Tema deletado com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function listar()
    {
        try {
            $temas = Tema::all();

            return ResponseHelper::success($temas,'Lista de temas');

        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function listarTela()
    {
        $temas = Tema::orderBy('descricao')->get();

        return view('temas.listar', compact('temas'));
    }

    public function formCriar()
    {
        return view('temas.criar');
    }

    public function salvarTela(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255'
        ]);

        Tema::create([
            'descricao' => $request->descricao
        ]);

        return redirect()
            ->route('temas.listar')
            ->with('success', 'Tema criado com sucesso!');
    }

    public function formEditar($id)
    {
        $tema = Tema::findOrFail($id);

        return view('temas.editar', compact('tema'));
    }

    public function salvarEdicao(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:255'
        ]);

        $tema = Tema::findOrFail($id);

        $tema->descricao = $request->descricao;

        $tema->save();

        return redirect()
            ->route('temas.listar')
            ->with('success', 'Tema atualizado com sucesso!');
    }

    public function deletarTela($id)
    {
        $tema = Tema::findOrFail($id);

        if ($tema->obras()->exists()) {

            return redirect()
                ->route('temas.listar')
                ->with(
                    'error',
                    'Não é possível excluir este tema pois existem obras vinculadas.'
                );
        }

        $tema->delete();

        return redirect()
            ->route('temas.listar')
            ->with(
                'success',
                'Tema excluído com sucesso!'
            );
    }
}
