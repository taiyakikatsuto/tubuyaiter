<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * ファイルをアップロードする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        try {
            $image_pathes = DB::transaction(function () use ($request) {

                $result = collect();
                $files = $request->file("images");

                // ファイルごとにストレージ＆DBへ保存
                foreach ($files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $path = Storage::disk("public")->putFileAs('images', $file, $file_name);
                    $imagePath = "/storage/$path";
                    $result->push($imagePath);
                }
                return $result;
            });

            return response()->json([
                "imagePathes" => $image_pathes
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
