<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestinationRequest;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items = TravelPackage::all();

        // return view('pages.admin.travel-package.index',['items'=>$items]);
        $items = Destination::all();
        return view('admin.destination.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.destination.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationRequest $request)
    {
        $data = $request->all();
        Destination::create($data);
        return redirect()->route('destination.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Destination::findOrFail($id);
        return view('admin.destination.edit', ['item' => $item]);
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
        $destination->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'category' => $request['category'],
            'time' => $request['time'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'link_maps' => $request['link_maps'],
        ]);
        return redirect()->route('destination.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Destination::findOrFail($id);
        $item->delete();
        return redirect()->route('destination.index');
    }
}
