<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable =[
        'p_Name',
        'p_Price',
        'p_Category',
        'p_Images',
        
    ];
}
