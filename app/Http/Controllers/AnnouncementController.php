<?php

namespace App\Http\Controllers;

use App\Enums\Batch;
use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private AnnouncementRepository $announcementRepository;

    public function __construct(AnnouncementRepository $announcementRepository)
    {
        $this->authorizeResource(Announcement::class);
        $this->announcementRepository = $announcementRepository;
    }

    public function index(Request $request): JsonResponse
    {
        return $this->success($this->announcementRepository->getAnnouncements($request->all()));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
                'title' => ['required', 'string', 'max:191'],
                'content' => ['required', 'string'],
                'state_code' => ['sometimes', 'exists:states'],
                'year' => ['sometimes', 'date_format:Y'],
                'batch' => ['sometimes', new EnumValue(Batch::class)],
                'user_id' => ['sometimes', 'exists:users,id'],
        ]);

        $announcement = $this->announcementRepository->createAndNotify($validated);
        return $this->success($announcement, 'Announcement Created', 201);
    }

    public function show(Announcement $announcement): JsonResponse
    {
        return $this->success($this->announcementRepository->getAnnouncement($announcement));
    }

    public function update(Request $request, Announcement $announcement): JsonResponse
    {
        $validated = $request->validate([
                'title' => ['sometimes', 'string', 'max:191'],
                'content' => ['sometimes', 'string'],
        ]);

        return $this->success($this->announcementRepository->update($announcement, $validated));
    }

    public function destroy(Announcement $announcement): JsonResponse
    {
        $this->announcementRepository->delete($announcement);
        return $this->success();
    }
}
