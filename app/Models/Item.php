<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao'
    ];

    public function itemFornecedor(){
        return $this->hasMany(ItemFornecedor::class, 'item_id');
    }

    public function getMenorValorUnitarioAttribute(){
        return $this->itemFornecedor->min('valor_unitario');
    }

    public function getFornecedorMaisBaratoAttribute(){
        $maisBarato = $this->itemFornecedor?->sortBy('valor_unitario')->first();
        return $maisBarato?->fornecedor->nome ?? null;
    }

    public function getMenorValorParceiroAttribute(){
        $fornecedoresSegmetre = $this->itemFornecedor
            ?->filter(fn($if) => $if->fornecedor && $if->fornecedor->cliente_segmetre);

        return $fornecedoresSegmetre?->min('valor_unitario');
    }

    public function getParceiroMaisBaratoAttribute(){
        $maisBarato = $this->itemFornecedor
            ?->filter(fn($if) => $if->fornecedor && $if->fornecedor->cliente_segmetre)
            ?->sortBy('valor_unitario')
            ->first();

        return $maisBarato?->fornecedor->nome ?? null;

    }
}
