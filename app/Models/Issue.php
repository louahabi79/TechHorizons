<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'issue_id';
    protected $fillable = [
        'title',
        'publication_date',
        'is_public',
        'status'
    ];
}
