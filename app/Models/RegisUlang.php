<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class RegisUlang extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public function gate()
    {
        return $this->belongsTo(Gate::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
