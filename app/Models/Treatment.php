<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Casts\MoneyCast;

class Treatment extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'price', 'notes'];
    
    protected $cast = [
      'price' => MoneyCast::class
     ];
    public function patient() {
      return $this->belongsTo(Patient::class);
    }
}
