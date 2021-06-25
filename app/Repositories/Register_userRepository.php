<?php

namespace App\Repositories;

use App\Models\Register_user;
use App\Repositories\BaseRepository;

/**
 * Class Register_userRepository
 * @package App\Repositories
 * @version June 22, 2021, 9:00 am UTC
*/

class Register_userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Register_user::class;
    }
}
