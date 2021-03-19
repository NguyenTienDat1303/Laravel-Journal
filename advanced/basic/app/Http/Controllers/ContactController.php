<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }

    public function homeContact()
    {
        $contacts = Contact::latest() -> get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function addContact()
    {
        return view('admin.contact.create');
    }

    public function storeContact(Request $request)
    {
        Contact::insert([
            'address' => $request -> address,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'created_at' => Carbon::now()
        ]);
        return Redirect() -> route('home.contact') -> with('success', 'Contact inserted successfully');
    }

    public function editContact($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function updateContact(Request $request, $id)
    {
        Contact::find($id) -> update([
            'address' => $request -> address,
            'email' => $request -> email,
            'phone' => $request -> phone,
            'updated_at' => Carbon::now()
        ]);
        return Redirect() -> route('home.contact') -> with('success', 'Contact updated successfully');
    }

    public function deleteContact($id)
    {
        Contact::find($id) -> delete();
        return Redirect() -> route('home.contact') -> with('success', 'Contact deleted successfully');
    }
}
