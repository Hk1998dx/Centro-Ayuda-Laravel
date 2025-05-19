<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqFeedback extends Model
{
    use HasFactory;

    protected $fillable = ['faq_entry_id', 'score'];

    public function faqEntry()
    {
        return $this->belongsTo(FaqEntry::class);
    }
    
}
