<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonateRequest;
use App\Http\Resources\DonateResource;
use App\Models\donate_schedual;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonateSchedualController extends Controller
{

    public function __construct()
    {
        $this->middleware('blood_compare')->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donate_schedular =  donate_schedual::with('user','blood_type')->get();
        return response()->json([
            // "message" => "Fetch Data Successfully",
            "message" => trans('response.test'),
            "data" => DonateResource::collection($donate_schedular)
        ],Response::HTTP_ACCEPTED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonateRequest $request)
    {


        $donate_schedular =  donate_schedual::create([
            "user_id" => $request->user_id,
            "amount" => $request->amount,
            "blood_type_id" => $request->blood_type_id,
            "verified" => false,

        ]);

        operation_fun("+",$request->amount);

        return response()->json([
            "message" => "Donate Scheduled Successfully",
            "data" => $donate_schedular
        ],Response::HTTP_ACCEPTED);

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($schedual_id)
    {
        // return $schedual_id;
        $schedual = donate_schedual::where('id',$schedual_id)->with('user','blood_type')->get();
        return response()->json([
            "message" => "Data Fetched Successfully",
            "data" => $schedual
        ],Response::HTTP_ACCEPTED);
        dd($schedual);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\donate_schedual  $donate_schedual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$donate_schedual)
    {
        $request->validate([
            "amount" => "required|min:1|integer",
            ]);

            $schedual = donate_schedual::where('id',$donate_schedual)->with('user','blood_type')->update([
                "amount" => $request->amount
            ]);

            return response()->json([
                "message" => "Data Updated Successfully",
            ],Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\donate_schedual  $donate_schedual
     * @return \Illuminate\Http\Response
     */
    public function destroy($donate_schedual)
    {
        $donate_schedual::where('id',$donate_schedual)->delete();
    }

public function log(){

}


}
