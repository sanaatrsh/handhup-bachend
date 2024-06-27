<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;



class ProjectController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum')->except('index', 'show');
    // }


    public function index()
    {
        return Project::all();
    }

    public function show(string $id)
    {
        return Project::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'owner_id' => ['required', 'exists:users,id',],
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'description' => ['string'],
        ]);


        $project = Project::create($data);
        // return Response::json([$project, 200, "created"]);
        return $project;
    }


    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            // 'owner_id' => ['required', 'exists:users,id',],
            // 'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'unique:projects,name'],
            'description' => ['string'],
        ]);
        $project = Project::find($id);
        $project->update($data);
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        Project::destroy($id);
        return [
            'message' => 'project deleted.'
        ];
    }
}
