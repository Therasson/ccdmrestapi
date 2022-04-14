<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'menus' => Menu::orderBy('created_at', 'desc')
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
            'number_of_person' => 'required',
            'prix'=> 'required',
        ]);


        $menu = Menu::create([
            'name' => $attrs['name'],
            'space_id' => $request->space_id,
            'number_of_person' => $attrs['number_of_person'],
            'prix' => $attrs['prix'],
            'description' => $request->description,
            'etat' => 1,
        ]);

        return response ([
            'message' => 'Menu created',
            'menu' => $menu
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
            'menu' => Menu::where('id', $id)->get()
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
        $menu = Menu::find($id);

        if(!$menu){
            return response([
                'message' => 'Menu not found'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string',
            'number_of_person' => 'required',
            'prix'=> 'required',
        ]);

        $menu->update([
            'name' => $attrs['name'],
            'space_id' => $request->space_id,
            'number_of_person' => $attrs['number_of_person'],
            'prix' => $attrs['prix'],
            'description' => $request->description,
        ]);

        return response ([
            'message' => 'Menu updated',
            'menu' => $menu
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
        $menu = Menu::find($id);

        if(!$menu){
            return response([
                'message' => 'Menu not found'
            ], 403);
        }

        /*if ($space->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ]);
        }*/

        $menu->delete();

        return response ([
            'message' => 'Menu deleted',
        ], 200);
    }
}
