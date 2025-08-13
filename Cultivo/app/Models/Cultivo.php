<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultivo extends Model
{
    use HasFactory;

    protected $table = 'cultivos';
    
    protected $fillable = [
        'nombre',
        'tipo',
        'fecha',
        'user_id'
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    protected $dates = [
        'fecha',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
