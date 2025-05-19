<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'views',
        'score',
        'score_count',
    ];

    public function feedbacks()
    {
        return $this->hasMany(FaqFeedback::class);
    }
}

