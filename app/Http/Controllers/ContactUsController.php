<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    // Show the contact form
    public function show()
    {
        return view('contact');
    }

    // Send email
    public function sendEmail(Request $request)
    {
        // Validate form
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10',
            'contact' => 'required'

        ]);

        $request->merge(['emailFrom' => $request->contact . '@thevinylshop.com']);
        $request->merge(['contactname' => 'The Vinyl Shop - '  . ucfirst($request->contact)]);

        // Send email
        $email = new ContactMail($request);
        Mail::to($request) // or Mail::to($request->email, $request->name)
        ->send($email);

        // Flash filled-in form values to the session
        $request->flash();
        // Flash a success message to the session
        session()->flash('success', 'Thank you for your message.<br>We\'ll contact you as soon as possible.');
        // Redirect to the contact-us link ( NOT to view('contact')!!! )
        return redirect('contact-us');
    }
}
