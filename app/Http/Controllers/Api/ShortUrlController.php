<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    /* List all short URLs for the authenticated user */
    public function index(Request $request)
    {
        $shortUrls = $request->user()
            ->shortUrls()
            ->latest()
            ->paginate(10);

        return response()->json($shortUrls);
    }

    /* Create a new short URL */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'original_url' => ['required', 'url', 'max:2048'],
            'expires_at' => ['nullable', 'date', 'after:now'],
        ]);


        do {
            $shortCode = Str::random(6);
        } while (ShortUrl::where('short_code', $shortCode)->exists());

        $shortUrl = $request->user()->shortUrls()->create([
            'original_url' => $validated['original_url'],
            'short_code' => $shortCode,
            'expires_at' => $validated['expires_at'] ?? null,
        ]);

        return response()->json([
            'message' => 'Short URL created successfully',
            'data' => $shortUrl,
        ], 201);
    }

    /* Show details of a specific short URL */
    public function show(ShortUrl $url)
    {
        $this->authorize('view', $url);

        return response()->json([
            'data' => $url
        ], 200);
    }

    public function update(Request $request, ShortUrl $url)
    {
        $this->authorize('update', $url);

        $validated = $request->validate([
            'original_url' => ['sometimes', 'required', 'url', 'max:2048'],
            'expires_at' => ['nullable', 'date', 'after:now'],
        ]);

        $url->update($validated);

        return response()->json([
            'message' => 'Short URL updated successfully',
            'data' => $url,
        ], 200);
    }

    /* Delete a short URL */
    public function destroy(ShortUrl $url)
    {
        $this->authorize('delete', $url);

        $url->delete();

        return response()->json([
            'message' => 'Short URL deleted successfully',
        ], 200);
    }
}
