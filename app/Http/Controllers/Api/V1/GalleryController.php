<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class GalleryController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $k => $file)
            {
                $fileName = $k.'-'.time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('images/spaces/gallery');
                $file->move($destinationPath, $fileName);

                $image = new Image();
                $image->fill([
                    'alt' => '',
                    'url'   => $fileName,
                    'space_id'  => 1,
                    'etat'          => 1
                ]);
                $image->save();
            }

            return response()->json([
                'message'=> 'Gallery created'
            ]);

        }
        else
        {
            return response()->json([
                'message'=> 'Choose an image file'
            ]);
        }
    }
}
