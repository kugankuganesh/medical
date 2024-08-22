<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prescription;

class PrescriptionItem extends Model
{
    protected $table = 'prescription_items';
    protected $fillable = ['prescription_id', 'name', 'quantity', 'amount', 'total','status'];
    use HasFactory;

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
