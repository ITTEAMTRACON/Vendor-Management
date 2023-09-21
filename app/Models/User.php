<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const CREATED_AT = 'MEMBER_CREATED_AT';
    const UPDATED_AT = 'MEMBER_UPDATED_AT';
    protected $connection = 'VENDORMANAGEMENT';
	public $timestamps = true;
	public $incrementing = true;
    protected $table = 'MEMBER';
    protected $primaryKey = 'MEMBER_ID';
    protected $password = 'MEMBER_PASSWORD';
    protected $email = 'MEMBER_EMAIL';
    protected $username = 'MEMBER_COMPANY_NAME';
   

    protected $fillable = [

        'MEMBER_COMPANY_NAME' ,
        'MEMBER_PRODUCT_COMMUNITY' ,
        'MEMBER_PRODUCT_RANGE' ,
        'MEMBER_LOCATION' ,
        'MEMBER_EMAIL' ,
        'MEMBER_PASSWORD' ,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'MEMBER_PASSWORD',
        'MEMBER_REMEMBER_TOKEN',
    ];


    //code here
    public function getEmailAttribute() {
        return $this->MEMBER_EMAIL;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['MEMBER_EMAIL'] = strtolower($value);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'MEMBER_PASSWORD' => 'hashed',
    ];
    
}
