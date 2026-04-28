<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class CategoryEvent extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;

    public function event()
    {
        return $this->hasMany(Event::class, 'category_id');
    }
}
