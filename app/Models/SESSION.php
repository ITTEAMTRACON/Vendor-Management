<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SESSION extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'SURVEY';
	public $timestamps = false;
	public $incrementing = false;
    protected $table = 'SESSION';
    protected $primaryKey = 'SESSION_ID';

    public function getCreatedDateAttribute()
    {
        if($this->SESSION_CREATED_AT!=''){
            $data = date("d-m-Y H:i:s", strtotime($this->SESSION_CREATED_AT));
        }else{
            $data = '-';
        }
        return $data;
    }

    public function getUpdatedDateAttribute()
    {
        if($this->SESSION_UPDATE_AT!=''){
            $data = date("d-m-Y H:i:s", strtotime($this->SESSION_UPDATE_AT));
        }else{
            $data = '-';
        }
        return $data;
    }

 
}
