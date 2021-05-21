<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdderssAPIRequest;
use App\Http\Requests\API\UpdateAdderssAPIRequest;
use App\Models\Adderss;
use App\Repositories\AdderssRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AdderssController
 * @package App\Http\Controllers\API
 */

class AdderssAPIController extends AppBaseController
{
    /** @var  AdderssRepository */
    private $adderssRepository;

    public function __construct(AdderssRepository $adderssRepo)
    {
        $this->adderssRepository = $adderssRepo;
    }

    /**
     * Display a listing of the Adderss.
     * GET|HEAD /addersses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $addersses = $this->adderssRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($addersses->toArray(), 'Addersses retrieved successfully');
    }

    /**
     * Store a newly created Adderss in storage.
     * POST /addersses
     *
     * @param CreateAdderssAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAdderssAPIRequest $request)
    {
        $input = $request->all();

        $adderss = $this->adderssRepository->create($input);

        return $this->sendResponse($adderss->toArray(), 'Adderss saved successfully');
    }

    /**
     * Display the specified Adderss.
     * GET|HEAD /addersses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Adderss $adderss */
        $adderss = $this->adderssRepository->find($id);

        if (empty($adderss)) {
            return $this->sendError('Adderss not found');
        }

        return $this->sendResponse($adderss->toArray(), 'Adderss retrieved successfully');
    }

    /**
     * Update the specified Adderss in storage.
     * PUT/PATCH /addersses/{id}
     *
     * @param int $id
     * @param UpdateAdderssAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdderssAPIRequest $request)
    {
        $input = $request->all();

        /** @var Adderss $adderss */
        $adderss = $this->adderssRepository->find($id);

        if (empty($adderss)) {
            return $this->sendError('Adderss not found');
        }

        $adderss = $this->adderssRepository->update($input, $id);

        return $this->sendResponse($adderss->toArray(), 'Adderss updated successfully');
    }

    /**
     * Remove the specified Adderss from storage.
     * DELETE /addersses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Adderss $adderss */
        $adderss = $this->adderssRepository->find($id);

        if (empty($adderss)) {
            return $this->sendError('Adderss not found');
        }

        $adderss->delete();

        return $this->sendSuccess('Adderss deleted successfully');
    }
}
