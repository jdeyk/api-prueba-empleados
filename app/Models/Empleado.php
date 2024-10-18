<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $fillable = [
        'fullname',
        'correo',
        'fecha_nacimiento',
        'isActivo',
        'departamento_id'
    ];

    // Relación con Departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
