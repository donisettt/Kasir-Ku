<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'qty_total',
      'sub_total',
      'pajak',
      'total',
      'tunai',
      'kembalian',
      'status'
      ];
}