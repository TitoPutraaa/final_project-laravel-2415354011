<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ["customer_id", "name", "email", "phone", "addreess", "status"];

    protected function casts() {
        return ["status" => "boolean", "phone" => "string"];
    }

    public function subscriptions():HasMany {
        return $this->hasMany(Subscription::class);
    }
}
