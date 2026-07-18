<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /** Admin melihat & menindaklanjuti inquiry/test drive (FR-11) */
    public function index()
    {
        $inquiries = Inquiry::with(['user', 'car'])->latest()->paginate(10);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $data = $request->validate(['status' => ['required', 'in:pending,contacted,done']]);

        $inquiry->update($data);

        return back()->with('success', 'Status inquiry berhasil diperbarui.');
    }
}
