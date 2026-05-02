<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Peserta extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $last = self::orderBy('id_participant', 'desc')->first();

            if (!$last) {
                $number = 1;
            } else {
                $lastNumber = (int) substr($last->id_participant, 5);
                $number = $lastNumber + 1;
            }

            $model->id_participant = 'PSRT-' . str_pad($number, 5, '0', STR_PAD_LEFT);
        });
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function gelar()
    {
        return $this->belongsTo(Gelar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function abstrac()
    {
        return $this->hasMany(AbstracAdmission::class);
    }
}
