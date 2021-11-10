<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use App\Http\Traits\JsonTrait;
use App\Http\Resources\UserResource;


class ApiController extends Controller
{


    use JsonTrait;

    //
    public function __construct() {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
    *@authenticated
    *@header Authorization Bearer {{token}}
    *@response 401 scenario: "invalid token"
    */

    public function dashboard(Request $request){
        $user_total = User::count();
        $code = 0;

        return $this->jsonSuccessResponse(compact('user_total','code'),'',200);
        // return response()->json(
        //     compact('user_total','code')
        // );
    }

    /**
     * Login Api
     * @bodyParam email string required User email Example:superadmin@invoke.com
     * @bodyParam password string required Give  Example:password
     */


    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

     /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);



        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    /**
     * User API
     * @authenticated
     * Get all the user by pagination
     * @bodyParam page int Page Number For Pagination. Example: 1
     */
    public function users() {
        // $users = User::where('id',2)->first();
        $users = User::paginate(2);
        return $this->jsonSuccessResponse(
            new UserResource($users));

        }




}
