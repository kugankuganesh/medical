<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrescriptionItem;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'note',
        'delivery_address',
        'delivery_time',
    ];

   

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(PrescriptionImage::class);
    }
    public function items()
    {
        return $this->hasMany(PrescriptionItem::class);
    }
}

