<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = 'applications';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $guarded = [];
    protected $hidden = [
        //
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        //
    ];
    protected $touches = [
        //
    ];
    public $incrementing = true;
    public $timestamps = true;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = false;

    public function campaign()
    {
        return $this->belongsTo('App\Campaign', 'campaign_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }

    public function scopeOnCampaign($query, Campaign $campaign)
    {
        return $query->where('campaign_id', $campaign->id);
    }
}
