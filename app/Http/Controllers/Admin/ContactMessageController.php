<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $messages = $query->latest()->paginate(15);

        // Statistics
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::where('status', 'unread')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
            'replied' => ContactMessage::where('status', 'replied')->count(),
            'urgent' => ContactMessage::where('priority', 'urgent')->where('status', '!=', 'replied')->count(),
        ];

        $statuses = ContactMessage::statuses();
        $priorities = ContactMessage::priorities();

        return view('admin.messages.index', compact('messages', 'stats', 'statuses', 'priorities'));
    }

    /**
     * Display the specified message.
     */
    public function show(ContactMessage $message)
    {
        // Mark as read if unread
        if ($message->status === 'unread') {
            $message->markAsRead();
        }

        $message->load('repliedByUser');
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Reply to a message
     */
    public function reply(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'reply' => 'required|string',
        ]);

        $message->reply = $validated['reply'];
        $message->status = 'replied';
        $message->replied_by = Auth::id();
        $message->replied_at = now();
        $message->save();

        // Here you could also send an email notification to the user
        // Mail::to($message->email)->send(new ContactReply($message));

        return redirect()->back()->with('success', 'Balasan berhasil dikirim!');
    }

    /**
     * Update message status
     */
    public function updateStatus(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
        ]);

        $message->status = $validated['status'];
        $message->save();

        return redirect()->back()->with('success', 'Status pesan berhasil diperbarui!');
    }

    /**
     * Update message priority
     */
    public function updatePriority(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $message->priority = $validated['priority'];
        $message->save();

        return redirect()->back()->with('success', 'Prioritas pesan berhasil diperbarui!');
    }

    /**
     * Add admin notes
     */
    public function addNotes(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $message->admin_notes = $validated['admin_notes'];
        $message->save();

        return redirect()->back()->with('success', 'Catatan berhasil ditambahkan!');
    }

    /**
     * Delete a message
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }

    /**
     * Archive selected messages
     */
    public function archiveSelected(Request $request)
    {
        $validated = $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:contact_messages,id',
        ]);

        ContactMessage::whereIn('id', $validated['message_ids'])
            ->update(['status' => 'archived']);

        return redirect()->back()->with('success', 'Pesan berhasil diarsipkan!');
    }

    /**
     * Mark selected as read
     */
    public function markAsRead(Request $request)
    {
        $validated = $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:contact_messages,id',
        ]);

        ContactMessage::whereIn('id', $validated['message_ids'])
            ->update(['status' => 'read']);

        return redirect()->back()->with('success', 'Pesan berhasil ditandai sudah dibaca!');
    }
}
