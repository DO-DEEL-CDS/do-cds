<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Repositories\ProspectRepository;
use App\Rules\NyscStateCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProspectController extends Controller
{
    private ProspectRepository $prospectRepository;

    public function __construct(ProspectRepository $prospectRepository)
    {
        $this->prospectRepository = $prospectRepository;
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
    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate($request, [
            'name' => ['bail', 'required', 'string', 'min:3'],
            'email' => ['bail', 'required', 'email:dns', 'unique:prospects'],
            'deployed_state' => ['bail', 'required', 'exists:states,state_code'],
            'nysc_state_code' => ['bail', 'required', new NyscStateCode(), 'unique:prospects'],
            'intro_video' => ['sometimes', 'string', 'active_url']
        ], [
            'email.unique' => 'You Already Applied to Be a member',
            'nysc_state_code.unique' => 'You Already Applied to Be a member',
        ]);

        $this->prospectRepository->create($validated);
        return $this->success([], 'Application Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  Prospect  $prospect
     * @return Response
     */
    public function show(Prospect $prospect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Prospect  $prospect
     * @return Response
     */
    public function update(Request $request, Prospect $prospect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Prospect  $prospect
     * @return Response
     */
    public function destroy(Prospect $prospect)
    {
        //
    }
}
