<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'debut' => 'datetime',
        'fin' => 'datetime'
    ];
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function type_stage()
    {
        return $this->belongsTo(TypeStage::class);
    }
}
