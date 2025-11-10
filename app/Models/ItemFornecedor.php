<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemFornecedor extends Model
{
    protected $table = 'item_fornecedor';

    use HasFactory;

    protected $fillable = [
        'item_id',
        'fornecedor_id',
        'valor_unitario'
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
