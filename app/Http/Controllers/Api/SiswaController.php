<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskWord;
use App\Models\Material;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $tugasHariIni = Task::where('student_id', $user->id)
            ->where('date', now()->toDateString())
            ->first();

        $materiTerbaru = Material::latest()->first();

        $kalender = Task::where('student_id', $user->id)
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
            ->with('scores')
            ->get();

        return response()->json([
            'tugasHariIni' => $tugasHariIni,
            'materiTerbaru' => $materiTerbaru,
            'progressKalender' => $kalender
        ]);
    }

    public function index()
    {
        $tasks = Task::where('student_id', auth()->id())
            ->with(['words', 'scores'])
            ->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'student_id' => auth()->id(),
            'date' => now()->toDateString(),
            'punishment' => false
        ]);

        foreach ($request->words as $word) {
            TaskWord::create([
                'task_id' => $task->id,
                'word' => $word['word'],
                'description' => $word['description'],
                'example' => $word['example']
            ]);
        }

        return response()->json($task->load('words'), 201);
    }

    public function kalender()
    {
        $kalender = Task::where('student_id', auth()->id())
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
            ->with('scores')
            ->get()
            ->map(function ($task) {
                return [
                    'tanggal' => $task->date,
                    'status' => $task->words()->count() > 0,
                    'bintang' => $task->scores->first()?->star_count
                ];
            });

        return response()->json($kalender);
    }
}
