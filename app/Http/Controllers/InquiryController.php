<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Car;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    /** Customer mengajukan test drive / inquiry pada satu mobil (FR-10) */
    public function store(StoreInquiryRequest $request, Car $car)
    {
        Inquiry::create([
            'user_id' => $request->user()->id,
            'car_id' => $car->id,
            'phone' => $request->validated('phone'),
            'message' => $request->validated('message'),
        ]);

        return back()->with('success', 'Pengajuan test drive/inquiry berhasil dikirim. Tim showroom akan segera menghubungi Anda.');
    }
}
