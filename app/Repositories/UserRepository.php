<?php

namespace App\Repositories;

use App\Enums\GMBStatus;
use App\Models\User;
use DB;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\ValidatedInput;
use Throwable;

class UserRepository extends BaseRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * Instantiate repository
     *
     * @param  User  $model
     */
    public function __construct()
    {
        parent::__construct(new User());
    }

    /**
     * @param  array  $data
     * @return User|Model
     * @throws Throwable
     */
    public function createAccount(array $data)
    {
        if (empty($data['password'])) {
            $data['password'] = \Str::random();
        }
        if (!empty($data['deployed_state'])) {
            $data['state_code'] = $data['deployed_state'];
        }

        try {
            DB::beginTransaction();
            $user = $this->addUser($data);
            $user->markEmailAsVerified();
            $this->createProfile($user, $data);
            $user->api_token = $this->generateApiKey($user);

            $user->assignRole('corper');
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $user;
    }

    public function addUser(array $data)
    {
        abort_if(User::whereEmail($data['email'])->exists(), Response::HTTP_BAD_REQUEST, 'Account Already Exist');

        $data['password'] = Hash::make($data['password']);
        $data['email_verified_at'] = now();
        return User::create($data);
    }

    public function createProfile(User $user, array $data): User
    {
        $user->profile()->create($data);
        $user->refresh();
        $user->load('profile');
        return $user;
    }

    public function generateApiKey(User $user): string
    {
//        $this->deleteAPiIKeys($user);
        $token = $user->createToken($user->name);
        return explode('|', $token->plainTextToken)[1];
    }

    public function deleteAPiIKeys(User $user): string
    {
        $user->tokens()->delete();
        return true;
    }

    public function findByEmail(string $email): User
    {
        return User::whereEmail($email)->firstOrFail();
    }

    public function setPassword(User $user, $password): User
    {
        $user->update([
            'password' => Hash::make($password)
        ]);

        return $user;
    }

    public function getCurrentUser(string $deviceId, bool $withNewToken = false): User
    {
        $user = $this->getUserData(request()->user(), true);

        if ($deviceId) {
            $user->device_id = $deviceId;
            $user->update();
        }

        if ($withNewToken) {
            $user->api_token = $this->generateApiKey($user);
        }
        return $user;
    }

    public function getUserData(User $user, bool $withAuth = false): User
    {
        $user->load(['profile']);

        if ($withAuth) {
            $user->load(['permissions', 'roles']);
        }

        return $user;
    }

    public function updateUser(User $user, ValidatedInput $data): User
    {
        $user->update($data->all());

        $user->profile()->update($data->only('photo', 'deployed_state', 'nysc_call_up_number', 'nysc_state_code', 'phone_number'));
        $user->refresh();
        return $this->getUserData($user);
    }

    public function getUsers(array $search): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::query()
            ->with('profile')
            ->withCount(['attendance', 'businesses'])
            ->role('corper')
            ->search($search)
            ->orderBy('id', 'desc')
            ->paginate($search['per_page'] ?? 15);
    }

    public function adminGetUser(User $user): User
    {
        return $user->load([
            'profile',
            'businesses',
            'permissions',
            'roles',
            'attendance'
        ]);
    }

    public function getFUllUserProfile(User $user): User
    {
        $user->load([
            'permissions',
            'roles',
            'profile',
            'unreadNotifications',
            'businesses' => function ($q) {
                $q->where('status', GMBStatus::approved);
            }
        ]);
        $user->loadCount([
            'attendance',
            'businesses' => function ($q) {
                $q->where('status', GMBStatus::approved);
            }
        ]);
        $user->gmb_project_status = $this->getUserGmbProgress($user);

        return $user;
    }

    public function getUserGmbProgress(User $user, int $max = 10): array
    {
        $userBusinessCount = $user->businesses()->where('gmb_submissions.status')->count();
        $userApprovedBusinessCount = $user->businesses()->where('gmb_submissions.status', GMBStatus::approved)->count();
        return [
            'submitted' => $userBusinessCount,
            'approved' => $userApprovedBusinessCount,
            'recommended_max' => $max,
            'percentage' => $max > 0 ? round(($userApprovedBusinessCount / $max) * 100) : 0,
        ];
    }

    public function getNotifications(User $user, array $data): \Illuminate\Contracts\Pagination\Paginator
    {
        switch ($data['status'] ?? '') {
            case 'read':
                $notifications = $user->readNotifications();
                break;
            case 'unread':
                $notifications = $user->unreadNotifications();
                break;
            default:
                $notifications = $user->notifications();
        }

        $notifications = $notifications->simplePaginate(50);
        return $notifications;
    }

    public function markNotificationsRead(User $user, array $ids): int
    {
        return $user->notifications()->whereIn('notifications.id', $ids)->update(['read_at', now()]);
    }
}
