<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('client.contact');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Lưu vào DB
        $contact = Contact::create($request->only('name', 'email', 'subject', 'message'));

        // Gửi email cho admin
        Mail::send('emails.contact_admin', ['contact' => $contact], function ($message) use ($contact) {
            $message->to('admin@atudau.com', 'Admin')
                    ->subject('Liên hệ mới: ' . $contact->subject);
        });

        // Gửi email cảm ơn khách hàng
        Mail::send('emails.contact_thank', ['contact' => $contact], function ($message) use ($contact) {
            $message->to($contact->email, $contact->name)
                    ->subject('Cảm ơn bạn đã liên hệ với chúng tôi');
        });

        return redirect()->back()->with('success', 'Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm.');
    }
}
