<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingAttendance;
use App\Repositories\AttendanceRepository;
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request, Training $training): JsonResponse
    {
        $this->attendanceRepository->recordAttendance($training, $request->user());
        return $this->success();
    }

    /**
     * Display the specified resource.
     *
     * @param  TrainingAttendance  $trainingAttendance
     * @return Response
     */
    public function show(TrainingAttendance $trainingAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  TrainingAttendance  $trainingAttendance
     * @return Response
     */
    public function update(Request $request, TrainingAttendance $trainingAttendance)
    {
        //
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
}
