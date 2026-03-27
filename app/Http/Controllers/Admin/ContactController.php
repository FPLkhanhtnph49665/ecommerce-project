<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Danh sách contacts
    public function index()
    {
        $contacts = Contact::orderByDesc('created_at')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    // Xem chi tiết contact
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    // Xóa contact
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Liên hệ đã được xóa thành công.');
    }
}
