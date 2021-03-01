<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    protected $table = 'cash_flows';

    use HasFactory;

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
