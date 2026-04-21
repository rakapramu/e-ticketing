<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Gate extends Model
{
    use HasUlids;

    protected $keyType = 'string';
    public $incrementing = false;
}
