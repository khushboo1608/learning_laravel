<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Banner
 * @package App\Models
 * @version May 21, 2021, 6:11 am UTC
 *
 * @property string $title
 * @property string $image_url
 */
class Banner extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'banners';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'image_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'image_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image_url' => 'required'
    ];

    
}
