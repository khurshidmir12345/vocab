<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property int    $user_id
 * @property string $word_uz
 * @property string $word_en
 * @property string $description
 * @property        $spelling
 * @property        $audio
 * @property        $category
 * @property        $vocab_photos
 * @property        $vocab_example
 *
 * @property User   $user
 */
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
