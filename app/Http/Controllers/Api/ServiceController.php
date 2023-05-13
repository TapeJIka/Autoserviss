<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $rating = Service::create($request->validated());

        return new ServiceResource($rating);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new ServiceResource(Service::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, $id)
    {
        Service::find($id)->update($request->validated());

        return new ServiceResource(Service::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rating = Service::find($id);
        $rating->delete();
        return new ServiceResource($rating);
    }
}
