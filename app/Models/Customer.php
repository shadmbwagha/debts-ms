<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Debt;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ["name", "contact", "address"];

    public function debt()
    {
        return $this->hasMany(Debt::class);
    }
}
