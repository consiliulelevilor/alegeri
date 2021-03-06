<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = 'campaigns';
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
        'opened_until',
    ];
    protected $casts = [
        'is_visible' => 'bool',
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
    protected static $logName = 'campaign';

    public function applications()
    {
        return $this->hasMany('App\Application', 'campaign_id');
    }

    public function applicants()
    {
        return $this->belongsToMany('App\User', 'applications', 'campaign_id', 'user_id')
                    ->withPivot(
                        'user_name', 'user_email', 'user_city', 'user_region',
                        'user_institution', 'user_class', 'user_description',
                        'question1', 'question2', 'question3', 'question4', 'question5',
                        'status'
                    )->withTimestamps();
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeHidden($query)
    {
        return $query->where('is_visible', false);
    }

    public function scopeExecutive($query)
    {
        return $query->where('type', 'executive');
    }

    public function scopeScholarExecutive($query)
    {
        return $query->where('type', 'executive-scholar');
    }

    public function scopeRegional($query)
    {
        return $query->where('type', 'regional');
    }

    public function scopeInstitutional($query)
    {
        return $query->where('type', 'institutional');
    }

    public function imageUrl()
    {
        if ($this->image) {
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }

            if (config('voyager.storage.disk') == 'public') {
                return asset('/storage/'.$this->image);
            }

            if (in_array(config('voyager.storage.disk'), ['gcs', 's3'])) {
                return Storage::disk(config('voyager.storage.disk'))->url($this->image);
            }
        }
    }

    public function isExpired()
    {
        return (bool) ($this->opened_until && $this->opened_until->isPast());
    }

    public function acceptsApplications()
    {
        return (bool) (! $this->isExpired());
    }
}
