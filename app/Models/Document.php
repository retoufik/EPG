<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Document extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function stagiaires()
    {
        return $this->belongsTo(Stagiaire::class);
    }
    public function type_document()
    {
        return $this->belongsTo(typeDocument::class,'');
    }
}
