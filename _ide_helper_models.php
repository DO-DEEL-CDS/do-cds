<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {

    /**
     * App\Models\Article
     *
     * @property int $id
     * @property string $title
     * @property string $image
     * @property string $content
     * @property \App\Enums\ArticleStatus $status
     * @property \App\Models\User $author
     * @property int $category_id
     * @property int|null $state_code
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Category $category
     * @method static \Database\Factories\ArticleFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Article published()
     * @method static \Illuminate\Database\Eloquent\Builder|Article query()
     * @method static \Illuminate\Database\Eloquent\Builder|Article search(array $search)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthor($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereCategoryId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereContent($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereImage($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
     */
    class Article extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Category
     *
     * @property int $id
     * @property string $title
     * @property string $slug
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Article $articles
     * @method static \Database\Factories\CategoryFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Category query()
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
     */
    class Category extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Employer
     *
     * @property int $id
     * @property string $name
     * @property string $logo
     * @property string|null $location
     * @property string|null $email
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employment[] $employments
     * @property-read int|null $employments_count
     * @method static \Database\Factories\EmployerFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Employer newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Employer newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Employer query()
     * @method static \Illuminate\Database\Eloquent\Builder|Employer whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employer whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employer whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employer whereLocation($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employer whereLogo($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employer whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employer whereUpdatedAt($value)
     */
    class Employer extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Employment
     *
     * @property int $id
     * @property string $title
     * @property string $description
     * @property string $role
     * @property \Illuminate\Support\Carbon $closing_date
     * @property string|null $location
     * @property string|null $type
     * @property string|null $apply_link
     * @property int $employer_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Employer $employer
     * @method static \Database\Factories\EmploymentFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Employment newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Employment open()
     * @method static \Illuminate\Database\Eloquent\Builder|Employment query()
     * @method static \Illuminate\Database\Eloquent\Builder|Employment search(array $search)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereApplyLink($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereClosingDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereLocation($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereRole($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereUpdatedAt($value)
     */
    class Employment extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Lga
     *
     * @property int $id
     * @property string $lga_name
     * @property string $lga_code
     * @property string $state_name
     * @property string $state_id
     * @property int $state_code
     * @method static \Illuminate\Database\Eloquent\Builder|Lga newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Lga newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Lga query()
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereLgaCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereLgaName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereStateId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Lga whereStateName($value)
     */
    class Lga extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Page
     *
     * @property int $id
     * @property string $title
     * @property string $content
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Database\Factories\PageFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Page query()
     * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
     */
    class Page extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\PasswordReset
     *
     * @property string $email
     * @property string $token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset query()
     * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|PasswordReset whereToken($value)
     */
    class PasswordReset extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Profile
     *
     * @property int $id
     * @property int $user_id
     * @property string $photo
     * @property string|null $deployed_state
     * @property string|null $nysc_call_up_number
     * @property string|null $nysc_state_code
     * @property string|null $phone_number
     * @property string $state_code
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string|null $deleted_at
     * @property-read \App\Models\State $state
     * @property-read \App\Models\User $user
     * @method static \Database\Factories\ProfileFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeployedState($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNyscCallUpNumber($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNyscStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhoneNumber($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhoto($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
     */
    class Profile extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Prospect
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string $nysc_state_code
     * @property string|null $state_code
     * @property string|null $verify_token
     * @property string|null $intro_video
     * @property \App\Enums\ProspectStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \App\Models\User $user
     * @method static \Database\Factories\ProspectFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect query()
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereIntroVideo($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereNyscStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Prospect whereVerifyToken($value)
     */
    class Prospect extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Resource
     *
     * @property int $id
     * @property string $attachment
     * @property string $resourceable_type
     * @property int $resourceable_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $resourceable
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $users
     * @property-read int|null $users_count
     * @method static \Database\Factories\ResourceFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
     * @method static \Illuminate\Database\Eloquent\Builder|Resource whereAttachment($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Resource whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Resource whereResourceableId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Resource whereResourceableType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUpdatedAt($value)
     */
    class Resource extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\State
     *
     * @property int $id
     * @property string $state_name
     * @property string $state_code
     * @property string $other_name
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StateMember[] $members
     * @property-read int|null $members_count
     * @method static \Database\Factories\StateFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|State query()
     * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereOtherName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|State whereStateName($value)
     */
    class State extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\StateMember
     *
     * @property int $id
     * @property int|null $user_id
     * @property string $name
     * @property string $email
     * @property string $phone_number
     * @property string|null $instagram
     * @property string|null $facebook
     * @property string|null $position
     * @property \App\Enums\StateMembershipType $type
     * @property \App\Enums\Batch $batch
     * @property string $state_code
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\State $state
     * @method static \Database\Factories\StateMemberFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember query()
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember type(\App\Enums\StateMembershipType $type)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereBatch($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereFacebook($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereInstagram($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember wherePhoneNumber($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember wherePosition($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereStateCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|StateMember whereUserId($value)
     */
    class StateMember extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\StateMembershipType
     *
     * @method static \Illuminate\Database\Eloquent\Builder|StateMembershipType newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StateMembershipType newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StateMembershipType query()
     */
    class StateMembershipType extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Ticket
     *
     * @property int $id
     * @property string $title
     * @property string $message
     * @property \App\Enums\TicketStatus $status
     * @property int $user_id
     * @property \App\Models\User $agent
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TicketReply[] $replies
     * @property-read int|null $replies_count
     * @property-read \App\Models\User $user
     * @method static \Database\Factories\TicketFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
     * @method static \Illuminate\Database\Query\Builder|Ticket onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAgent($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMessage($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
     * @method static \Illuminate\Database\Query\Builder|Ticket withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Ticket withoutTrashed()
     */
    class Ticket extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\TicketReply
     *
     * @property int $id
     * @property int $ticket_id
     * @property int $user_id
     * @property string $reply
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read mixed $is_agent
     * @property-read \App\Models\Ticket $ticket
     * @property-read \App\Models\User $user
     * @method static \Database\Factories\TicketReplyFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newQuery()
     * @method static \Illuminate\Database\Query\Builder|TicketReply onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply query()
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereReply($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereTicketId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUserId($value)
     * @method static \Illuminate\Database\Query\Builder|TicketReply withTrashed()
     * @method static \Illuminate\Database\Query\Builder|TicketReply withoutTrashed()
     */
    class TicketReply extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\Training
     *
     * @property int $id
     * @property string $title
     * @property string $overview
     * @property string $start_time
     * @property string $end_time
     * @property string $attendance_time
     * @property int $status
     * @property string|null $batch
     * @property string|null $live_video
     * @property int|null $trainer_id
     * @property int|null $created_by
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TrainingAttendance[] $attendance
     * @property-read int|null $attendance_count
     * @property-read \App\Models\User|null $trainer
     * @method static \Database\Factories\TrainingFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Training newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Training newQuery()
     * @method static \Illuminate\Database\Query\Builder|Training onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Training query()
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereAttendanceTime($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereBatch($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereCreatedBy($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereEndTime($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereLiveVideo($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereOverview($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereStartTime($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereTrainerId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Training whereUpdatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|Training withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Training withoutTrashed()
     */
    class Training extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\TrainingAttendance
     *
     * @property int $id
     * @property int $training_id
     * @property int $user_id
     * @property \Illuminate\Support\Carbon $created_at
     * @property-read \App\Models\Training $training
     * @property-read \App\Models\User $user
     * @method static \Database\Factories\TrainingAttendanceFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|TrainingAttendance newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TrainingAttendance newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TrainingAttendance query()
     * @method static \Illuminate\Database\Eloquent\Builder|TrainingAttendance whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TrainingAttendance whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TrainingAttendance whereTrainingId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TrainingAttendance whereUserId($value)
     */
    class TrainingAttendance extends \Eloquent
    {
    }
}

namespace App\Models {

    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string|null $device_id
     * @property \App\Enums\UserStatus $status
     * @property \Illuminate\Support\Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
     * @property-read int|null $permissions_count
     * @property-read \App\Models\Profile|null $profile
     * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
     * @property-read int|null $roles_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereDeviceId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent
    {
    }
}

