<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'job_title',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the orders created by the user.
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the deliveries created by the user.
     */
    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }

    /**
     * Get the sales created by the user.
     */
    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
