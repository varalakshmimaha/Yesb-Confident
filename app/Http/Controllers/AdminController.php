<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($request->username === 'admin' && $request->password === 'yesb@2025') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Invalid username or password']);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $query = Enquiry::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $enquiries = $query->latest()->get();

        $stats = [
            'total' => Enquiry::count(),
            'new' => Enquiry::where('status', 'new')->count(),
            'contacted' => Enquiry::where('status', 'contacted')->count(),
            'closed' => Enquiry::where('status', 'closed')->count(),
        ];

        return view('admin.dashboard', compact('enquiries', 'stats'));
    }

    public function updateStatus(Request $request, Enquiry $enquiry)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'status' => 'required|in:new,contacted,closed',
        ]);

        $enquiry->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully!');
    }

    public function destroy(Enquiry $enquiry)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $enquiry->delete();

        return back()->with('success', 'Enquiry deleted successfully!');
    }

    public function destroyAll()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        Enquiry::truncate();

        return back()->with('success', 'All enquiries cleared!');
    }

    public function exportCsv()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $enquiries = Enquiry::latest()->get();
        $filename = 'yesb_enquiries_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($enquiries) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Name', 'Address', 'Phone', 'Email', 'Occupation', 'Affiliate Interest', 'Affiliate Experience', 'Date', 'Status']);

            foreach ($enquiries as $e) {
                fputcsv($file, [
                    $e->name, $e->address, $e->phone, $e->email, $e->occupation,
                    $e->affiliate_interest, $e->affiliate_experience,
                    $e->created_at->format('d/m/Y h:i A'), $e->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
