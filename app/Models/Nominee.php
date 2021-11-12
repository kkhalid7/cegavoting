<?php

namespace VotingSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    public $timestamps = false;

    public function categories()
    {
        return $this->belongsToMany(NomineeCategory::class,'category_nominee');
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        return $this;
    }

    public function avatar()
    {
        return $this->hasOne(NomineeImage::class,'nominee_id');
    }
}
