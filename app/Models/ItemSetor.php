<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSetor extends Model
{
    protected $table = 'item_setor';
    
    use HasFactory;

    protected $fillable = [
        'setor_id',
        'item_id',
        'qtd_estoque'
    ];

    public function setor(){
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
