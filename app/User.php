<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\HasActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use TCG\Voyager\Models\User as VoyagerUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends VoyagerUser implements HasMedia
{
    use HasActivity, HasApiTokens, HasMediaTrait, Notifiable, SoftDeletes;

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
    protected static $logOnlyDirty = false;

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

    public function avatarUrl()
    {
        if ($this->avatar) {
            if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
                return $this->avatar;
            }

            return asset('/storage/'.$this->avatar);
        }

        $this->load(['facebook', 'google', 'instagram']);

        if ($this->facebook) {
            return $this->facebook->avatar_url;
        }

        if ($this->google) {
            return $this->google->avatar_url;
        }

        if ($this->instagram) {
            return $this->instagram->avatar_url;
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
            $this->region && $this->institution
        );
    }
}
