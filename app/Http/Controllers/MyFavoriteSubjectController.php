<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyFavoriteSubject;

class MyFavoriteSubjectController extends Controller
{
    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'category' => 'nullable|string|max:100',
            'interest_level' => 'nullable|string|max:100',
        ]);

        MyFavoriteSubject::create($validated);

        return redirect()->route('subjects.list')->with('success', 'Subject added!');
    }

    public function list()
    {
        $subjects = MyFavoriteSubject::latest()->get();
        return view('subjects.list', compact('subjects'));
    }

    public function destroy(MyFavoriteSubject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.list')->with('success', 'Subject deleted.');
    }
}
