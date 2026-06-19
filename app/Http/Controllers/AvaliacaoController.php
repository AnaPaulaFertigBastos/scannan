<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Avaliacao;
use App\Models\Obra;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Você já avaliou esta obra'
                ]);
            }

            $avaliacao = Avaliacao::create([
                'nota' => $request->nota,
                'comentario' => $request->comentario,
                'usuario_id' => $usuario->id,
                'obra_id' => $request->obra_id
            ]);

            return redirect()->route('avaliacoes.obra', $request->obra_id);

        }
        catch (ValidationException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Erro ao realizar criar avaliação'
                ]);
        }
    }

    public function avaliarView($obraId)
    {
        try {

            $obra = Obra::find($obraId);

            if (!$obra) {
                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Obra não encontrada'
                ]);
            }
            
            $usuario = auth('api')->user();

            //PRA NAO DAR DUPLICIDADE DE AVALIACAO PARA A MESMA OBRA PELO MESMO USUÁRIO
            $avaliacaoExistente = Avaliacao::where(
                'usuario_id',
                $usuario->id
            )
            ->where('obra_id',$obraId)
            ->first();

            if ($avaliacaoExistente) {
                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Você já avaliou esta obra'
                ]);
            }

            return view('avaliacoes.criar', [
                'title' => 'Criar Avaliação',
                'obraId' => $obraId,
                'obraTitulo' => $obra->titulo
            ]);

        }
        catch(Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Erro ao carregar avaliar'
                ]);
        }
    }

    public function listarAvaliacoesObra($obraId)
    {
        try {
            $avaliacoes = Avaliacao::join('usuario', 'avaliacoes.usuario_id', '=', 'usuario.id')
                ->where('avaliacoes.obra_id', $obraId)
                ->select('avaliacoes.*', 'usuario.apelido')
                ->paginate(10);

            // $avaliacoes = Avaliacao::with('usuario:id,apelido')
            // ->where('obra_id', $obraId)
            // ->get();

            $usuarioAutenticado = auth('api')->user();
            $usuarioId = $usuarioAutenticado->id;

            $obraTitulo = Obra::find($obraId)->titulo ?? 'Obra';

            return view('avaliacoes.obra', [
                'title' => 'Avaliações da Obra',
                'usuario' => $usuarioId,
                'avaliacoes' => $avaliacoes,
                'obraTitulo' => $obraTitulo,
                'obraId' => $obraId
            ]);
        }
        catch(Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Erro ao carregar avaliações da obra' . $e->getMessage()
                ]);
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

                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Avaliação não encontrada'
                ]);
            }

            //GARANTIR QUE O USUÁRIO SÓ POSSA ATUALIZAR SUAS PRÓPRIAS AVALIAÇÕES
            if ($avaliacao->usuario_id != $usuario->id) {
                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Acesso negado'
                ]);
            }

            $request->validate([
                'nota' => 'required|integer|min:1|max:10',
                'comentario' => 'nullable|string'
            ]);

            $avaliacao->nota = $request->nota;
            $avaliacao->comentario = $request->comentario;
            $avaliacao->save();

            return redirect()->route('avaliacoes.obra', $request->obra_id);
        }
        catch (ValidationException $e) {
            throw $e;
        }
        catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Erro ao realizar atualização da avaliação'
                ]);
        }
    }

    public function atualizarView($id)
    {
        try {

            $avaliacao = Avaliacao::find($id);

            $obra = Obra::find($avaliacao->obra_id);

            $usuario = auth('api')->user();

            if (!$avaliacao) {
                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Avaliação não encontrada'
                ]);
            }

            //GARANTIR QUE O USUÁRIO SÓ POSSA ATUALIZAR SUAS PRÓPRIAS AVALIAÇÕES
            if ($avaliacao->usuario_id != $usuario->id) {
                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Acesso negado'
                ]);
            }

            if (!$obra) {
                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Obra não encontrada'
                ]);
            }

            return view('avaliacoes.atualizar', [
                'title' => 'Atualizar Avaliação',
                'avaliacao' => $avaliacao,
                'obraTitulo' => $obra->titulo
            ]);

        }
        catch(Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Erro ao carregar atualização da avaliação'
                ]);
        }
    }
}
