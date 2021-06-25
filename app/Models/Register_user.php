<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class Register_user
 * @package App\Models
 * @version June 22, 2021, 9:00 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $image
 * @property integer $status
 */
class Register_user extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'register_users';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image'
        ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'phone' => 'string',
        'image' => 'string'
        ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

 
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
