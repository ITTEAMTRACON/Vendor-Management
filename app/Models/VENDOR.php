<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VENDOR extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'VENDORMANAGEMENT';
	public $timestamps = false;
	public $incrementing = false;
    protected $table = 'VENDOR';
    protected $primaryKey = 'VM_ID';

    protected $fillable = [

        'VM_CODE' ,
        'VM_NAME' ,
        'VM_COMMUNITY' ,
        'VM_PRODUCTRANGE' ,
        'VM_LOCATION',
        'VM_MEMBER_UUID',
        'CREATED_DATE',
        'CREATED_BY_ID',
        'CREATED_BY_NAME',
        'UPDATED_DATE',
        'UPDATED_BY_ID',
        'UPDATED_BY_NAME',

    ];

    
}
