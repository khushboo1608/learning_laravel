<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostAPIRequest;
use App\Http\Requests\API\UpdatePostAPIRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PostController
 * @package App\Http\Controllers\API
 */

class PostAPIController extends AppBaseController
{
    /** @var  PostRepository */
    private $PostRepository;

    public function __construct(PostRepository $PostRepo)
    {
        $this->PostRepository = $PostRepo;
    }

    /**
     * Display a listing of the Post.
     * GET|HEAD /Posts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $Posts = $this->PostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($Posts->toArray(), 'Posts retrieved successfully');
    }

    /**
     * Store a newly created Post in storage.
     * POST /Posts
     *
     * @param CreatePostAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostAPIRequest $request)
    {
        $input = $request->all();

        $Post = $this->PostRepository->create($input);

        return $this->sendResponse($Post->toArray(), 'Post saved successfully');
    }

    /**
     * Display the specified Post.
     * GET|HEAD /Posts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Post $Post */
        $Post = $this->PostRepository->find($id);

        if (empty($Post)) {
            return $this->sendError('Post not found');
        }

        return $this->sendResponse($Post->toArray(), 'Post retrieved successfully');
    }

    public function all()
    {
       //$Post = $this->PostRepository->get();
        $Post = Post::select("posts.id",
                            "posts.articles_id",
                            "articles.title as articles_name",
                            "posts.title",
                            "posts.description",
                            "posts.image_url"
                            )
                ->leftJoin("articles", "articles.id", "=", "posts.articles_id")
                ->get();
        if (empty($Post)) {
            return $this->sendError('Post not found');
        }

        return $this->sendResponse($Post->toArray(), 'Post retrieved successfully');
    }

    /**
     * Update the specified Post in storage.
     * PUT/PATCH /Posts/{id}
     *
     * @param int $id
     * @param UpdatePostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostAPIRequest $request)
    {
        $input = $request->all();

        /** @var Post $Post */
        $Post = $this->PostRepository->find($id);

        if (empty($Post)) {
            return $this->sendError('Post not found');
        }

        $Post = $this->PostRepository->update($input, $id);

        return $this->sendResponse($Post->toArray(), 'Post updated successfully');
    }

    /**
     * Remove the specified Post from storage.
     * DELETE /Posts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Post $Post */
        $Post = $this->PostRepository->find($id);

        if (empty($Post)) {
            return $this->sendError('Post not found');
        }

        $Post->delete();

        return $this->sendSuccess('Post deleted successfully');
    }
}
