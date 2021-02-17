<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'celular', 'endereco', 'numero', 'complemento', 'cep', 'coords_xy', 'sql', 'razao_social', 'cnpj', 'licenca_funcionamento'];
}
