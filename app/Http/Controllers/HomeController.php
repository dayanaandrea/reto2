<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener el usuario logueado
        $user = Auth::user();
        $role = $user->role;
        if ($role->role == 'profesor') {
            // Recoger todos los profesores y quitar a el propio profesor logueado
            $teachers = User::orderBy('lastname')->where('role_id', '=', 1)->where('id', '<>', $user->id)->get();
            return view('home', ['teachers' => $teachers]);
        } elseif ($role->role == 'estudiante') {
            return view('home');
        } else {
            // Lanzar page not found
            abort(404);
        }
    }
}
