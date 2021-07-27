<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Culinary;
use App\Models\FavoriteDestination;
use Exception;
use Illuminate\Http\Request;

class ApiCulinaryController extends Controller
{
    public function random()
    {
        $item = Culinary::with('images')->get()->random(3);
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

            $result = Culinary::with('images')->where('title', 'like', "%" . $search . "%")->paginate();;
            //$result = DB::table('destinations')->where('title', 'like', "%" . $search . "%")->paginate(30);
            if ($result) {
                return ResponseFormatter::success($result, 'Success');
            } else {
                return ResponseFormatter::success(null, 'Success');
            }
            //         ResponseFormatter::success(null, 'Success');
        }

        $item = Culinary::with('images')->get();
        $total = Culinary::count();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Culinary  $culinary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = Culinary::with('images')->findOrFail($id);
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
     * @param  \App\Models\Culinary  $culinary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Culinary $culinary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Culinary  $culinary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Culinary $culinary)
    {
        //
    }
}
