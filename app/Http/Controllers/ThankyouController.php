<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;

class ThankyouController extends Controller
{
  public function index()
  {
    return view('thank_you');
  }
  public function proceed()
  {
    return redirect(RouteServiceProvider::HOME);
  }
}
