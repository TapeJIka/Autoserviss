<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\contactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContactMessageResource::collection(ContactMessage::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactMessageRequest $request)
    {
        $message = ContactMessage::create($request->validated());

        return new ContactMessageResource($message);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new ContactMessageResource(ContactMessage::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactMessageRequest $request, $id)
    {
        ContactMessage::find($id)->update($request->validated());

        return new ContactMessageResource(ContactMessage::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = ContactMessage::find($id);
        $message->delete();
        return new ContactMessageResource($message);
    }
}
