<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'produto',
        'tamanho',
        'cor',
        'quantidade',
        'customerName',
        'customerEmail',
        'customerPhone',
        'scheduledDate'
    ];
}
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'title', 'date', 'time', 'description'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
