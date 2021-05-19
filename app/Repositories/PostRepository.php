<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Image;
use Illuminate\Http\Request;
/**
 * Class PostRepository
 * @package App\Repositories
 * @version May 7, 2021, 10:52 am UTC
*/

class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'image_url',
        'articles_id'
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
        return Post::class;
    }

 
}
