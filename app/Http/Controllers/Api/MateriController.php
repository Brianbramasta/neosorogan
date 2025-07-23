<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Material::with('creator')->latest()->get();
        return response()->json($materi);
    }

    public function store(Request $request)
    {
        $file_url = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_url = $file->store('materi', 'public');
        }

        $materi = Material::create([
            'title' => $request->judul,
            'content' => $request->content,
            'file_url' => $file_url,
            'created_by' => auth()->id()
        ]);

        return response()->json($materi, 201);
    }

    public function destroy($id)
    {
        Material::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
