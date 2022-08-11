<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tubuyaki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TubuyakiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tubuyakies = Tubuyaki::get()->toJson(JSON_PRETTY_PRINT);
        // Log::info($tubuyakies);
        return response($tubuyakies, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $tubuyaki = new Tubuyaki();
            $tubuyaki->fill($request->all());
            Log::info($request->all());

            $tubuyaki->saveOrFail();

            return response()->json([
                "message" => "created"
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                "message" => "failed"
            ], 500);
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
        $tubuyaki = Tubuyaki::find($id)->toJson(JSON_PRETTY_PRINT);
        // Log::info($tubuyaki);
        return response($tubuyaki, 200);
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
        try {
            $tubuyaki = Tubuyaki::find($id);
            $tubuyaki->fill($request->all());
            Log::info($request->all());
            $tubuyaki->saveOrFail();

            return response()->json([
                "message" => "updated"
            ], 201);

        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                "message" => "failed"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tubuyaki = Tubuyaki::find($id);
            $tubuyaki->delete();

            return response()->json([
                "message" => "deleted"
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                "message" => "failed"
            ], 500);
        }
    }
}