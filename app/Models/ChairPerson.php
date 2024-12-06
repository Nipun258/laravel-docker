<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ChairPerson extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    protected $table = 'chair_people';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])
        ->useLogName('fgs_chair_people')
        ->logOnlyDirty()
        ->dontLogIfAttributesChangedOnly(['updated_at'])
        ->dontSubmitEmptyLogs();
        // Chain fluent methods for configuration options
    }

    public function studyBoardName()
    {
        return $this->belongsTo(StudyBoard::class, 'study_board_id')->withDefault();
    }

    public function appointmentTypeName()
    {
        return $this->belongsTo(Category::class, 'appointment_type_id')->withDefault();
    }
}
