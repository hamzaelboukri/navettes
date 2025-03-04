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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        announces::create($request->all()); 

        return redirect()->route('user.announcements')->with('success', 'Announcement created successfully');
    }

    public function destroy($id)
    {
        $announcement = announces::findOrFail($id); 
        $announcement->delete();

        return redirect()->route('user.announcements')->with('success', 'Announcement deleted successfully');
    }
}