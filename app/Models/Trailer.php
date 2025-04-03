<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trailer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuumber',
        'lane_id',
        'created_by',
    ];

    public function lane(): BelongsTo
    {
        return $this->belongsTo(Lane::class);
    }
}
