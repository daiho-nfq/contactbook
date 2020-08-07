<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\Contacts\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('home', ['contacts' => auth()->user()->contacts]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(ContactRequest $request)
    {
        auth()->user()->contacts()->create($request->all());

        return redirect('/home')->with('msg','Contact has been successfully created');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.update', compact('contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {

        $contact->update($request->all());

        return redirect('/home')->with([
            'msg' => 'Contact has been successfully updated',
            'type' => 'success'
        ]);

    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect('/home')->with([
            'msg' => 'Contact has been successfully deleted',
            'type' => 'danger',
            'id' => $contact
        ]);
    }

    public function restore($id)
    {
        Contact::withTrashed()->find($id)->restore();

        return redirect('/home')->with([
            'msg' => 'Contact has been successfully restored',
            'type' => 'success'
        ]);
    }
}
