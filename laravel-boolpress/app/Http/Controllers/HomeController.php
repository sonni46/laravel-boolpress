<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;
use App\Lead;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.index');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function hendleContactForm(Request $request)
    {
         $form_data = $request->all();
         $new_lead = new Lead();
         $new_lead->fill($form_data);
         $new_lead->save;

         Mail::to('info@bollpress.it')->send(new SendNewMail($new_lead));

         return redirect()->route('contact.thank-you');
    }

    public function thankYou() {
        return view('guest.thank-you');
    }


}
