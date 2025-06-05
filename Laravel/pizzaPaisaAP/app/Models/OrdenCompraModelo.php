<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrdenCompraModelo extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'ordendecompra';
    public $timestamps = true;
    protected $primaryKey = 'idOrden';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'idOrden',
        'UsuarioDocumento'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ordenDeCompra) {
            $ordenDeCompra->created_at = Carbon::now()->timezone('America/Bogota'); // Set timezone
        });

        static::updating(function ($ordenDeCompra) {
            $ordenDeCompra->updated_at = Carbon::now()->timezone('America/Bogota'); // Set timezone
        });
    }


    public function ordenIngrediente()
    {
        return $this->hasMany(OrdenIngredienteModelo::class, 'idPedido', 'idPedido');
    }

}