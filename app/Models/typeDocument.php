<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeDocument extends Model
{
    use HasFactory;
    protected $fillable = ['type'];
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
