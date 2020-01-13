<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    //
    public function send(Request $request) {
        $contact = new Contact;
        $contact->customer_name = $request->input('name', '');
        $contact->customer_tel = $request->input('tel', '');
        $contact->customer_email = $request->input('email', '');
        $contact->customer_message = $request->input('message', '');
        $result = $contact->save();
        if ($result) {
            return response()->json(['message' => 'Successful'], 201);
        } else {
            return response()->json(['message' => 'Failed'], 500);
        }
    }

    public function contactInfo() {
        $data = Contact::all();
        return response()->json(['info' => $data], 200);
    }
}
