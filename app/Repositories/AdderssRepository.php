<?php

namespace App\Repositories;

use App\Models\Adderss;
use App\Repositories\BaseRepository;

/**
 * Class AdderssRepository
 * @package App\Repositories
 * @version May 21, 2021, 9:07 am UTC
*/

class AdderssRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'a_type',
        'a_name',
        'a_number',
        'a_houser_no',
        'a_lendmark',
        'a_adderss',
        'user_id'
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
        return Adderss::class;
    }
}
