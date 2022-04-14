<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'spaces' => Space::orderBy('created_at', 'desc')
                ->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'district' => 'required|string'
        ]);


        $space = Space::create([
            'name' =>$attrs['name'],
            'town_id' => $request->town_id,
            'user_id' => auth()->user()->id,
            'space_categories_id' => $request->space_categories_id,
            'district' => $attrs['district'],
            'phone' => $request->phone,
            'longitude' => $attrs['longitude'],
            'latitude' => $attrs['latitude'] ,
            'etat' => 1,
        ]);

        return response ([
            'message' => 'Space created',
            'space' => $space
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // retourner les espaces avec les resommandations, les avis
        return response([
            'space' => Space::where('id', $id)->get()
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $space = Space::find($id);

        if(!$space)
        {
            return resonse([
                'message' => 'Space not found.'
            ], 403);
        }

        if ($space->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validation des données
        $attrs = $request->validate([
            'name' => 'required|string',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'district' => 'required|string'
        ]);

        $space->update([
            'name' => $attrs['name'],
            'town_id' => $request->town_id,
            'space_categories_id' => $request->space_categories_id,
            'district' => $attrs['district'],
            'phone' => $request->phone,
            'longitude' => $attrs['longitude'],
            'latitude' => $attrs['latitude'] ,
        ]);

        return response([
            'message' => 'Space updated.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $space = Space::find($id);

        if(!$space)
        {
            return response([
                'message' => 'Space not found.'
            ], 403);
        }

        if ($space->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ]);
        }

        $space->delete();

        return response([
            'message' => 'Space deleted.'
        ], 200);
    }
}
