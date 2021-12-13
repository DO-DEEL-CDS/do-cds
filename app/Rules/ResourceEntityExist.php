<?php

namespace App\Rules;

use App\Models\Project;
use App\Models\Training;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ResourceEntityExist implements Rule
{
    private string $entityType;

    public function __construct(Request $request)
    {
        $this->entityType = $request->input('entity_type');
    }

    public function passes($attribute, $value): bool
    {
        if ($this->entityType === 'project') {
            return Project::whereId($value)->exists();
        }

        if ($this->entityType === 'training') {
            return Training::whereId($value)->exists();
        }

        return false;
    }

    public function message(): string
    {
        return "The selected  $this->entityType does not exist";
    }
}
