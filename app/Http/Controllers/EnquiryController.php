<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'address'              => 'required|string|max:1000',
            'phone'                => 'required|string|max:20',
            'email'                => 'nullable|email|max:255',
            'occupation'           => 'required|string|max:255',
            'affiliate_interest'   => 'required|in:yes,no',
            'affiliate_experience' => 'nullable|string|max:2000',
        ]);

        Enquiry::create($validated);

        return back()->with('success', 'Enquiry submitted successfully!');
    }
}
