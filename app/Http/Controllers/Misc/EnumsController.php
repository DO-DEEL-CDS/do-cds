<?php

namespace App\Http\Controllers\Misc;

use App\Enums\Batch;
use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use App\Enums\ProspectStatus;
use App\Enums\TrainingStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class EnumsController extends Controller
{
    public function projectStatuses(): JsonResponse
    {
        return $this->success(ProjectStatus::asArray());
    }

    public function batches(): JsonResponse
    {
        return $this->success(Batch::asArray());
    }

    public function projectTypes(): JsonResponse
    {
        return $this->success(ProjectType::asArray());
    }

    public function prospectStatuses(): JsonResponse
    {
        return $this->success(ProspectStatus::asArray());
    }

    public function trainingStatuses(): JsonResponse
    {
        return $this->success(TrainingStatus::asArray());
    }
}
