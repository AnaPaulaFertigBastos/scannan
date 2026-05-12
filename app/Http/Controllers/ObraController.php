<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Obra;
use Illuminate\Http\Request;
use Exception;
class ObraController extends Controller
{
public function criar(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|string|max:255',
                'tipo' => 'required|in:Filme,Serie,Livro',
                'duracao' => 'nullable|integer',
                'paginas' => 'nullable|integer',
                'descricao' => 'nullable|string',
                'temporada' => 'nullable|integer',
                'autor_id' => 'required|exists:autores,id',
                'tema_id' => 'required|exists:temas,id'
            ]);

            $obra = Obra::create([
                'titulo' => $request->titulo,
                'tipo' => $request->tipo,
                'duracao' => $request->duracao,
                'paginas' => $request->paginas,
                'descricao' => $request->descricao,
                'temporada' => $request->temporada,
                'autor_id' => $request->autor_id,
                'tema_id' => $request->tema_id
            ]);

            return ResponseHelper::success($obra,'Obra criada com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

public function visualizarObra($id)
    {
        try {
        $obra = Obra::find($id);

        if (!$obra) {
            return ResponseHelper::error('Obra não encontrada',404);
        }

        //CALCULAR MÉDIA
        $notaMedia = $obra->avaliacoes()
                          ->avg('nota');

        //ADICIONA A MÉDIA AO OBJETO
        $obra->nota_media = round(
            $notaMedia,
            1
        );

        return ResponseHelper::success($obra,'Obra encontrada'
        );
    }
    catch(Exception $e) {
        return ResponseHelper::error($e->getMessage(),500);
    }
}

    
    public function listarObras(Request $request)
    {
    try {
        $query = Obra::query();

        //FILTRO POR AUTOR
        if ($request->has('autor_id')) {
            $query->where('autor_id',$request->autor_id);
        }

        //FILTRO POR TEMA
        if ($request->has('tema_id')) {
            $query->where('tema_id',$request->tema_id);
        }

        //MÉDIA DAS AVALIAÇÕES
        $obras = $query->withAvg(
            'avaliacoes',
            'nota'
        )->get();

        $obras->transform(function ($obra) {
            $obra->avaliacoes_avg_nota = round(
                $obra->avaliacoes_avg_nota,
                1
            );
            return $obra;
        });

        return ResponseHelper::success($obras,'Lista de obras');
    }
    catch(Exception $e) {
        return ResponseHelper::error($e->getMessage(),500);
    }
}

    public function deletar($id)
    {
        try {
            $obra = Obra::find($id);

            if (!$obra) {
                return ResponseHelper::error('Obra não encontrada',404);
            }

            $obra->delete();

            return ResponseHelper::success(null,'Obra deletada com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function atualizar(Request $request, $id)
    {
        try {
            $obra = Obra::find($id);

            if (!$obra) {
                return ResponseHelper::error('Obra não encontrada',404);
            }

            $request->validate([
                'titulo' => 'required|string|max:255',
                'tipo' => 'required|in:Filme,Serie,Livro',
                'duracao' => 'nullable|integer',
                'paginas' => 'nullable|integer',
                'descricao' => 'nullable|string',
                'temporada' => 'nullable|integer',
                'autor_id' => 'required|exists:autores,id',
                'tema_id' => 'required|exists:temas,id'
            ]);

            $obra->update($request->all());

            return ResponseHelper::success($obra,'Obra atualizada com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

}
