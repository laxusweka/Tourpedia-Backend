<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Culinary;
use App\Models\CulinaryImage;
use App\Models\DestinationImage;
use Illuminate\Http\Request;

class CulinaryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CulinaryImage::with(['culinary'])->get();
        return view('admin.culinary-image.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $culinaries = Culinary::all();
        return view('admin.culinary-image.create', ['culinaries' => $culinaries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_culinary' => ['required', 'integer'],
            'link_image' => ['required', 'image'],
        ]);
        $data = $request->all();
        $data['link_image'] = $request->file('link_image')->store('assets/image/culinary', 'public');

        //dd($data);
        CulinaryImage::create($data);
        return redirect()->route('culinary-image.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Culinary  $culinary
     * @return \Illuminate\Http\Response
     */
    public function show(Culinary $culinary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Culinary  $culinary
     * @return \Illuminate\Http\Response
     */
    public function edit(Culinary $culinary)
    {
        //
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
    public function destroy($id)
    {
        $item = CulinaryImage::findOrFail($id);
        $item->delete();
        return redirect()->route('culinary-image.index');
    }
}
