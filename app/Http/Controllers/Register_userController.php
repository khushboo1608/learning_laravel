<?php

namespace App\Http\Controllers;

use App\DataTables\Register_userDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRegister_userRequest;
use App\Http\Requests\UpdateRegister_userRequest;
use App\Repositories\Register_userRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Register_userController extends AppBaseController
{
    /** @var  Register_userRepository */
    private $registerUserRepository;

    public function __construct(Register_userRepository $registerUserRepo)
    {
        $this->registerUserRepository = $registerUserRepo;
    }

    /**
     * Display a listing of the Register_user.
     *
     * @param Register_userDataTable $registerUserDataTable
     * @return Response
     */
    public function index(Register_userDataTable $registerUserDataTable)
    {
        return $registerUserDataTable->render('register_users.index');
    }

    /**
     * Show the form for creating a new Register_user.
     *
     * @return Response
     */
    public function create()
    {
        return view('register_users.create');
    }

    /**
     * Store a newly created Register_user in storage.
     *
     * @param CreateRegister_userRequest $request
     *
     * @return Response
     */
    public function store(CreateRegister_userRequest $request)
    {
        $input = $request->all();

        $registerUser = $this->registerUserRepository->create($input);

        Flash::success('Register User saved successfully.');

        return redirect(route('registerUsers.index'));
    }

    /**
     * Display the specified Register_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $registerUser = $this->registerUserRepository->find($id);

        if (empty($registerUser)) {
            Flash::error('Register User not found');

            return redirect(route('registerUsers.index'));
        }

        return view('register_users.show')->with('registerUser', $registerUser);
    }

    /**
     * Show the form for editing the specified Register_user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $registerUser = $this->registerUserRepository->find($id);

        if (empty($registerUser)) {
            Flash::error('Register User not found');

            return redirect(route('registerUsers.index'));
        }

        return view('register_users.edit')->with('registerUser', $registerUser);
    }

    /**
     * Update the specified Register_user in storage.
     *
     * @param  int              $id
     * @param UpdateRegister_userRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegister_userRequest $request)
    {
        $registerUser = $this->registerUserRepository->find($id);

        if (empty($registerUser)) {
            Flash::error('Register User not found');

            return redirect(route('registerUsers.index'));
        }

        $registerUser = $this->registerUserRepository->update($request->all(), $id);

        Flash::success('Register User updated successfully.');

        return redirect(route('registerUsers.index'));
    }

    /**
     * Remove the specified Register_user from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $registerUser = $this->registerUserRepository->find($id);

        if (empty($registerUser)) {
            Flash::error('Register User not found');

            return redirect(route('registerUsers.index'));
        }

        $this->registerUserRepository->delete($id);

        Flash::success('Register User deleted successfully.');

        return redirect(route('registerUsers.index'));
    }
}
