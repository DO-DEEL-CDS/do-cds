<?php

namespace App\Imports;

use App\Models\Roles\Admin;
use App\Models\State;
use App\Notifications\ImportSuccessNotification;
use App\Notifications\UserImportedNotification;
use App\Repositories\UserRepository;
use App\Rules\NyscStateCode;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Row;

class UsersImport implements OnEachRow, WithValidation, WithHeadingRow, WithChunkReading, WithEvents, SkipsOnFailure
{
    use SkipsFailures;

    private UserRepository $userRepository;
    public string $stateCode;

    public function __construct(State $state)
    {
        $this->userRepository = new UserRepository();
        $this->stateCode = $state->state_code;
    }


    public function onRow(Row $row): void
    {
        $data = array_merge($row->toArray(), [
            'state_code' => $this->stateCode,
        ]);
        $data['phone_number'] = str_replace($data['phone_number'], '\s', '');
        $data['password'] = \Str::random(8);

        $user = $this->userRepository->addUser($data);
        $user->markEmailAsVerified();
        $this->userRepository->createProfile($user, $data);
        $user->api_token = $this->userRepository->generateApiKey($user);
        $user->assignRole('corper');

        $user->initialPassword = $data['password'];
        $user->notify(new UserImportedNotification());
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'phone_number' => ['required', 'max:16'],
            'email' => ['sometimes', 'email:dns', 'unique:users,email', 'max:191'],
            'nysc_call_up_number' => ['required', 'string', 'max:20', 'unique:profiles'],
            'nysc_state_code' => ['required', new NyscStateCode(), 'unique:profiles', 'max:191'],
            'photo' => ['sometimes', 'active_url', 'max:191'],
        ];
    }

    public function chunkSize(): int
    {
        return 3;
    }

    public function registerEvents(): array
    {
        return [
//            ImportFailed::class => function (ImportFailed $event) {
//                Admin::notifyAll(new ImportHasFailedNotification($event, 'Users'));
//            },
            AfterImport::class => function (AfterImport $event) {
                Admin::notifyAll(new ImportSuccessNotification($event, 'Users'));
            },
        ];
    }
}
