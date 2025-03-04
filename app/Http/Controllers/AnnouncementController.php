<?php

namespace App\Http\Controllers;

use App\Models\announces;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = announces::all(); 
        return view('user.announcements', compact('announcements'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'societe_id' => 'required|integer',
            'date_debut' => 'required|date',
            'date_arriver' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_arriver' => 'required|date_format:H:i',
            'destination' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:active,inactive',
            'nb_place' => 'required|integer',
        ]);

        announces::create($validatedData);

        return redirect()->route('user.announcements')->with('success', 'Announcement created successfully');
    }

    public function destroy($id)
    {
        $announcement = announces::findOrFail($id);
        $announcement->delete();

        return redirect()->route('user.announcements')->with('success', 'Announcement deleted successfully');
    }
}