<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = Student::all();
        $achievements = Achievement::all();
        return view('student.index', ['students' => $students], ['achievments' => $achievements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Student::create([
            'name' => $request->input('name'),
            'course' => $request->input('course'),
            'specialty' => $request->input('specialty'),
        ]);

        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {





        $student = Student::find($id);
        $achievements = Achievement::where('students_id', $id)->get();

        if ($student) {
//            return view('students.show', compact('student', 'achievements'));
            return view('student.show', ['student' => $student], ['achievements' => $achievements]);
        } else {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        return view('student.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $student = Student::find($id);

        if ($student) {
            $student->update([
                'name' => $request->input('name'),
                'course' => $request->input('course'),
                'specialty' => $request->input('specialty'),
            ]);

            return redirect()->route('students.index')->with('success', 'Student updated successfully');
        } else {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully');
        } else {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }
    }


    public function confirmDeleteAchievement($student_id, $achievement_id)
    {
        $achievement = Achievement::findOrFail($achievement_id);
        return view('student.confirm-delete-achievement', compact('student_id', 'achievement_id', 'achievement'));
    }

    public function destroyAchievement(Request $request, $student_id, $achievement_id)
    {
        try {
            $this->validate($request, [
            ]);
            Achievement::where('id', $achievement_id)->delete();
            return redirect()->route('students.show', $student_id)->with('success', 'Achievement deleted successfully');
        } catch (ValidationException $e) {
            return redirect()->route('students.show', $student_id)->with('error', 'Validation error: ' . $e->getMessage());
        }
    }
}
