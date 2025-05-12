<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomCategoryImage extends Model
{
    use HasFactory;

    protected $fillable = ['room_category_id', 'image', 'caption', 'order'];

    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class);
    }
}
