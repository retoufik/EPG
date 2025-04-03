<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeStage extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function stagiaires()
    {
        return $this->hasMany(Stagiaire::class);
    }
}
