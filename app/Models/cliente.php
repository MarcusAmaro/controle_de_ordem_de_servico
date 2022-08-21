<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    public $fillable = ['cli_nome','cli_cpf','cli_endereco','cli_telefone','cli_telefone2','created_at','updated_at'];
}
