<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling_info extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','customer_name','customer_email','customer_phone','product_name','product_price','product_quantity'];
}
