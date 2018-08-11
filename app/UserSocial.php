<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UserSocial extends Model
{
    use LogsActivity;

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
        'token_expiry',
    ];
    protected $casts = [
        'socialite' => 'object',
    ];
    protected $touches = [
        //
    ];
    public $incrementing = true;
    public $timestamps = true;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = false;

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
