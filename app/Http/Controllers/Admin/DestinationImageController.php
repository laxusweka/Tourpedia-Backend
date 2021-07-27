<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestinationImageRequest;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class DestinationImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DestinationImage::with(['destination'])->get();
        return view('admin.destination-image.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = Destination::all();
        return view('admin.destination-image.create', ['destinations' => $destinations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationImageRequest $request)
    {
        $data = $request->all();
        $data['link_image'] = $request->file('link_image')->store('assets/image/destination', 'public');

        //dd($data);
        DestinationImage::create($data);
        return redirect()->route('destination-image.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DestinationImage  $destinationImage
     * @return \Illuminate\Http\Response
     */
    public function show(DestinationImage $destinationImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DestinationImage  $destinationImage
     * @return \Illuminate\Http\Response
     */
    public function edit(DestinationImage $destinationImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DestinationImage  $destinationImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DestinationImage $destinationImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DestinationImage  $destinationImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = DestinationImage::findOrFail($id);
        $item->delete();
        return redirect()->route('destination-image.index');
    }
}
