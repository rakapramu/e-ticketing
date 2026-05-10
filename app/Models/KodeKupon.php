<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Guarded('id')]
class KodeKupon extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public function events()
    {
        return $this->belongsToMany(Event::class, 'kupon_events', 'kode_kupon_id', 'event_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
