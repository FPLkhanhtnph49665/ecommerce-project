<p>Bạn có một liên hệ mới từ website:</p>
<ul>
    <li><strong>Tên:</strong> {{ $contact->name }}</li>
    <li><strong>Email:</strong> {{ $contact->email }}</li>
    <li><strong>Chủ đề:</strong> {{ $contact->subject }}</li>
</ul>
<p><strong>Nội dung:</strong></p>
<p>{{ $contact->message }}</p>
