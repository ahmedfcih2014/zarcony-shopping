<?php

namespace App\Http\Controllers\Admin;

use App\Enum\UserEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    private const userAttributes = [
        'name', 'email', 'mobile', 'password', 'user_role'
    ];

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::filter()->latestId()->simplePaginate();
        return view("admin.users.index", ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view("admin.users.create", ['roles' => UserEnum::getRolesKeyValue()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     */
    public function store(CreateRequest $request)
    {
        User::create($request->only(self::userAttributes));
        return redirect(route("admin.users.index"))
            ->with("success-message", __("messages.user-created"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", ['user' => $user, 'roles' => UserEnum::getRolesKeyValue()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(self::userAttributes));

        return redirect()->back()->with("success-message", __("messages.user-updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with("success-message", __("messages.user-deleted"));
    }
}
