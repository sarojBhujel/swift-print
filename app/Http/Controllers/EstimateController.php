<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstimateRequest;
use App\Models\Estimate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EstimateRequest $request)
    {
        try {
            //code...
            $data = $request->validated();
    
            // Save JSON column (Eloquent will cast)
            Estimate::updateOrCreate(['id'=>$data['id']],$data);
            $message = ($request->post_id != '') ? 'Estimate Have Been Updated Successfully.' : 'New Estimate Added Successfully.';
            return response()->json(['success' => $message],Response::HTTP_OK);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => 'Something went wrong !! Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Estimate $estimate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estimate $estimate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estimate $estimate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estimate $estimate)
    {
        //
    }
}
