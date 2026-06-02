<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // список усіх учнів
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // форма створення
    public function create()
    {
        return view('students.create');
    }

    // збереження нового учня
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'phone' => 'nullable|string|max:20',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Учня успішно додано!');
    }

    // форма редагування
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // оновлення даних учня
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Дані учня оновлено!');
    }

    // видалення учня
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Учня видалено із системи.');
    }
}
