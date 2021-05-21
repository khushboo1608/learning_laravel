<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Adderss
 * @package App\Models
 * @version May 21, 2021, 9:07 am UTC
 *
 * @property string $a_type
 * @property string $a_name
 * @property string $a_number
 * @property string $a_houser_no
 * @property string $a_lendmark
 * @property string $a_adderss
 * @property integer $user_id
 */
class Adderss extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'addersses';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'a_type',
        'a_name',
        'a_number',
        'a_houser_no',
        'a_lendmark',
        'a_adderss',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'a_type' => 'string',
        'a_name' => 'string',
        'a_number' => 'string',
        'a_houser_no' => 'string',
        'a_lendmark' => 'string',
        'a_adderss' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'a_type' => 'required',
        'a_name' => 'required',
        'a_number' => 'required',
        'a_houser_no' => 'required',
        'a_adderss' => 'user_id integer selectTable:users:name,id'
    ];

    
}
