<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Repositories\TrainingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrainingController extends Controller
{
    private TrainingRepository $trainingRepository;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $trainings = $this->trainingRepository->getUpcomingTraining();
        return $this->success($trainings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Training  $training
     * @return JsonResponse
     */
    public function show(Training $training): JsonResponse
    {
        $training->load('resources');
        return $this->success($training);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Training  $training
     * @return Response
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Training  $training
     * @return Response
     */
    public function destroy(Training $training)
    {
        //
    }
}
