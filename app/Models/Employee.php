<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    //semua data dari form, akan masuk ke database. Cer igt ada guarded dan fillable. Ada diceritakan dlm webprogrammingunpas pasal tu
    protected $guarded = [];
}
