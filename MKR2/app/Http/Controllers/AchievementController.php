<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $achievements = Achievement::all();
        return view('achievement.index', ['achievements' => $achievements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Achievement::create([
            'students_id' => $request->input('students_id'),
            'subject' => $request->input('subject'),
            'score' => $request->input('score'),
            'achievement_date' => $request->input('achievement_date'),
        ]);

        return redirect(route('achievements.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $achievement = Achievement::find($id);

        if ($achievement) {
            return view('achievement.show', ['achievement' => $achievement]);
        } else {
            return redirect()->route('achievements.index')->with('error', 'Achievement not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $achievement = Achievement::find($id);
        return view('achievement.edit', ['achievement' => $achievement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Achievement $achievement): RedirectResponse
    {
//        $achievement = Achievement::find($id);

        if ($achievement) {
            $achievement->update([
                'students_id' => $request->input('students_id'),
                'subject' => $request->input('subject'),
                'score' => $request->input('score'),
                'achievement_date' => $request->input('achievement_date'),
            ]);

            return redirect()->route('achievements.index')->with('success', 'Achievement updated successfully');
        } else {
            return redirect()->route('achievements.index')->with('error', 'Achievement not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $achievement = Achievement::find($id);

        if ($achievement) {
            $achievement->delete();
            return redirect()->route('achievements.index')->with('success', 'Achievement deleted successfully');
        } else {
            return redirect()->route('achievements.index')->with('error', 'Achievement not found');
        }
    }
}
