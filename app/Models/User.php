<?php

namespace App\Models;
use App\Traits\ImageTrait;
use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Junaidnasir\Larainvite\InviteTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoleAndPermission, Notifiable, ImageTrait, HasApiTokens, SoftDeletes, InviteTrait;
    use ImageTrait {
        deleteImage as traitDeleteImage;
    }

    const BLOCK_UNBLOCK_EVENT = 1;
    const NEW_PRIVATE_CONVERSATION = 2;
    const ADDED_TO_GROUP = 3;
    const PRIVATE_MESSAGE_READ = 4;
    const MESSAGE_DELETED = 5;
    const MESSAGE_NOTIFICATION = 6;
    const CHAT_REQUEST = 7;
    const CHAT_REQUEST_ACCEPTED = 8;

    const PROFILE_UPDATES = 1;
    const STATUS_UPDATE = 2;
    const STATUS_CLEAR = 3;
    
    const FILTER_UNARCHIVE = 1;
    const FILTER_ARCHIVE = 2;
    const FILTER_ACTIVE = 3;
    const FILTER_INACTIVE = 4;
    const FILTER_ALL = 5;
    
    const FILTER_ARRAY = [
        self::FILTER_ALL => 'Select Status (ALL)',
        self::FILTER_UNARCHIVE => 'Unarchive',
        self::FILTER_ARCHIVE => 'Archive',
        self::FILTER_ACTIVE => 'Active',
        self::FILTER_INACTIVE => 'Inactive',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'country',
        'last_seen',
        'is_online',
        'about',
        'photo_url',
        'activation_code',
        'is_active',
        'is_system',
        'email_verified_at',
        'player_id',
        'is_subscribed',
        'gender',
        'privacy',
        'language',
        'parent_id',
    ];

    const LANGUAGES = [
        'en' => 'English',
        'es' => 'Spanish',
        'fr' => 'French',
        'de' => 'German',
        'ru' => 'Russian',
        'pt' => 'Portuguese',
        'ar' => 'Arabic',
        'zh' => 'Chinese',
        'tr' => 'Turkish',
        'it' => 'Italian'
    ];

    static $PATH = 'users';
    const HEIGHT = 250;
    const WIDTH = 250;
    
    const MALE = 1;
    const FEMALE = 2;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'role_name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'integer',
        'name'              => 'string',
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'is_subscribed'     => 'boolean',
        'player_id'         => 'string',
        'privacy'           => 'integer',
        'gender'            => 'integer',
        'archive'           => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'    => 'required|string|max:100',
        'phone'   => 'nullable|integer',
        'role_id' => 'required|integer',
        'privacy' => 'required',
        //        'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
        'email'   => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        //        'gender'   => 'required|integer',
    ];

    public static $messages = [
        'phone.integer'    => 'Please enter valid phone number',
        'phone.digits'     => 'The phone number must be 10 digits long',
        'email.regex'      => 'Please enter valid email',
        'role_id.required' => 'Please select user role',
    ];

    /**
     * @param $value
     *
     * @return string
     */
    public function getPhotoUrlAttribute($value)
    {
        if (! empty($value)) {
            return $this->imageUrl(self::$PATH.DIRECTORY_SEPARATOR.$value);
        }

        if ($this->gender == self::MALE) {
            return asset('assets/icons/male.png');
        }
        if ($this->gender == self::FEMALE) {
            return asset('assets/icons/female.png');
        }

        return getUserImageInitial($this->id, $this->name);
    }

    /**
     * @return string
     */
    public function getRoleNameAttribute()
    {
        $userRoles = array();
        if (!empty($this->roles)) {
            $userRoles = $this->roles->first();
        }

        return (! empty($userRoles)) ? $userRoles->name : '';
    }

    /**
     * @return string
     */
    public function getRoleIdAttribute()
    {
        $userRoles = array();
        if (!empty($this->roles)) {
            $userRoles = $this->roles->first();
        }

        return (! empty($userRoles)) ? $userRoles->id : '';
    }

    /**
     * @return array
     */
    public function webObj()
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'last_seen' => $this->last_seen,
            'about'     => $this->about,
            'photo_url' => $this->photo_url,
            'gender'    => $this->gender,
            'privacy'   => $this->privacy,
        ];
    }

    /**
     * @return array
     */
    public function apiObj()
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'email_verified_at' => (! empty($this->email_verified_at)) ? $this->email_verified_at->toDateTimeString() : '',
            'phone'             => $this->phone,
            'last_seen'         => $this->last_seen,
            'is_online'         => $this->is_online,
            'is_active'         => $this->is_active,
            'gender'            => $this->gender,
            'about'             => $this->about,
            'photo_url'         => $this->photo_url,
            'activation_code'   => $this->activation_code,
            'created_at'        => (! empty($this->created_at)) ? $this->created_at->toDateTimeString() : '',
            'updated_at'        => (! empty($this->updated_at)) ? $this->updated_at->toDateTimeString() : '',
            'is_system'         => $this->is_system,
            'role_name'         => (! $this->roles->isEmpty()) ? $this->roles->first()->name : null,
            'role_id'           => (! $this->roles->isEmpty()) ? $this->roles->first()->id : null,
            'privacy'           => $this->privacy,
            'archive'           => (!empty($this->deleted_at)) ? 1 : 0,
        ];
    }

    /**
     * @return bool
     */
    public function deleteImage()
    {
        $image = $this->getOriginal('photo_url');
        if (empty($image)) {
            return true;
        }
        $this->update(['photo_url' => null]);

        return $this->traitDeleteImage(self::$PATH.DIRECTORY_SEPARATOR.$image);
    }

    /**
     * @return HasMany
     */
    public function blockedBy()
    {
        return $this->hasMany(BlockedUser::class, 'blocked_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasMany(UserDevice::class, 'user_id');
    }
    
    /**
     * @return HasOne
     */
    public function userStatus()
    {
        return $this->hasOne(UserStatus::class);
    }

    /**
     * @return HasOne
     */
    public function reportedUser()
    {
        return $this->hasOne(ReportedUser::class, 'reported_to')->where('reported_by', '=', Auth::id());
    }

    /**
     * User Profile Relationships.
     *
     * @var array
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    // User Profile Setup - SHould move these to a trait or interface...

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name == $name) {
                return true;
            }
        }

        return false;
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }
    
    /**
     * @return belongsTo
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(User::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function titles()
    {
        return $this->hasMany(UserTitle::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}
