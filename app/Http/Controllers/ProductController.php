<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Project;
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

        // dd($data['images']);
        // $images = $data['images'];
        // dd($images);
        $project_id = $request->input('project_id');


        $dataWithOutImages = $request->except('images');
        $product = Product::create($dataWithOutImages);
        // dd($product->id);
        $imagesData = $this->uploadImage($request, $project_id, $product->id);

        // dd($data['images']);

        // $imagesData =  $data['images'];

        // $product = Product::create($data);

        return $product;
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




    public function search(Request $request)
    {
        // الحصول على الكلمة المفتاحية من طلب HTTP
        $query = $request->input('query');

        // البحث عن المنتجات التي تحتوي على الكلمة المفتاحية في الاسم
        $products = Product::where('name', 'like', $query . '%')->get();

        // عرض النتائج كـ JSON
        return response()->json($products);
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        Product::destroy($id);

        return [
            'message' => 'project deleted.'
        ];
    }

    protected function uploadImage(Request $request, string $project_id, int $id)
    {
        // if (!$request->hasFile('image')) {
        //     // dd('hi');
        //     return;
        // }
        $file = $request->file('images');
        // dd($request);
        for ($i = 0; $i < count($file); $i++) {
            $path = $file[$i]->store('uploads', [
                'disk' => 'public'
            ]);
            // dd($path);   
            $imagesData = [
                'product_id' => $id,

                'url' => $path,

            ];

            $productImages = ProductImage::create($imagesData);
            // $imagesData[$i] = [$path, $project_id];
        }
        // dd($imagesData);
        // return $imagesData;
    }
}
