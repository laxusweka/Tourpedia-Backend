<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ResponseFormatter;
use App\Models\Culinary;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function destination_favorite(Destination $destination)
    {
        $data = (bool) Auth::user()->destination_favorites()->find($destination->id);
        if (!$data) {
            Auth::user()->destination_favorites()->attach($destination->id);
            return ResponseFormatter::success(null, 'success menambahkan data');
        }
        Auth::user()->destination_favorites()->detach($destination->id);
        return ResponseFormatter::success(null, 'success menghapus data');
    }

    public function destination_check_favorite(Destination $destination)
    {
        $data = (bool) Auth::user()->destination_favorites()->find($destination->id);
        if (!$data) {
            return ResponseFormatter::success(false, 'data tidak ada');
        }
        return ResponseFormatter::success(true, 'data ada');
    }

    public function destination_myFavorites()
    {
        $item = Auth::user()->destination_favorites;

        return ResponseFormatter::success($item, 'success menampilkan data');
    }

    public function culinary_favorite(Culinary $culinary)
    {
        $data = (bool) Auth::user()->culinary_favorites()->find($culinary->id);
        if (!$data) {
            Auth::user()->culinary_favorites()->attach($culinary->id);
            return ResponseFormatter::success(null, 'success menambahkan data');
        }
        Auth::user()->culinary_favorites()->detach($culinary->id);
        return ResponseFormatter::success(null, 'success menghapus data');
    }

    public function culinary_check_favorite(Culinary $culinary)
    {
        $data = (bool) Auth::user()->culinary_favorites()->find($culinary->id);
        if (!$data) {
            return ResponseFormatter::success(false, 'data tidak ada');
        }
        return ResponseFormatter::success(true, 'data ada');
    }

    public function culinary_myFavorites()
    {
        $item = Auth::user()->culinary_favorites;

        return ResponseFormatter::success($item, 'success menampilkan data');
    }
}
