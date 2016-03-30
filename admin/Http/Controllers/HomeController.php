<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return redirect('users');
        //dd(auth()->user()->isSuperAdmin());
        /*if(auth()->user()->isSuperAdmin()) {
            return redirect('/reports');
        }
        else {
            return redirect('/users');
        }*/
    }
}
