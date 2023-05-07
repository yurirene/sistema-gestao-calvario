<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesourariaSubcategoria extends Model
{
    protected $table = 'tesouraria_subcategorias';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
