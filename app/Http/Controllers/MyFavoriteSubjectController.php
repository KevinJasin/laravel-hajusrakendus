<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyFavoriteSubject;
use Illuminate\Support\Facades\Http;

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

    // New method to fetch monsters from external API
    public function fetchExternalMonsters()
    {
        $response = Http::get('https://hajusrakendused.tak22parnoja.itmajakas.ee/current/public/index.php/api/monsters');

        if ($response->successful()) {
            $monsters = $response->json();
            return view('subjects.monsters', compact('monsters'));
        }

        return view('subjects.monsters')->withErrors(['error' => 'Failed to fetch monster data']);
    }

    public function showMonsters()
{
    $response = Http::get('https://hajusrakendused.tak22parnoja.itmajakas.ee/current/public/index.php/api/monsters');

    if ($response->successful()) {
        $monsters = $response->json();
        return view('subjects.monsters', compact('monsters'));
    }

    return redirect()->route('subjects.list')->with('error', 'Failed to fetch monsters');
}

}
