<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Autor;
use Illuminate\Http\Request;
use Exception;

class AutorController extends Controller
{
    public function criar(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255'
            ]);

            $autor = Autor::create([
                'nome' => $request->nome
            ]);

            return ResponseHelper::success($autor,'Autor criado com sucesso'
            );
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function visualizar($id)
    {
        try {
            $autor = Autor::find($id);
            if (!$autor) {
                return ResponseHelper::error('Autor não encontrado',404);
            }

            return ResponseHelper::success($autor,'Autor encontrado');
        }
        catch(Exception $e) {

            return ResponseHelper::error($e->getMessage(),500);
        }
    }
    public function atualizar(Request $request, $id)
    {
        try {
            $autor = Autor::find($id);

            if (!$autor) {
                return ResponseHelper::error('Autor não encontrado',404);
            }

            $request->validate([
                'nome' => 'required|string|max:255'
            ]);

            $autor->nome = $request->nome;

            $autor->save();

            return ResponseHelper::success($autor,'Autor atualizado com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }
    
    public function deletar($id)
    {
        try {
            $autor = Autor::find($id);

            if (!$autor) {
                return ResponseHelper::error('Autor não encontrado',404);
            }

            $autor->delete();

            return ResponseHelper::success(null,'Autor deletado com sucesso');
        }
        catch(Exception $e) {

            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function listar()
    {
        try {
            $autores = Autor::all();

            return ResponseHelper::success($autores,'Lista de autores');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function listarTela()
    {
        $autores = Autor::orderBy('nome')->get();

        return view('autores.listar', compact('autores'));
    }

    public function formCriar()
    {
        return view('autores.criar');
    }

    public function salvarTela(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255'
        ]);

        Autor::create([
            'nome' => $request->nome
        ]);

        return redirect()
            ->route('autores.listar')
            ->with('success', 'Autor criado com sucesso!');
    }

    public function formEditar($id)
    {
        $autor = Autor::findOrFail($id);

        return view('autores.editar', compact('autor'));
    }

    public function salvarEdicao(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:255'
        ]);

        $autor = Autor::findOrFail($id);

        $autor->update([
            'nome' => $request->nome
        ]);

        return redirect()
            ->route('autores.listar')
            ->with('success', 'Autor atualizado com sucesso!');
    }

    public function deletarTela($id)
    {
        $autor = Autor::findOrFail($id);

        if ($autor->obras()->exists()) {

            return redirect()
                ->route('autores.listar')
                ->with(
                    'error',
                    'Não é possível excluir um autor que possui obras vinculadas.'
                );
        }

        $autor->delete();

        return redirect()
            ->route('autores.listar')
            ->with(
                'success',
                'Autor excluído com sucesso!'
            );
    }
}
