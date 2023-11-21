<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        "word_uz",
        "word_en",
        "description",
        "spelling",
        "audio",
        "category",
        "vocab_photos",
        "vocab_example",
        "user_id",
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
