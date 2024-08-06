<?php

namespace App\Http\Controllers;

use App\Models\report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return report::all();
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
    public function store(Request $request)
    {
        $request->merge(["user_id" => Auth::user()->id]);


        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id',],
            'project_id' => ['required', 'exists:projects,id'],
            'description' => ['string', 'nullable'],
        ]);

        $report = report::create($data);
        // return Response::json([$project, 200, "created"]);
        return $report;
    }
    /**
     * Display the specified resource.
     */
    public function show(report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(report $report)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, report $report)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(report $id)
    {
        report::findOrFail($id);
        report::destroy($id);

        return [
            'message' => 'report is deleted.'
        ];
    }
}
