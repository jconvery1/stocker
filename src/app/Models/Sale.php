<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'sale_price',
        'user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user that made the sale.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the customer that belongs to the sale.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get the stock sales for the sale.
     */
    public function stock_sale()
    {
        return $this->hasMany(StockSale::class);
    }
}
