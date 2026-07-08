<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictController extends Controller
{
    public function detect(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);
        $aiServiceUrl = rtrim(config('services.ai_service.url'), '/');
        try {
            $response = Http::attach(
                'image',
                file_get_contents($request->file('image')->getRealPath()),
                'snapshot.jpg'
            )->timeout(15)->post("{$aiServiceUrl}/detect");
            if (!$response->successful()) {
                return response()->json([
                    'error' => 'AI service error',
                    'detail' => $response->body(),
                ], 502);
            }
            return response()->json($response->json());
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'error' => 'Tidak bisa terhubung ke AI service.',
            ], 503);
        }
    }
}