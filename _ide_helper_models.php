<?php /** @noinspection ALL */

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {

    use App\Enums\ArticleStatus;
    use Database\Factories\ArticleFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Article
     *
     * @property int $id
     * @property string $title
     * @property string $image
     * @property string $content
     * @property ArticleStatus $status
     * @property User $author
     * @property int $category_id
     * @property int|null $state_code
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Category $category
     * @method static ArticleFactory factory(...$parameters)
     * @method static Builder|Article newModelQuery()
     * @method static Builder|Article newQuery()
     * @method static Builder|Article published()
     * @method static Builder|Article query()
     * @method static Builder|Article search(array $search)
     * @method static Builder|Article whereAuthor($value)
     * @method static Builder|Article whereCategoryId($value)
     * @method static Builder|Article whereContent($value)
     * @method static Builder|Article whereCreatedAt($value)
     * @method static Builder|Article whereId($value)
     * @method static Builder|Article whereImage($value)
     * @method static Builder|Article whereStateCode($value)
     * @method static Builder|Article whereStatus($value)
     * @method static Builder|Article whereTitle($value)
     * @method static Builder|Article whereUpdatedAt($value)
     */
    class Article extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\CategoryFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Category
     *
     * @property int $id
     * @property string $title
     * @property string $slug
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Article $articles
     * @method static CategoryFactory factory(...$parameters)
     * @method static Builder|Category newModelQuery()
     * @method static Builder|Category newQuery()
     * @method static Builder|Category query()
     * @method static Builder|Category whereCreatedAt($value)
     * @method static Builder|Category whereId($value)
     * @method static Builder|Category whereSlug($value)
     * @method static Builder|Category whereTitle($value)
     * @method static Builder|Category whereUpdatedAt($value)
     */
    class Category extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\EmployerFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Employer
     *
     * @property int $id
     * @property string $name
     * @property string $logo
     * @property string|null $location
     * @property string|null $email
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Collection|Employment[] $employments
     * @property-read int|null $employments_count
     * @method static EmployerFactory factory(...$parameters)
     * @method static Builder|Employer newModelQuery()
     * @method static Builder|Employer newQuery()
     * @method static Builder|Employer query()
     * @method static Builder|Employer whereCreatedAt($value)
     * @method static Builder|Employer whereEmail($value)
     * @method static Builder|Employer whereId($value)
     * @method static Builder|Employer whereLocation($value)
     * @method static Builder|Employer whereLogo($value)
     * @method static Builder|Employer whereName($value)
     * @method static Builder|Employer whereUpdatedAt($value)
     */
    class Employer extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\EmploymentFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Employment
     *
     * @property int $id
     * @property string $title
     * @property string $description
     * @property string $role
     * @property Carbon $closing_date
     * @property string|null $location
     * @property string|null $type
     * @property string|null $apply_link
     * @property int $employer_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Employer $employer
     * @method static EmploymentFactory factory(...$parameters)
     * @method static Builder|Employment newModelQuery()
     * @method static Builder|Employment newQuery()
     * @method static Builder|Employment open()
     * @method static Builder|Employment query()
     * @method static Builder|Employment search(array $search)
     * @method static Builder|Employment whereApplyLink($value)
     * @method static Builder|Employment whereClosingDate($value)
     * @method static Builder|Employment whereCreatedAt($value)
     * @method static Builder|Employment whereDescription($value)
     * @method static Builder|Employment whereEmployerId($value)
     * @method static Builder|Employment whereId($value)
     * @method static Builder|Employment whereLocation($value)
     * @method static Builder|Employment whereRole($value)
     * @method static Builder|Employment whereTitle($value)
     * @method static Builder|Employment whereType($value)
     * @method static Builder|Employment whereUpdatedAt($value)
     */
    class Employment extends Eloquent
    {
    }
}

namespace App\Models {

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
     * App\Models\Lga
     *
     * @property int $id
     * @property string $lga_name
     * @property string $lga_code
     * @property string $state_name
     * @property string $state_id
     * @property int $state_code
     * @method static Builder|Lga newModelQuery()
     * @method static Builder|Lga newQuery()
     * @method static Builder|Lga query()
     * @method static Builder|Lga whereId($value)
     * @method static Builder|Lga whereLgaCode($value)
     * @method static Builder|Lga whereLgaName($value)
     * @method static Builder|Lga whereStateCode($value)
     * @method static Builder|Lga whereStateId($value)
     * @method static Builder|Lga whereStateName($value)
     */
    class Lga extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\PageFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Page
     *
     * @property int $id
     * @property string $title
     * @property string $content
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static PageFactory factory(...$parameters)
     * @method static Builder|Page newModelQuery()
     * @method static Builder|Page newQuery()
     * @method static Builder|Page query()
     * @method static Builder|Page whereContent($value)
     * @method static Builder|Page whereCreatedAt($value)
     * @method static Builder|Page whereId($value)
     * @method static Builder|Page whereTitle($value)
     * @method static Builder|Page whereUpdatedAt($value)
     */
    class Page extends Eloquent
    {
    }
}

