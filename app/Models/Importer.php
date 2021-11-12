<?php

namespace VotingSystem\Models;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Importer extends Model
{
    const STATUS_PROCESSING = "processing";
    const STATUS_COMPLETED = "completed";
    const STATUS_COMPLETED_WITH_ERRORS = "completed_with_errors";

    const TYPE_VOTER = "voter";
    const TYPE_NOMINEES = 'nominee';
    const TYPE_NOMINEE_CATEGORY = 'nominee_category';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function getConstants($key)
    {
        $key = strtoupper($key);
        $class = $oClass = new ReflectionClass(__CLASS__);
        $constants = array_filter($class->getConstants(), function ($constant) use ($key) {
            return substr($constant, 0, strlen($key)) == $key;
        }, ARRAY_FILTER_USE_KEY);
        return array_combine($constants, $constants);
    }
}
