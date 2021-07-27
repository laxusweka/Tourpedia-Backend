<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Culinary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'price',
        'time',
        'address',
        'contact',
        'link_maps'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function images()
    {
        $images = $this->hasMany(CulinaryImage::class, 'id_culinary', 'id');
        return $images;
    }

    public function favorited()
    {
        return (bool) FavoriteCulinary::where('user_id', Auth::id())
            ->where('culinary_id', $this->id)
            ->first();
    }
}
