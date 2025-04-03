<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'prenom',
        'nom',
        'CIN',
        'genre',
        'email',
        'tel',
        'debut',
        'fin',
        'details',
        'path',
        'date_naissance',
        'type_stage_id'
    ];
    protected $casts = [
        'debut' => 'datetime',
        'fin' => 'datetime',
        'date_naissance' => 'datetime'
    ];
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function typeStage()
    {
        return $this->belongsTo(TypeStage::class, 'type_stage_id');
    }
}
