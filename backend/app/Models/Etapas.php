<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapas extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function contato()
    {
        return $this->hasMany(Contato::class);
    }
}
