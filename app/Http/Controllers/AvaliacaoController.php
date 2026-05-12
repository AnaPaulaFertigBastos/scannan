<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Avaliacao;
use Illuminate\Http\Request;
use Exception;

class AvaliacaoController extends Controller
{
    public function avaliar(Request $request)
    {
        try {
            $request->validate([
                'nota' => 'required|integer|min:1|max:10',
                'comentario' => 'nullable|string',
                'obra_id' => 'required|exists:obras,id'
            ]);

            $usuario = auth('api')->user();

            //PRA NAO DAR DUPLICIDADE DE AVALIACAO PARA A MESMA OBRA PELO MESMO USUÁRIO
            $avaliacaoExistente = Avaliacao::where(
                'usuario_id',
                $usuario->id
            )
            ->where('obra_id',$request->obra_id)
            ->first();

            if ($avaliacaoExistente) {
                return ResponseHelper::error('Você já avaliou esta obra',400);
            }

            $avaliacao = Avaliacao::create([
                'nota' => $request->nota,
                'comentario' => $request->comentario,
                'usuario_id' => $usuario->id,
                'obra_id' => $request->obra_id
            ]);

            return ResponseHelper::success($avaliacao,'Avaliação criada com sucesso');

        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function listarAvaliacoesObra($obraId)
    {
        try {
            $avaliacoes = Avaliacao::where(
                'obra_id',
                $obraId
            )->get();

            return ResponseHelper::success($avaliacoes,'Avaliações da obra');

        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function listarMinhasAvaliacoes()
    {
        try {
            $usuario = auth('api')->user();

            $avaliacoes = Avaliacao::where(
                'usuario_id',
                $usuario->id
            )->get();

            return ResponseHelper::success($avaliacoes,'Minhas avaliações');
        }
        catch(Exception $e) {return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function deletar($id)
    {
        try {

            $usuario = auth('api')->user();

            $avaliacao = Avaliacao::find($id);

            if (!$avaliacao) {
                return ResponseHelper::error('Avaliação não encontrada',404);
            }

            //GARANTIR QUE O USUÁRIO SÓ POSSA DELETAR SUAS PRÓPRIAS AVALIAÇÕES
            if ($avaliacao->usuario_id != $usuario->id) {
                return ResponseHelper::error('Acesso negado',403);
            }
            $avaliacao->delete();

            return ResponseHelper::success(null,'Avaliação deletada');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }
    public function atualizar(Request $request, $id)
    {
        try {

            $usuario = auth('api')->user();

            $avaliacao = Avaliacao::find($id);

            if (!$avaliacao) {
                return ResponseHelper::error('Avaliação não encontrada',404);
            }

            //GARANTIR QUE O USUÁRIO SÓ POSSA ATUALIZAR SUAS PRÓPRIAS AVALIAÇÕES
            if ($avaliacao->usuario_id != $usuario->id) {
                return ResponseHelper::error('Acesso negado',403);
            }

            $request->validate([
                'nota' => 'required|integer|min:1|max:10',
                'comentario' => 'nullable|string'
            ]);

            $avaliacao->nota = $request->nota;
            $avaliacao->comentario = $request->comentario;
            $avaliacao->save();

            return ResponseHelper::success($avaliacao,'Avaliação atualizada');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }
}
