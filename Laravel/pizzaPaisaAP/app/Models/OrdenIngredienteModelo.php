<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class OrdenIngredienteModelo extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'ordeningrediente';
    public $timestamps = false;
    protected $primaryKey = '';
    public $incrementing = false;
    protected $keyType = '';
    protected $fillable = [
        'idOrden',
        'idIngrediente',
        'CantidadSolicitada',
        'idProveedor',
        'CantidadComprada'
    ];
}