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
}