namespace App\Models {

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\PasswordReset
     *
     * @property string $email
     * @property string $token
     * @property Carbon|null $created_at
     * @method static Builder|PasswordReset newModelQuery()
     * @method static Builder|PasswordReset newQuery()
     * @method static Builder|PasswordReset query()
     * @method static Builder|PasswordReset whereCreatedAt($value)
     * @method static Builder|PasswordReset whereEmail($value)
     * @method static Builder|PasswordReset whereToken($value)
     */
    class PasswordReset extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\ProfileFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

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
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string|null $deleted_at
     * @property-read State $state
     * @property-read User $user
     * @method static ProfileFactory factory(...$parameters)
     * @method static Builder|Profile newModelQuery()
     * @method static Builder|Profile newQuery()
     * @method static Builder|Profile query()
     * @method static Builder|Profile whereCreatedAt($value)
     * @method static Builder|Profile whereDeletedAt($value)
     * @method static Builder|Profile whereDeployedState($value)
     * @method static Builder|Profile whereId($value)
     * @method static Builder|Profile whereNyscCallUpNumber($value)
     * @method static Builder|Profile whereNyscStateCode($value)
     * @method static Builder|Profile wherePhoneNumber($value)
     * @method static Builder|Profile wherePhoto($value)
     * @method static Builder|Profile whereStateCode($value)
     * @method static Builder|Profile whereUpdatedAt($value)
     * @method static Builder|Profile whereUserId($value)
     */
    class Profile extends Eloquent
    {
    }
}

namespace App\Models {

    use App\Enums\ProspectStatus;
    use Database\Factories\ProspectFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Notifications\DatabaseNotificationCollection;
    use Illuminate\Support\Carbon;

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
     * @property ProspectStatus $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read User $user
     * @method static ProspectFactory factory(...$parameters)
     * @method static Builder|Prospect newModelQuery()
     * @method static Builder|Prospect newQuery()
     * @method static Builder|Prospect query()
     * @method static Builder|Prospect whereCreatedAt($value)
     * @method static Builder|Prospect whereEmail($value)
     * @method static Builder|Prospect whereId($value)
     * @method static Builder|Prospect whereIntroVideo($value)
     * @method static Builder|Prospect whereName($value)
     * @method static Builder|Prospect whereNyscStateCode($value)
     * @method static Builder|Prospect whereStateCode($value)
     * @method static Builder|Prospect whereStatus($value)
     * @method static Builder|Prospect whereUpdatedAt($value)
     * @method static Builder|Prospect whereVerifyToken($value)
     */
    class Prospect extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\ResourceFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Resource
     *
     * @property int $id
     * @property string $attachment
     * @property string $resourceable_type
     * @property int $resourceable_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Model|Eloquent $resourceable
     * @property-read Collection|Profile[] $users
     * @property-read int|null $users_count
     * @method static ResourceFactory factory(...$parameters)
     * @method static Builder|Resource newModelQuery()
     * @method static Builder|Resource newQuery()
     * @method static Builder|Resource query()
     * @method static Builder|Resource whereAttachment($value)
     * @method static Builder|Resource whereCreatedAt($value)
     * @method static Builder|Resource whereId($value)
     * @method static Builder|Resource whereResourceableId($value)
     * @method static Builder|Resource whereResourceableType($value)
     * @method static Builder|Resource whereUpdatedAt($value)
     */
    class Resource extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\StateFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;

    /**
     * App\Models\State
     *
     * @property int $id
     * @property string $state_name
     * @property string $state_code
     * @property string $other_name
     * @property-read Collection|StateMember[] $members
     * @property-read int|null $members_count
     * @method static StateFactory factory(...$parameters)
     * @method static Builder|State newModelQuery()
     * @method static Builder|State newQuery()
     * @method static Builder|State query()
     * @method static Builder|State whereId($value)
     * @method static Builder|State whereOtherName($value)
     * @method static Builder|State whereStateCode($value)
     * @method static Builder|State whereStateName($value)
     */
    class State extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\StateMemberFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\StateMember
     *
     * @property int $id
     * @property string $state_code
     * @property int $user_id
     * @property int $type
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read State $state
     * @method static StateMemberFactory factory(...$parameters)
     * @method static Builder|StateMember newModelQuery()
     * @method static Builder|StateMember newQuery()
     * @method static Builder|StateMember query()
     * @method static Builder|StateMember whereCreatedAt($value)
     * @method static Builder|StateMember whereId($value)
     * @method static Builder|StateMember whereStateCode($value)
     * @method static Builder|StateMember whereType($value)
     * @method static Builder|StateMember whereUpdatedAt($value)
     * @method static Builder|StateMember whereUserId($value)
     */
    class StateMember extends Eloquent
    {
    }
}

