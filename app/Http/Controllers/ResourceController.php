<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Storage;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Resource::class);
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Resource $resource)
    {
        //
    }

    public function update(Request $request, Resource $resource): JsonResponse
    {
        $validated = $request->validate([
            'filename' => ['string', 'max:10'],
            'attachment' => ['file', 'mimes:jpg,png,pdf,xlsx,doc,docx,ppt', 'max:10000']
        ]);

        $deletable = $resource->attachment;
        $resource->update($validated);
        $resource->refresh();

        if ($resource->attachment !== $deletable) {
            Storage::delete($deletable);
        }

        return $this->success($resource);
    }

    public function destroy(Resource $resource): JsonResponse
    {
        $resource->delete();
        Storage::delete($resource->attachment);
        return $this->success();
    }
}
