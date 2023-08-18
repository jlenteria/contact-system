<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
      $user = auth()->user();
      $contacts = $user->contacts()->paginate(10);
      return view('contacts.index', compact('contacts'));
    }

    public function ajaxResult(Request $request)
    {
      $user = auth()->user();
      $query = $request->input('query');
      $results = $user->contacts()->where(function($contact) use ($query){
        return $contact
          ->where("name", "ILIKE", "%$query%")
          ->orWhere("company", "ILIKE", "%$query%")
          ->orWhere("phone", "ILIKE", "%$query%")
          ->orWhere("email", "ILIKE", "%$query%");

      })->get()->all();

      return response()->json(['results' => $results]);

    }

    public function create()
    {
      return view('contacts.add');
    }

    public function store(Request $request)
    {
      $user = auth()->user();
      $data = [
        "name" => $request->name,
        "company" => $request->company,
        "phone" => $request->phone,
        "email" => $request->email
      ];
      $user->contacts()->create($data);
      
      return redirect()->route('contacts.index');
    }

    public function edit($id)
    {
      $contact = Contact::find($id);
      return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
      $contact = Contact::find($id);
      $data = [
        "name" => $request->name,
        "company" => $request->company,
        "phone" => $request->phone,
        "email" => $request->email
      ];
      $contact->update($data);
      
      return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
      $contact = Contact::findOrFail($id);
      $contact->delete();
      return redirect()->route('contacts.index');
    }
}
