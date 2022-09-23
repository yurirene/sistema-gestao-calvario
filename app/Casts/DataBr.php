<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DataBr implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $data_convertida = Carbon::parse($value)->format('d/m/Y');
        return $data_convertida;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        $data_convertida = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        return $data_convertida;
    }
}
