<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    use HasFactory;
    protected $table = 'frequencias';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
