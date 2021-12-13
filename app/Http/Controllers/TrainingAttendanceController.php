<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Repositories\AttendanceRepository;
use App\Services\ImportService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrainingAttendanceController extends Controller
{
    private AttendanceRepository $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param  Training  $training
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request, Training $training): JsonResponse
    {
        $this->authorize('view', $training);
        $this->attendanceRepository->recordAttendance($training, $request->user());
        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TrainingAttendance  $trainingAttendance
     * @return Response
     */
    public function destroy(TrainingAttendance $trainingAttendance)
    {
        //
    }

    public function import(Request $request, Training $training): JsonResponse
    {
        $this->authorize('import', TrainingAttendance::class);

        $request->validate(['file' => ['file', 'max:50000', 'mimes:csv,txt']]);
        ImportService::importTrainingAttendance($training, $request);

        return $this->success([], 'Import Queued');
    }
}
