<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        $newCount = ContactMessage::new()->count();
        $readCount = ContactMessage::read()->count();
        $repliedCount = ContactMessage::replied()->count();
        
        return view('admin.contact-messages.index', compact('messages', 'newCount', 'readCount', 'repliedCount'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read when viewed
        if ($contactMessage->isNew()) {
            $contactMessage->markAsRead();
        }
        
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied',
            'admin_notes' => 'nullable|string',
        ]);

        $contactMessage->update($validated);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Status pesan berhasil diperbarui');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Pesan berhasil dihapus');
    }
}
