<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CulinaryImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_culinary',
        'link_image'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'id_destinations'
    ];

    public function culinary()
    {
        return $this->belongsTo(Culinary::class, 'id_culinary', 'id');
    }
}
