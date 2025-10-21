<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Men;

class MenController extends Controller
{
    public function index()
    {
        $mens = Men::latest()->get();
        return view('dashboard', compact('mens'));
    }

    public function store(Request $request)
    {
        // dd('store called', $request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mens,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        Men::create($validated);

        return redirect()->back()->with('success', 'Mens Added Successfully');
    }

    // Edit function
    public function edit(Men $men) {
        return view('mens.edit', compact('men'));
    }

    public function update(Request $request, Men $men) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mens,email,' . $men->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $men->update($validated);

        return redirect()->route('dashboard')->with('success', 'Updated successfully!');
    }
    // Delete function
    public function destroy(Men $men) {
        $men->delete();

        return redirect()->back()->with('success', 'Deleted successfully!');
    }
}
