<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CourseFees extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])
        ->useLogName('fgs_course_fees')
        ->logOnlyDirty()
        ->dontLogIfAttributesChangedOnly(['updated_at'])
        ->dontSubmitEmptyLogs();
        // Chain fluent methods for configuration options
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code');
    }

    public function incomeType(){

        return $this->belongsTo(IncomeType::class, 'pay_income_type_id');
    }
}
