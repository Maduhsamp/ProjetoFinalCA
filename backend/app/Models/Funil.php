<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funil extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contato()
    {
        return $this->hasMany(Contato::class);
    }

}
