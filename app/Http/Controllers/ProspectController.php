<?php

namespace App\Http\Controllers;

use App\Enums\ProspectStatus;
use App\Http\Requests\UpdateProspectRequest;
use App\Models\Prospect;
use App\Repositories\ProspectRepository;
use App\Rules\NyscStateCode;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    private ProspectRepository $prospectRepository;

    public function __construct(ProspectRepository $prospectRepository)
    {
        $this->authorizeResource(Prospect::class);
        $this->prospectRepository = $prospectRepository;
    }

    public function index(Request $request): JsonResponse
    {
        return $this->success($this->prospectRepository->getProspects($request->all()));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
                'name' => ['bail', 'required', 'string', 'min:3'],
                'email' => ['bail', 'required', 'email:dns', 'unique:prospects'],
                'deployed_state' => ['bail', 'required', 'exists:states,state_code'],
                'nysc_state_code' => ['bail', 'required', new NyscStateCode(), 'unique:prospects'],
                'intro_video' => ['sometimes', 'string', 'active_url']
        ], [
                'email.unique' => 'The provided Email has Already been used to apply.',
                'nysc_state_code.unique' => 'The provided Already been used to apply.',
        ]);

        $this->prospectRepository->create($validated);
        return $this->success([], 'Application Successful', 201);
    }

    public function show(Prospect $prospect): JsonResponse
    {
        //
    }

    public function update(UpdateProspectRequest $request, Prospect $prospect): JsonResponse
    {
        $prospect = $this->prospectRepository->updateProspect($prospect, $request->validated());
        return $this->success($prospect, 'Updated Prospect');
    }


    public function updateProspectsStatus(Request $request): JsonResponse
    {
        $payload = $request->validate([
                'ids' => ['required', 'array'],
                'ids.*' => ['exists:prospects,id'],
                'status' => ['required', new EnumValue(ProspectStatus::class)]
        ]);

        $this->prospectRepository->updateProspectsStatuses($payload);
        return $this->success($payload);
    }

    public function destroy(Prospect $prospect): JsonResponse
    {
        //
    }
}
