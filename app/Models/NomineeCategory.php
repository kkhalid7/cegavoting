<?php

namespace VotingSystem\Models;

use Illuminate\Database\Eloquent\Model;

class NomineeCategory extends Model
{
    public $timestamps = false;

    public function nominees()
    {
        return $this->belongsToMany(Nominee::class,'category_nominee');
    }
}
