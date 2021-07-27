<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\FavoriteDestination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDestinationController extends Controller
{
    public function random()
    {
        $item = Destination::with('images')->get()->random(3);
        try {
            return ResponseFormatter::success([
                'item' => $item,
            ], 'Success');
        } catch (\Throwable $th) {
            return ResponseFormatter::error(['error' => $th], 'Error', 500);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $result = Destination::with('images')->where('title', 'like', "%" . $search . "%")->paginate();
            //$result = DB::table('destinations')->where('title', 'like', "%" . $search . "%")->paginate(30);
            if ($result) {
                return ResponseFormatter::success($result, 'Success');
            } else {
                return ResponseFormatter::success(null, 'Success');
            }
            //         ResponseFormatter::success(null, 'Success');
        }

        $category = $request->input('category');
        if ($category) {
            $result = Destination::with('images')->where('category', '=', $category)->paginate();
            //$result = DB::table('destinations')->where('title', 'like', "%" . $search . "%")->paginate(30);
            if ($result) {
                return ResponseFormatter::success($result, 'Success');
            } else {
                return ResponseFormatter::success(null, 'Success');
            }
            //         ResponseFormatter::success(null, 'Success');
        }

        $item = Destination::with('images')->get();
        $total = Destination::count();
        $favorite = FavoriteDestination::count();
        try {
            return ResponseFormatter::success([
                'item' => $item,
                'total' => $total,
                'favorite' => $favorite
            ], 'Success');
        } catch (\Throwable $th) {
            return ResponseFormatter::error(['error' => $th], 'Error', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
        //     $request->validate([
        //         'title' => ['required', 'string'],
        //         'description' => ['required', 'string'],
        //         'link_maps' => ['required', 'string'],
        //     ]);

        //     Destination::create([
        //         'title' => $request->title,
        //         'description' => $request->description,
        //         'link_maps' => $request->link_maps,
        //     ]);

        //     return ResponseFormatter::success(['request' => $request], 'Success');
        // } catch (\Throwable $th) {
        //     return ResponseFormatter::error(['error' => $th], 'Error', 500);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = Destination::with('images')->findOrFail($id);
            //$item = Destination::findOrFail($id);


            return ResponseFormatter::success($item, 'Success');
        } catch (Exception $th) {
            return ResponseFormatter::error(['error' => $th], 'Error', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        //
    }
}
