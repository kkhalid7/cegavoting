<?php

namespace VotingSystem\Models;

use Illuminate\Database\Eloquent\Model;

class NomineeImage extends Model
{

    public $timestamps = false;

    public function nominee()
    {
        return $this->belongsTo(Nominee::class);
    }
}
