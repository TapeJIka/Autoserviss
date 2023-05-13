<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        $image = $validated['image'];
        $validated['image'] = $image->hashName();
        $image->store('category_image');

        return new CategoryResource(Category::create($validated));

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new CategoryResource(Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,$id)
    {
        $category = Category::find($id);
        $validated = $request->validated();
        if($request->hasFile('image')){
            $category->image= Storage::disk('local')->delete('category_image'.$category->image);
            $image = $validated['image'];
            $validated['image'] = $image->hashName();
            $image->store('category_image');
        }

        $category->update($validated);
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->image = Storage::disk('local')->delete('category_image'.$category->image);
        $category->delete();
        return new CategoryResource($category);
    }

    public function getFile(CategoryRequest $request,$category){
        if(!$request->hasValidSignature()) return abort(401);
        $category->image = Storage::disk('local')->path('category_image'.$category->image);
        return response()->file($category->image);
    }
}