namespace App\Models {

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;

    /**
     * App\Models\StateMembershipType
     *
     * @method static Builder|StateMembershipType newModelQuery()
     * @method static Builder|StateMembershipType newQuery()
     * @method static Builder|StateMembershipType query()
     */
    class StateMembershipType extends Eloquent
    {
    }
}

namespace App\Models {

    use App\Enums\TicketStatus;
    use Database\Factories\TicketFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Ticket
     *
     * @property int $id
     * @property string $title
     * @property string $message
     * @property TicketStatus $status
     * @property int $user_id
     * @property User $agent
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Carbon|null $deleted_at
     * @property-read Collection|TicketReply[] $replies
     * @property-read int|null $replies_count
     * @property-read User $user
     * @method static TicketFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
     * @method static Builder|Ticket onlyTrashed()
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
     * @method static Builder|Ticket withTrashed()
     * @method static Builder|Ticket withoutTrashed()
     */
    class Ticket extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\TicketReplyFactory;
    use Eloquent;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\TicketReply
     *
     * @property int $id
     * @property int $ticket_id
     * @property int $user_id
     * @property string $reply
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Carbon|null $deleted_at
     * @property-read mixed $is_agent
     * @property-read Ticket $ticket
     * @property-read User $user
     * @method static TicketReplyFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newQuery()
     * @method static Builder|TicketReply onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply query()
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereReply($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereTicketId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUserId($value)
     * @method static Builder|TicketReply withTrashed()
     * @method static Builder|TicketReply withoutTrashed()
     */
    class TicketReply extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\TrainingFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Carbon;

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
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Collection|TrainingAttendance[] $attendance
     * @property-read int|null $attendance_count
     * @property-read User|null $trainer
     * @method static TrainingFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Training newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Training newQuery()
     * @method static Builder|Training onlyTrashed()
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
     * @method static Builder|Training withTrashed()
     * @method static Builder|Training withoutTrashed()
     */
    class Training extends Eloquent
    {
    }
}

namespace App\Models {

    use Database\Factories\TrainingAttendanceFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\TrainingAttendance
     *
     * @property int $id
     * @property int $training_id
     * @property int $user_id
     * @property Carbon $created_at
     * @property-read Training $training
     * @property-read User $user
     * @method static TrainingAttendanceFactory factory(...$parameters)
     * @method static Builder|TrainingAttendance newModelQuery()
     * @method static Builder|TrainingAttendance newQuery()
     * @method static Builder|TrainingAttendance query()
     * @method static Builder|TrainingAttendance whereCreatedAt($value)
     * @method static Builder|TrainingAttendance whereId($value)
     * @method static Builder|TrainingAttendance whereTrainingId($value)
     * @method static Builder|TrainingAttendance whereUserId($value)
     */
    class TrainingAttendance extends Eloquent
    {
    }
}

namespace App\Models {

    use App\Enums\UserStatus;
    use Database\Factories\UserFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Notifications\DatabaseNotificationCollection;
    use Illuminate\Support\Carbon;
    use Laravel\Sanctum\PersonalAccessToken;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string|null $device_id
     * @property UserStatus $status
     * @property Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read Collection|Permission[] $permissions
     * @property-read int|null $permissions_count
     * @property-read Profile|null $profile
     * @property-read Collection|Role[] $roles
     * @property-read int|null $roles_count
     * @property-read Collection|PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @method static UserFactory factory(...$parameters)
     * @method static Builder|User newModelQuery()
     * @method static Builder|User newQuery()
     * @method static Builder|User permission($permissions)
     * @method static Builder|User query()
     * @method static Builder|User role($roles, $guard = null)
     * @method static Builder|User whereCreatedAt($value)
     * @method static Builder|User whereDeviceId($value)
     * @method static Builder|User whereEmail($value)
     * @method static Builder|User whereEmailVerifiedAt($value)
     * @method static Builder|User whereId($value)
     * @method static Builder|User whereName($value)
     * @method static Builder|User wherePassword($value)
     * @method static Builder|User whereRememberToken($value)
     * @method static Builder|User whereStatus($value)
     * @method static Builder|User whereUpdatedAt($value)
     */
    class User extends Eloquent
    {
    }
}

