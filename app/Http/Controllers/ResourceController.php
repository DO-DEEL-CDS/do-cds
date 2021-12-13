<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Rules\ResourceEntityExist;
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

    public function store(Request $request): JsonResponse
    {
        $valid = $request->validate([
                'attachment' => ['sometimes', 'file', 'mimes:jpg,png,pdf,xlsx,doc,docx,ppt,mp4', 'max:10000'],
                'files' => ['sometimes', 'array'],
                'files.*.attachment' => ['file', 'mimes:jpg,png,jpeg,webp,pdf,xlsx,doc,docx,ppt,txt', 'max:10000'],
                'entity_type' => ['required', 'in:project,training'],
                'entity_id' => ['required', new ResourceEntityExist($request)]
        ]);

        $resource = [];
        if (isset($valid['attachment'])) {
            $resource = new Resource();
            $resource->attachment = $valid['attachment'];
            $resource->resourceable_id = $valid['entity_id'];
            $resource->resourceable_type = $valid['entity_type'];
            $resource->save();
        }

        if (!empty($valid['files'])) {
            $resources = [];
            foreach ($valid['files'] as $file) {
                $resource = new Resource();
                $resource->attachment = $file['attachment'];
                $resource->resourceable_id = $valid['entity_id'];
                $resource->resourceable_type = $valid['entity_type'];
                $resource->save();
                $resources[] = $resource;
            }
            $resource = $resources;
        }

        return $this->success($resource, 'Resource Created', 201);
    }

    public function show(Resource $resource): JsonResponse
    {
        return $this->success($resource);
    }

    public function update(Request $request, Resource $resource): JsonResponse
    {
        $validated = $request->validate([
                'filename' => ['string', 'max:10'],
                'attachment' => ['file', 'mimes:jpg,png,pdf,xlsx,doc,docx,ppt,mp4', 'max:10000']
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
