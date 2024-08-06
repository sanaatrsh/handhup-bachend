<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<<<< Temporary merge branch 1
use App\Models\User;
=========

>>>>>>>>> Temporary merge branch 2
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

        $request->merge(["owner_id" => Auth::user()->id]);


        $data = $request->validate([
            'owner_id' => ['required', 'exists:users,id',],
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'description' => ['string'],
        ]);


        $imagesData = $this->uploadImage($request);
        $data = $request->merge(['imagePath' => $imagesData]);
        $data = $request->except('image');
        $user = Auth::user();
        $user->type = 'owner'; // تعيين نوع المستخدم إلى مالك المشروع
        $user->save();
        // dd($data);
        $project = Project::create($data);
        return [
            "project" => $project,
            "message" => "project added"
        ];
    }


    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
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

    //myFunctions
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
