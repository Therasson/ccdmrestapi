<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Town;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'towns' => Town::orderBy('created_at', 'desc')
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
            'name' => 'required|string'
        ]);


        $town = Town::create([
            'name' =>$attrs['name'],
            'slug' => Str::slug($attrs['name']),
            'etat' => 1,
        ]);

        return response ([
            'message' => 'Town created',
            'town' => $town
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
        return response([
            'town' => Town::where('id', $id)->get()
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
        $town = Town::find($id);

        if(!$town){
            return response([
                'message' => 'Town not found'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string'
        ]);

        $town->update([
            'name' => $attrs['name'],
            'slug' => Str::slug($attrs['name']),
        ]);

        return response ([
            'message' => 'Town updated',
            'post' => $town
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
        $town = Town::find($id);

        if(!$town){
            return response([
                'message' => 'Town not found'
            ], 403);
        }

        $town->delete();

        return response ([
            'message' => 'Town delete',
        ], 200);
    }
}
