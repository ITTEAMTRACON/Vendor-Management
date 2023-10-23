<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CONTACTPERSON extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'VENDORMANAGEMENT';
	public $timestamps = false;
	public $incrementing = false;
    protected $table = 'CONTACTPERSON';
    protected $primaryKey = 'CP_ID';

   

 
}
