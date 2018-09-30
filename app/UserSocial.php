<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSocial extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = 'users_socials';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = [];
    protected $hidden = [
        'token', 'socialite',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'token_expiry',
    ];
    protected $casts = [
        'socialite' => 'object',
        'is_public' => 'boolean',
    ];
    protected $touches = [
        //
    ];
    public $incrementing = true;
    public $timestamps = true;

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = [
        //
    ];
    protected static $logOnlyDirty = false;
    protected static $logName = 'social';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeFacebook($query)
    {
        return $query->where('social_type', 'facebook');
    }

    public function scopeGoogle($query)
    {
        return $query->where('social_type', 'google');
    }

    public function scopeInstagram($query)
    {
        return $query->where('social_type', 'instagram');
    }

    public function scopeSocialId($query, $socialId)
    {
        return $query->where('social_id', $socialId);
    }
}
