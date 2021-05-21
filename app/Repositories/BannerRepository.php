<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\BaseRepository;

/**
 * Class BannerRepository
 * @package App\Repositories
 * @version May 21, 2021, 6:11 am UTC
*/

class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'image_url'
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
        return Banner::class;
    }
}
