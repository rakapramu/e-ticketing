<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
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
}
