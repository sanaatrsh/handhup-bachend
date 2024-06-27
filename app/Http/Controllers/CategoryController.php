<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string']
        ]);

        $category = Category::create($data);

        //we should edit Redirect later
        // return  $category;
        return Response::json([$category, 200, "created"]);
    }

    public function show(Category $category)
    {
        return Category::findOrFail($category->id);
    }

    public function update(Request $request, string $reservedIdCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string']
        ]);

        $category = Category::find($reservedIdCategory);
        $category->update($data);
        // Category::findOrFail($id)->first()->fill($request->all())->save();

        return response()->json($data);
    }

    public function destroy(string $reservedIdCategory)
    {
        $category = Category::findOrFail($reservedIdCategory);
        // dd($category);
        Category::destroy($reservedIdCategory);
        return [
            'message' => 'category deleted.'
        ];
    }
}
