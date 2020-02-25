<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();
        if ($users) {
            return $this->sendResponse($users, 'A list of users have been shown');
        } else {
            return $this->sendError('No users exist', [], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return $this->sendResponse($user, 'User has been found');
        } else {
            return $this->sendError('User does not exist', [], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            if (auth()->user()->id != $id) {
                User::destroy($id);
                return $this->sendResponse(
                    '',
                    "User '{$user->email}' was successfully deleted"
                );
            } else {
                return $this->sendError('You cannot delete yourself', [], 200 );
            }
        } else {
            return $this->sendError('User does not exist', [], 404);
        }

    }
}