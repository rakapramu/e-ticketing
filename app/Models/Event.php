<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id'])]
class Event extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::deleting(function ($model) {
            if ($model->foto) {
                Storage::disk('public')->delete($model->foto);
            }
        });
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryEvent::class, 'category_id');
    }

    public function regisUlang(): HasManyThrough
    {
        return $this->hasManyThrough(
            RegisUlang::class,
            Order::class,
            'event_id',
            'order_id',
            'id',
            'id'
        );
    }
}
