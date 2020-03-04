<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends BaseController
{

    /**
     * UsersController constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware([
            'auth'
        ]);
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->paginateCollection($this->UsersRepository->getAllUsers(), self::PAGINATE);

        return view('users', compact(self::viewShareVarsUsers));
    }

    /**
     * Add the new user form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Save the new user.
     *
     * @param App\Http\Requests\UsersRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        if (! empty($request->input('email'))) {
            if (! ($this->validEmail($request->input('email')))) {
                return redirect()->back()
                ->withErrors('The User Email must be a valid email address.')
                ->withInput();
            }
            
            if ($this->UsersRepository->checkDuplicatedEmailToAdd($request->input('email')) != null) {
                return redirect()->back()
                ->withErrors('The User with such email is exist already')
                ->withInput();
            }
            
            $data = $request->input();
            $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
            $data['password'] = Hash::make($request->input('password'));
            
            $this->UsersRepository->addUser($data);
            
            return redirect()->route('users.index')->with('success', 'The New User has been added successfully');
        }
    }

    /**
     * Edit the user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($this->UsersRepository->getEdit($id)) {
            
            $userInfo = $this->UsersRepository->getUserInfoByUserId($id);

            return view('user.edit', compact(self::viewShareVarsEditUser));
        } else {
            return redirect()->back()->withErrors('This user does not exist.');
        }
    }

    /**
     * Update the user.
     *
     * @param App\Http\Requests\UsersRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        if (! empty($request->input('email'))) {
            if (! ($this->validEmail($request->input('email')))) {
                return redirect()->back()
                ->withErrors('The User Email must be a valid email address.')
                ->withInput();
            }
            if ($this->UsersRepository->checkDuplicatedEmailToUpdate($id, $request->input('email')) != null) {
                return redirect()->back()
                ->withErrors('The User with such email is exist already')
                ->withInput();
            }
            
            $data = $request->input();            
            
            if (! empty($request->input('password'))) {
                $data['password'] = Hash::make($request->input('password'));
                
                $this->UsersRepository->updateUser($id, $data);
            } else {
                $this->UsersRepository->updateUserWithoutPass($id, $data);
            }
            
            return redirect()->route('users.index')->with('success', 'The User has been updated successfully');
        }
    }

    /**
     * Remove the user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->UsersRepository->getEdit($id)) {
            $this->UsersRepository->deleteUser($id);

            return redirect()->back()->with('success', 'The user has been removed successfully');
        } else {
            return redirect()->back()->withErrors('This user does not exist.');
        }
    }
}
