<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Reservation extends Model
{
    use HasFactory, HasUuids;
    
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'room_id',
        'room_category_id',
        'guests',
        'check_in_date',
        'check_out_date',
        'special_requests',
        'payment_method',
        'breakfast',
        'pets',
        'late_checkout',
        'airport_transfer',
        'status',
        'total_price',
        'tax_amount',
    ];
    
    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'breakfast' => 'boolean',
        'pets' => 'boolean',
        'late_checkout' => 'boolean',
        'airport_transfer' => 'boolean',
        'total_price' => 'float',
        'tax_amount' => 'float',
    ];
    
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
    
    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class);
    }

    // Accesseur pour le nom complet
    public function getFullNameAttribute(): string
    {
        return "{$this->title} {$this->first_name} {$this->last_name}";
    }

    // Mutateur pour calculer automatiquement la durée du séjour
    public function getStayDurationAttribute(): int
    {
        return $this->check_in_date->diffInDays($this->check_out_date);
    }

    /**
     * Calcule le prix total de la réservation
     */
    public function calculateTotalPrice()
    {
        $roomPrice = $this->roomCategory->price;
        $nights = $this->check_in_date->diffInDays($this->check_out_date);
        $basePrice = $roomPrice * $nights;
        
        // Services supplémentaires
        $extraServices = 0;
        if ($this->breakfast) $extraServices += 5000;
        if ($this->pets) $extraServices += 5000;
        
        // Taxe de séjour (fixe à 1000 FCFA)
        $tax = 1000;
        
        $this->total_price = $basePrice + $extraServices + $tax;
        $this->tax_amount = $tax;
        
        return $this->total_price;
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = (string) \Str::uuid();
        });
    }
}



