<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $table = 'contatos';
    protected $fillable = [
        'name',
        'funil_id',
        'etapa_id',
        'phone_number',
        'email',
        'cpf',
        'birth_date',
        'address',
        'value'
    ];

    public function etapa()
    {
        return $this->belongsTo(Etapas::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $maxOrder = static::max('order');
            $model->order = $maxOrder + 1;
        });
    }
}
