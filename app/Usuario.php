<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $fillable = ['nome, email, telefone, experiencia_id, formacao_id'];
   
    public $timestamps = false;

    public function experiencia() {
        return $this->belongsTo(Experiencia::class, 'experiencia_id');
    }

    public function formacao() {
        return $this->belongsTo(Formacao::class, 'formacao_id');
    }

    public function scopeSearchFor($query, $search) {
        if (!empty($search)) {
            return $query;
        }

        return $query->where('nome', 'like', '%' . preg_replace('/([%_])/', '\\$1', $search) . '%');
    }    
}

