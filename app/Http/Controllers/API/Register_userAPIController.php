<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRegister_userAPIRequest;
use App\Http\Requests\API\UpdateRegister_userAPIRequest;
use App\Models\Register_user;
use App\Repositories\Register_userRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;   


/**
 * Class Register_userController
 * @package App\Http\Controllers\API
 */

class Register_userAPIController extends AppBaseController
{
    /** @var  Register_userRepository */

    // protected function generateToAccessToken($register_user)
    // {
    //     $token = $register_user->createToken($register_user->email.'-'.now());

    //     return $token->accessToken;
    // }

    private $registerUserRepository;

    public function __construct(Register_userRepository $registerUserRepo)
    {
        $this->registerUserRepository = $registerUserRepo;
       // $this->middleware('auth:register_user_api', ['except' => ['login']]);
    }

    /**
     * Display a listing of the Register_user.
     * GET|HEAD /registerUsers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $registerUsers = $this->registerUserRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($registerUsers->toArray(), 'Register Users retrieved successfully');
    }

    /**
     * Store a newly created Register_user in storage.
     * POST /registerUsers
     *
     * @param CreateRegister_userAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRegister_userAPIRequest $request)
    {

        $request->validate([
            'name' => 'required', 
            'email' => 'required', 
            'password' => 'required',
            'phone' => 'required', 
            'image' => 'required|image|max:2048'
        ]);

        $path = Storage::disk('public')->put('upload', $request->file('image'));

            // $registerUser->fill(['image' => asset($path)])->save();
           

            $user = array(
            'name' => $request->name, 
            'email' => $request->email, 
            'phone' => $request->phone, 
            'password' => bcrypt($request->password),
            'image' => $path
            );

        $registerUser = $this->registerUserRepository->create($user);
       
        return $this->sendResponse($registerUser->toArray(), 'Register User saved successfully');
    }

    /**
     * Display the specified Register_user.
     * GET|HEAD /registerUsers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Register_user $registerUser */
        $registerUser = $this->registerUserRepository->find($id);

        if (empty($registerUser)) {
            
            

        }

        return $this->sendResponse($registerUser->toArray(), 'Register User retrieved successfully');
    }

    /**
     * Update the specified Register_user in storage.
     * PUT/PATCH /registerUsers/{id}
     *
     * @param int $id
     * @param UpdateRegister_userAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegister_userAPIRequest $request)
    {
        $input = $request->all();

        /** @var Register_user $registerUser */
        $registerUser = $this->registerUserRepository->find($id);

        if (empty($registerUser)) {
            return $this->sendError('Register User not found');
        }

        $registerUser = $this->registerUserRepository->update($input, $id);

        return $this->sendResponse($registerUser->toArray(), 'Register_user updated successfully');
    }

    /**
     * Remove the specified Register_user from storage.
     * DELETE /registerUsers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Register_user $registerUser */
        $registerUser = $this->registerUserRepository->find($id);

        if (empty($registerUser)) {
            return $this->sendError('Register User not found');
        }

        $registerUser->delete();

        return $this->sendSuccess('Register User deleted successfully');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));

    }

    public function register(CreateRegister_userAPIRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:register_users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string',
            'image' =>  'required|image|max:2048'
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $images = Storage::disk('public')->put('upload', $request->file('image'));

        $user = Register_user::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'phone' => $request->get('phone'),
            'image' => $images,
        ]);

        
        
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function getAuthenticatedUser()
    {
            try {

                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return response()->json(['user_not_found'], 404);
                    }

            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                    return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                    return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                    return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json(compact('user'));
    }
    
   
}
