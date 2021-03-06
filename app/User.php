<?php

namespace App;

use Laravel\Scout\Searchable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\HasActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use TCG\Voyager\Models\User as VoyagerUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends VoyagerUser implements HasMedia
{
    use Searchable, HasActivity, HasApiTokens, HasMediaTrait, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'graduation_year' => 'date:Y',
        'is_mail_subscribed' => 'bool',
        'settings' => 'array',
    ];
    protected $touches = [
        //
    ];
    public $incrementing = true;
    public $timestamps = true;

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [
        'password', 'remember_token',
    ];
    protected static $logOnlyDirty = false;
    protected static $logName = 'user';

    public function shouldBeSearchable()
    {
        return $this->canApplyToCampaigns() && $this->applications()->count() > 0;
    }

    public function socials()
    {
        return $this->hasMany('App\UserSocial', 'user_id');
    }

    public function social()
    {
        return $this->hasOne('App\UserSocial', 'user_id');
    }

    public function facebook()
    {
        return $this->social()->facebook();
    }

    public function google()
    {
        return $this->social()->google();
    }

    public function instagram()
    {
        return $this->social()->instagram();
    }

    public function applications()
    {
        return $this->hasMany('App\Application', 'user_id');
    }

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeProfile($query, $idOrSlug)
    {
        return $query->where(function ($query) use ($idOrSlug) {
            return $query->where('id', $idOrSlug)->OrWhere('profile_name', $idOrSlug);
        });
    }

    public function scopeHasCompleteProfile($query)
    {
        return $query->where('accepted_gdpr', 1)->whereNotNull('region')->whereNotNull('institution');
    }

    public function avatarUrl()
    {
        if ($this->avatar) {
            if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
                return $this->avatar;
            }

            if (is_null($this->avatar_disk) || $this->avatar_disk === 'public') {
                return asset('/storage/'.$this->avatar);
            }

            if (in_array($this->avatar_disk, ['gcs', 's3'])) {
                return Storage::disk($this->avatar_disk)->url($this->avatar);
            }
        }

        $this->load(['socials']);

        foreach ($this->socials as $social) {
            return $social->avatar_url;
        }
    }

    public function coverUrl()
    {
        if ($this->cover) {
            if (filter_var($this->cover, FILTER_VALIDATE_URL)) {
                return $this->cover;
            }

            if (is_null($this->cover_disk) || $this->cover_disk === 'public') {
                return asset('/storage/'.$this->cover);
            }

            if (in_array($this->cover_disk, ['gcs', 's3'])) {
                return Storage::disk($this->cover_disk)->url($this->cover);
            }
        }
    }

    public function profileUrl()
    {
        return route('user.profile', ['idOrSlug' => $this->profile_name]);
    }

    public function hasAppliedTo(Campaign $campaign)
    {
        return (bool) ($this->applications()->onCampaign($campaign)->count() == 1);
    }

    public function canApplyToCampaigns()
    {
        return (bool) (
            $this->accepted_gdpr && $this->region && $this->institution
        );
    }
}
