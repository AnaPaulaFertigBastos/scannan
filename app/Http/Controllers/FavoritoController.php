<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;

class FavoritoController extends Controller
{
    public function favoritarObra($obraId)
    {
        try {
            $usuario = auth('api')->user();

            // Verificar se a obra já está nos favoritos do usuário
            $favoritoExistente = Favorito::where('usuario_id', $usuario->id)
                ->where('obra_id', $obraId)
                ->first();

            if ($favoritoExistente) {
                return ResponseHelper::error('Obra já está nos favoritos', 400);
            }

            // Criar um novo favorito
            $favorito = Favorito::create([
                'usuario_id' => $usuario->id,
                'obra_id' => $obraId
            ]);

            return ResponseHelper::success($favorito, 'Obra adicionada aos favoritos com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }


    public function removerFavorito($obraId)
    {
        try {
            $usuario = auth('api')->user();

            // Encontrar o favorito a ser removido
            $favorito = Favorito::where('usuario_id', $usuario->id)
                ->where('obra_id', $obraId)
                ->first();

            if (!$favorito) {
                return ResponseHelper::error('Obra não está nos favoritos', 404);
            }

            // Remover o favorito
            $favorito->delete();

            return ResponseHelper::success(null, 'Obra removida dos favoritos com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    public function listarFavoritos()
    {
        try {
            $usuario = auth('api')->user();
            $favoritos = Favorito::where('usuario_id', $usuario->id)
                ->get();

            return ResponseHelper::success($favoritos, 'Favoritos listados com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(),500);
        }
    }

    
}
