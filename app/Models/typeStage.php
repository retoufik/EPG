<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeStage extends Model
{
    use HasFactory;

    protected $guarded=["id"];
    public function stagiaires()
    {
        return $this->hasMany(Stagiaire::class);
    }
}
