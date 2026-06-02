<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Student;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // викладач бачить тільки свої завдання
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->with('student')->get();
        return view('tasks.index', compact('tasks'));
    }

    // форма створення завдання
    public function create()
    {
        $students = Student::all();
        return view('tasks.create', compact('students'));
    }

    // збереження завдання
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'student_id' => 'required|exists:students,id',
            'due_date' => 'nullable|date',
        ]);

        // прив'язуємо завдання до поточного викладача
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'student_id' => $request->student_id,
            'user_id' => auth()->id(),
            'due_date' => $request->due_date,
            'status' => 'нове'
        ]);

        return redirect()->route('tasks.index')->with('success', 'Завдання успішно створено!');
    }

    // форма редагування
    public function edit(Task $task)
    {
        // перевірка безпеки: викладач не може редагувати чужі таски
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $students = Student::all();
        return view('tasks.edit', compact('task', 'students'));
    }

    // оновлення завдання
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'student_id' => 'required|exists:students,id',
            'due_date' => 'nullable|date',
            'grade' => 'nullable|integer|min:1|max:12', // оцінка від 1 до 12
            'status' => 'required|in:нове,в процесі,завершено',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Завдання та оцінку оновлено!');
    }

    // видалення завдання
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Завдання видалено.');
    }
}
