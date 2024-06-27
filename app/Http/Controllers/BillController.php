<?php

namespace App\Http\Controllers;

use App\Models\bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return bill::all();   
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
        $user = auth()->user();
        // انا بعد ما طوشت سنا
        if ($user->type !== 'owner') {
            return response()->json(['error' => 'Unauthorized. Only owners can create invoices.'], 403);
        }

        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id',],
        ]);
    }

   
    public function show(bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bill $bill)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id',],
            
        ]);
       
        $bill =bill::find($bill);
        $bill->update($data);
        return response()->json($bill);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bill $id)
    {
        bill::findOrFail($id);
        bill::destroy($id);

        return [
            'message' => 'project has deleted.'
        ];
    }
}
