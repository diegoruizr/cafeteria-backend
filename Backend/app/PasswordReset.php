<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
     /**
     * Atributos asignables.
     *
     * @var array
     */
    protected $fillable = ['email', 'token'];
}
