<?php

namespace App\Http\Controllers;

use App\DataTables\AdderssDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAdderssRequest;
use App\Http\Requests\UpdateAdderssRequest;
use App\Repositories\AdderssRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AdderssController extends AppBaseController
{
    /** @var  AdderssRepository */
    private $adderssRepository;

    public function __construct(AdderssRepository $adderssRepo)
    {
        $this->adderssRepository = $adderssRepo;
    }

    /**
     * Display a listing of the Adderss.
     *
     * @param AdderssDataTable $adderssDataTable
     * @return Response
     */
    public function index(AdderssDataTable $adderssDataTable)
    {
        return $adderssDataTable->render('addersses.index');
    }

    /**
     * Show the form for creating a new Adderss.
     *
     * @return Response
     */
    public function create()
    {
        return view('addersses.create');
    }

    /**
     * Store a newly created Adderss in storage.
     *
     * @param CreateAdderssRequest $request
     *
     * @return Response
     */
    public function store(CreateAdderssRequest $request)
    {
        $input = $request->all();

        $adderss = $this->adderssRepository->create($input);

        Flash::success('Adderss saved successfully.');

        return redirect(route('addersses.index'));
    }

    /**
     * Display the specified Adderss.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $adderss = $this->adderssRepository->find($id);

        if (empty($adderss)) {
            Flash::error('Adderss not found');

            return redirect(route('addersses.index'));
        }

        return view('addersses.show')->with('adderss', $adderss);
    }

    /**
     * Show the form for editing the specified Adderss.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $adderss = $this->adderssRepository->find($id);

        if (empty($adderss)) {
            Flash::error('Adderss not found');

            return redirect(route('addersses.index'));
        }

        return view('addersses.edit')->with('adderss', $adderss);
    }

    /**
     * Update the specified Adderss in storage.
     *
     * @param  int              $id
     * @param UpdateAdderssRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdderssRequest $request)
    {
        $adderss = $this->adderssRepository->find($id);

        if (empty($adderss)) {
            Flash::error('Adderss not found');

            return redirect(route('addersses.index'));
        }

        $adderss = $this->adderssRepository->update($request->all(), $id);

        Flash::success('Adderss updated successfully.');

        return redirect(route('addersses.index'));
    }

    /**
     * Remove the specified Adderss from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $adderss = $this->adderssRepository->find($id);

        if (empty($adderss)) {
            Flash::error('Adderss not found');

            return redirect(route('addersses.index'));
        }

        $this->adderssRepository->delete($id);

        Flash::success('Adderss deleted successfully.');

        return redirect(route('addersses.index'));
    }
}
