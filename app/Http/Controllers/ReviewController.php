<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return review::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $project_id, string $product_id)
    {
        $request->merge(
            [
                "user_id" => Auth::user()->id,
                "project_id" => $project_id,
                "product_id" => $product_id
            ],
        );
        // dd($project_id);
        // dd($request);

        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'project_id' => ['required', 'exists:projects,id'],
            'product_id' => ['required', 'exists:products,id'],
            'rate' => ['required', 'integer', 'between:0,5'],
            'description' => ['nullable']
        ]);

        $review = review::create($data);
        // return Response::json([$project, 200, "created"]);
        return $review;
    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(review $review)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, review $review)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(review $id)
    {
        review::findOrFail($id);
        review::destroy($id);

        return [
            'message' => 'review is deleted.'
        ];
    }
}
