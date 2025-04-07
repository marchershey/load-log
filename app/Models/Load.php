<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Load extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'bol',
        'trailer_id',
        'lane_id',
        'date',
        'created_by',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
            }
        });
    }

    public function trailer(): BelongsTo
    {
        return $this->belongsTo(Trailer::class);
    }

    public function lane(): BelongsTo
    {
        return $this->belongsTo(Lane::class);
    }

    static function createLoad($data): Load
    {
        // Check to see if trailer exists
        $trailer = Trailer::firstOrCreate([
            'number' => $data['trailer_number'],
            'lane_id' => $data['lane_id'],
        ]);

        return Load::create([
            'number' => $data['number'],
            'bol' => $data['bol'],
            'trailer_id' => $trailer->id,
            'lane_id' => $data['lane_id'],
            'date' => $data['date'],
        ]);
    }
}
