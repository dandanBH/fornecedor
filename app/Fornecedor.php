<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';
    protected $fillable = ['id_usuario','razao_social', 'cnpj', 'atividade_principal'];

    /*public function user(){
        return $this->belongsTo(User::class,'usuario_id','id');
    }*/
}
