<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total_amount',
        'shipping_address',
        'phone',
        'payment_method',
        'payment_token',
        'status',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-purple-100 text-purple-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'challenge' => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusText()
    {
        return ucfirst($this->status);
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'paid']);
    }

    public function canBeShipped()
    {
        return $this->status === 'paid';
    }

    public function canBeDelivered()
    {
        return $this->status === 'shipped';
    }

    /**
     * Calculate the tax amount (11%)
     * 
     * @return float
     */
    public function getTaxAmount()
    {
        return round($this->total_amount * 0.11);
    }

    /**
     * Check if the total_amount already includes tax
     * This helps with backward compatibility for older orders
     * 
     * @return bool
     */
    public function includesTax()
    {
        $withTax = $this->total_amount + $this->getTaxAmount();
        // Allow for minor rounding differences
        return abs($this->total_amount - $withTax) < 10;
    }

    /**
     * Get the total amount with tax
     * 
     * @return float
     */
    public function getTotalWithTax()
    {
        if ($this->includesTax()) {
            return $this->total_amount;
        }
        return $this->total_amount + $this->getTaxAmount();
    }
}
