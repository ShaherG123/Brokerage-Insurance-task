<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function Employee()
    {
        return $this->belongsTo(User::class);
    }
    public function Action()
    {
        return $this->belongsTo(Action::class);
    }
}
