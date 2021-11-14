<?php

namespace App\Services;

use App\Imports\GMBSubmissionImport;
use App\Imports\TrainingAttendanceImport;
use App\Imports\UsersImport;
use App\Models\State;
use App\Models\Training;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportService
{
    public static function importUsers(State $state, Request $request): void
    {
        Excel::import(new UsersImport($state), $request->file('file'));
    }

    public static function importBusinesses(Request $request): void
    {
        \Excel::import(new GMBSubmissionImport(), $request->file('file'));
    }

    public static function importTrainingAttendance(Training $training, Request $request): void
    {
        \Excel::import(new TrainingAttendanceImport($training), $request->file('file'));
    }
}
