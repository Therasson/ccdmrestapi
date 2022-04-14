<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SpaceCategory;
use App\Http\Controllers\Controller;

class SpaceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'sapceCategories' => SpaceCategory::orderBy('created_at', 'desc')
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


        $spaceCategory = SpaceCategory::create([
            'name' =>$attrs['name'],
            'slug' => Str::slug($attrs['name']),
            'etat' => 1,
        ]);

        return response ([
            'message' => 'Space category created',
            'spaceCategory' => $spaceCategory
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
            'spaceCategory' => SpaceCategory::where('id', $id)->get()
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
        $spaceCategory = SpaceCategory::find($id);

        if(!$spaceCategory){
            return response([
                'message' => 'Space Category not found'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string'
        ]);

        $spaceCategory->update([
            'name' => $attrs['name'],
            'slug' => Str::slug($attrs['name']),
        ]);

        return response ([
            'message' => 'Space category updated',
            'post' => $spaceCategory
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
        $spaceCategory = SpaceCategory::find($id);

        if(!$spaceCategory){
            return response([
                'message' => 'Space category not found'
            ], 403);
        }

        $spaceCategory->delete();

        return response ([
            'message' => 'Space category deleted',
        ], 200);
    }
}
