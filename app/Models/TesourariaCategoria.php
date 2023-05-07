<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesourariaCategoria extends Model
{
    protected $table = 'tesouraria_categorias';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function subcategorias()
    {
        return $this->hasMany(TesourariaSubcategoria::class, 'categoria_id');
    }
}
