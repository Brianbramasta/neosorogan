<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\ClassStudent;
use App\Models\Task;
use App\Models\TaskScore;

class GuruController extends Controller
{
    public function index()
    {
        $kelas = Classroom::where('teacher_id', auth()->id())
            ->with('students')
            ->get();
        return response()->json($kelas);
    }

    public function store(Request $request)
    {
        $kelas = Classroom::create([
            'name' => $request->nama_kelas,
            'teacher_id' => auth()->id()
        ]);
        return response()->json($kelas, 201);
    }

    public function getSiswa($id)
    {
        $kelas = Classroom::findOrFail($id);
        return response()->json($kelas->students);
    }

    public function addSiswa(Request $request, $id)
    {
        ClassStudent::create([
            'class_id' => $id,
            'student_id' => $request->siswa_id
        ]);
        return response()->json(['message' => 'Siswa added'], 201);
    }

    public function removeSiswa($id, $siswa_id)
    {
        ClassStudent::where('class_id', $id)
            ->where('student_id', $siswa_id)
            ->delete();
        return response()->json(null, 204);
    }

    public function getTugasSiswa($siswa_id)
    {
        $tugas = Task::where('student_id', $siswa_id)
            ->with(['words', 'scores'])
            ->get();
        return response()->json($tugas);
    }

    public function nilaiTugas(Request $request, $tugas_id)
    {
        TaskScore::updateOrCreate(
            ['task_id' => $tugas_id, 'teacher_id' => auth()->id()],
            [
                'star_count' => $request->bintang,
                'comment' => $request->komentar
            ]
        );
        return response()->json(['message' => 'Nilai updated']);
    }
}
