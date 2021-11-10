<?php

namespace App\Repositories;

use App\Models\Employer;
use App\Models\Employment;
use App\Models\Roles\Corper;
use App\Notifications\JobPublished;
use Illuminate\Contracts\Pagination\Paginator;

class EmploymentRepository extends BaseRepository
{
    /**
     * Instantiate repository
     *
     * @param  Employment  $model
     */
    public function __construct(Employment $model)
    {
        parent::__construct($model);
    }

    public function getLatestJobs(array $search): Paginator
    {
        return Employment::latest()
            ->search($search)
            ->open()
            ->paginate($search['per_page'] ?? 15);
    }

    public function createJob(array $data): Employment
    {
        $employerData = [
            'logo' => $data['employer_logo'],
            'name' => $data['employer_name'],
            'email' => $data['employer_email'] ?? '',
            'location' => $data['employer_location'],
        ];

        $employer = Employer::updateOrCreate(['name' => $employerData['name']], $employerData);

        $job = $employer->employments()->create($data);
        $job->load('employer');

        Corper::notifyAll(new JobPublished($job));

        return $job;
    }

    public function updateJob(Employment $job, array $data)
    {
        $employerData = [];

        if (!empty($data['employer_logo'])) {
            $employerData['logo'] = $data['employer_logo'];
        }

        if (!empty($data['employer_name'])) {
            $employerData['name'] = $data['employer_name'];
        }

        if (!empty($data['employer_email'])) {
            $employerData['email'] = $data['employer_email'];
        }

        if (!empty($data['employer_location'])) {
            $employerData['location'] = $data['employer_location'];
        }

        $job->employer->update($employerData);
        $job->update($data);
        $job->refresh();
        $job->load('employer');
        return $job;
    }

    public function deleteJob(Employment $job)
    {
        if ($job->employer->employments()->count() === 1) {
            $job->employer()->delete();
        }
        return $job->delete();
    }
}
