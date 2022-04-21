<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\recommendation;
use App\Http\Controllers\Controller;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'recomendations' => Recommendation::orderBy('created_at', 'desc')
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
            'score' => 'required|integer'
        ]);

        // rechercher si une recommendation pour cet espace a été effectuée par cet utilisateur connecté
        $rec = Recommendation::where('user_id', auth()->user()->id)->where('space_id', $request->space_id)->first();
        if(!$rec)
        {
            $recommendation = Recommendation::create([
                'space_id' => $request->space_id,
                'user_id' => auth()->user()->id,
                'score' => $attrs['score'],
                'comment' => $request->comment,
                'etat' => 1,
            ]);
            
            return response ([
                'message' => 'Recommendation created',
                'recommendation' => $recommendation
            ], 200);

        }
        else{
            return response ([
                'message' => 'Vous avez déjà noté cet espace',
            ], 403);
        }
       
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
            'recommendation' => Recommendation::where('id', $id)->get()
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
        $recommendation = Recommendation::find($id);

        if(!$recommendation){
            return response([
                'message' => 'Recommendation not found'
            ], 403);
        }

        if($recommendation->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'score' => 'required|integer'
        ]);

        $recommendation->update([
            'score' => $attrs['score'],
            'space_id' => $request->space_id,
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
        ]);

        return response ([
            'message' => 'Recommendation updated',
            'recommendation' => $recommendation
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
        $recommendation = Recommendation::find($id);

        if(!$recommendation){
            return response([
                'message' => 'Recommendation not found'
            ], 403);
        }

        if($recommendation->user_id != auth()->user()->id)
        {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $recommendation->delete();

        return response ([
            'message' => 'Recommendation deleted ',
        ], 200);
    }
}
