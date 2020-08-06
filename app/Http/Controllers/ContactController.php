<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ContactController extends Controller
{

    public function getCurrentUser()
    {
        return User::findOrFail(Auth::user()->id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('home', ['contacts' => $this->getCurrentUser()->contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $contact = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:50'
        ]);

        $this->getCurrentUser()->contacts()->save(new Contact([
            'name' => $contact['name'],
            'email' => $contact['email'],
            'phone' => $contact['phone'],
            'address' => $contact['address'],
        ]));

        return redirect('/home')->with('success','Contact has been successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contact $id
     * @return Application|Factory|View
     */
    public function edit(Contact $contact)
    {
        return view('contacts.update', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $contact = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:50'
        ]);

        Contact::whereId($id)->update($contact);

        return redirect('/home')->with('success','Contact has been successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/home')->with('success','Contact has been successfully deleted');

    }
}
