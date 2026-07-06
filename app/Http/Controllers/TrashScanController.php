<?php

namespace App\Http\Controllers;

use App\Models\TrashScan;
use Illuminate\Http\Request;

class TrashScanController extends Controller
{
    
    public function index()
    {
        $scans = TrashScan::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($scans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'uuid' => 'required|string|unique:trash_scans,uuid',
            'object_name' => 'required|string',
            'category' => 'required|string',
            'score' => 'required|integer',
            'thumbnail' => 'nullable|string',
            'is_permanent' => 'nullable|boolean',
        ]);

        $scan = TrashScan::create([
            'uuid' => $validated['uuid'],
            'user_id' => auth()->id(),
            'object_name' => $validated['object_name'],
            'category' => $validated['category'],
            'score' => $validated['score'],
            'thumbnail' => $validated['thumbnail'] ?? null,
            'is_permanent' => $request->boolean('is_permanent', false),
        ]);

        return response()->json([
            'success' => true,
            'data' => $scan
        ], 201);
    }

    public function togglePermanent($uuid)
    {
        $scan = TrashScan::where('uuid', $uuid)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $scan->update([
            'is_permanent' => !$scan->is_permanent
        ]);

        return response()->json([
            'success' => true,
            'data' => $scan
        ]);
    }

    public function destroy($uuid)
    {
        $scan = TrashScan::where('uuid', $uuid)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $scan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Log berhasil dihapus.'
        ]);
    }

    public function clearAll()
    {
        TrashScan::where('user_id', auth()->id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Semua log berhasil dibersihkan.'
        ]);
    }
}
