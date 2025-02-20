<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'content',
        'value',
    ];

    protected $appends = [
        'numeric_value'
    ];

    const LIST_VALUE_OPTIONS = [
        'yes' => 1,
        'no' => 0,
        'never' => 4,
        'rarely' => 3,
        'sometimes' => 2,
        'usually' => 1,
        'always' => 0,
    ];

    public function getNumericValueAttribute()
    {
        return self::LIST_VALUE_OPTIONS[$this->value];
    }
}
