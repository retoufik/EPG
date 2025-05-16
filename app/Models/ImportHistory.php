<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    use HasFactory;
    public $table = 'import_history';

    protected $fillable = [
        'filename',
        'total_records',
        'successful_records',
        'failed_records',
        'errors'
    ];

    protected $casts = [
        'errors' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 