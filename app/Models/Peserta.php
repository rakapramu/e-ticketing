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

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
