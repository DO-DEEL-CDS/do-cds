<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use App\Models\Training;
use App\Repositories\TrainingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    private TrainingRepository $trainingRepository;

    public function __construct(TrainingRepository $trainingRepository)
    {
        $this->trainingRepository = $trainingRepository;
    }

    public function index(Request $request): JsonResponse
    {
        $trainings = $this->trainingRepository->getTrainings($request->all());
        return $this->success($trainings);
    }

    public function store(CreateTrainingRequest $request): JsonResponse
    {
        $training = $this->trainingRepository->createTraining($request->validated());
        return $this->success($training, 'Training Created', 201);
    }

    public function show(Training $training): JsonResponse
    {
        $training = $this->trainingRepository->getTraining($training);

        return $this->success($training);
    }

    public function update(UpdateTrainingRequest $request, Training $training): JsonResponse
    {
        $training = $this->trainingRepository->updateTraining($training, $request->validated());
        return $this->success($training);
    }

    public function destroy(Training $training): JsonResponse
    {
        $this->trainingRepository->deleteTraining($training);
        return $this->success();
    }
}
