<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Course extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])
        ->useLogName('fgs_courses')
        ->logOnlyDirty()
        ->dontLogIfAttributesChangedOnly(['updated_at'])
        ->dontSubmitEmptyLogs();
        // Chain fluent methods for configuration options
    }

    public function studyBoardName()
    {
        return $this->belongsTo(StudyBoard::class, 'study_board_id')->withDefault();
    }

    public function courseMainCategory(){

        return $this->belongsTo(Category::class, 'course_main_category')->withDefault();
    }

    public function courseMediumName(){

        return $this->belongsTo(Category::class, 'medium_cat_id')->withDefault();
    }

    public function courseCategory(){

        return $this->belongsTo(Category::class, 'course_cat_id')->withDefault();
    }

    public function courseApplicationOpenMethod(){

        return $this->belongsTo(Category::class, 'course_application_open_method')->withDefault();
    }
}
