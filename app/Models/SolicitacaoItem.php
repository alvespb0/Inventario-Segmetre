<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoItem extends Model
{
    protected $table = 'solicitacao_item';

    use HasFactory;

    protected $fillable = [
        'setor_id',
        'item_id',
        'quantidade',
        'status',
        'data_solicitacao',
        'observacao'
    ];

    public function setor(){
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
