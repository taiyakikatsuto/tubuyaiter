<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        try {
            $files = $request->file("images");
            foreach($files as $file){

                $file_name = $file->getClientOriginalName();
                $file->storeAs('images', $file_name);

                $image = new Image();
                $image->tubuyaki_id = 1;
                $image->file_path = public_path('storage/images/' . $file_name);
                $image->file_name = $file_name;
                $image->saveOrFail();
            }

            return response()->json([
                "message" => "uploaded",
                "id" => $image->id
            ], 201);

        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                "message" => "failed"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id)->toJson(JSON_PRETTY_PRINT);
        return response($image, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
    }
}
