<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Order extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function regisUlang()
    {
        return $this->hasOne(RegisUlang::class);
    }
}
