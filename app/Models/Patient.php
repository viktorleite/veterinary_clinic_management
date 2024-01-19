<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;
    
    protected $fillable = ['owner_id', 'date_of_birth', 'type', 'name'];
    
    public function owner() {
      return $this->belongsTo(Owner::class);
    }
    
    public function treatments() {
      return $this->hasMany(Treatment::class);
    }
}
