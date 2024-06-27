<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        return Product::where('project_id', $id)->get();
    }


    public function show(string $project_id, string $id)
    {
        return Product::where('project_id', $project_id)->where('id', $id)->first();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'name' => ['required', 'string'],
            'price' => ['required'],
            'available' => ['required', 'boolean'],
            'images' => ['nullable', 'array'],
            //remember me to edit here:
            'images.*' => ['image'],
            'description' => ['nullable'],

        ]);

        // if ($validators->fails()) {
        //     // Handle validation errors
        //     return response()->json(['error' => $validator->errors()], 400);
        // }

        // $dataWithOutImages = $request->except('images');
        // $product = Product::create($dataWithOutImages);
        for ($i = 0; $i < 2; $i++) {

            $data['images[i]'] = $this->uploadImage($request);
        }


        // $imagesData =  $data['images[]'];

        dd($data['images']);
        // $productImages = ProductImage::create($imagesData);
        // return $product;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oldProduct = Product::find($id);
        $data = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'name' => ['required', 'string'],
            'price' => ['required'],
            'available' => ['required', 'boolean'],
            'description' => ['nullable'],
        ]);
        $product = Product::find($id);

        $product->update($data);
        return response()->json(['oldData' => $oldProduct, 'newData' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id);
        Product::destroy($id);

        return [
            'message' => 'project deleted.'
        ];
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }
}
