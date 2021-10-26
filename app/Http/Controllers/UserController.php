<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends SearchableController
{
    //
    private $title = 'User';

    function getQuery()
    {
        return User::orderBy('id');
    }
    function admin(){
        $users = User::orderBy('id')->get();
        return view('admin.user',[
            'users'=>$users,
        ]);
    }
    public function filterByTerm($query, $term)
    {
        if (!empty($term)) {
            $words = preg_split('/\s+/', $term);

            foreach ($words as $word) {
                $query->where(function ($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('name', 'LIKE', "%{$word}%")
                        ->orWhere('email', 'LIKE', "%{$word}%")
                        ->orWhere('role', 'LIKE', "%{$word}%");
                });
            }
        }
        return $query;
    }

    function find($email)
    {
        return $this->getQuery()->where('email', $email)->firstOrFail();
    }

    function list(Request $request)
    {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search);
        session()->put('bookmark.user-view', $request->getUri());
        return view('user-list', [
            'search' => $search,
            'users' => $query->paginate(5),
        ]);
    }

    function createForm(Request $request)
    {
        $users = User::orderBy('id')->get();
        return view('admin.create-user-form', [
            'users' => $users,
        ]);
    }

    function create(Request $request)
    {  
        try{
            $user = User::create($request->getParsedBody());
            return redirect()->route('admin.user')
            ->with('status', "User {$user->email} was created.");       
                // ... Normal process
            } catch(QueryException$excp) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => $excp->errorInfo[2],
                ]);
            }
    }

    function show($userEmail)
    {
        $user = $this->find($userEmail);
        return view('user-view', [
            'title' => "{$this->title} : View",
            'user' => $user,
        ]);
    }

    function updateForm($userEmail)
    {
        $user = $this->find($userEmail);
        return view('admin.update-user-form', [
            'user' => $user,
        ]);
    }

    function update(Request $request, $userEmail)
    {
        $this->authorize('update', User::class);
        try{
            // ... Normal process
            $user = $this->find($userEmail);
            $user->fill($request->getParsedBody());
            Hash::make('plain-text');
            return redirect(session()->get('bookmark.admin.user', route('admin.user',['user' => $user->email])))
            ->with('status', "User {$user->email} was updated.");   
        } catch(QueryException$excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }

    function delete($userEmail)
    {
        try{
            // ... Normal process
            $user = $this->find($userEmail);
            $user->delete();
            return redirect(session()->get('bookmark.admin.user', route('admin.user')))
                ->with('status', "User {$user->email} was deleted.");      
            } catch(QueryException$excp) 
            {// We don't want withInput() here.
                return redirect()->back()->withErrors(['error' => $excp->errorInfo[2],
            ]);
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
