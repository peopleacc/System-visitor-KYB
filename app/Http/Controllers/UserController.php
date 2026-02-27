<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'visitor')->get();
        $visitors = visitor::orderBy('created_at', 'desc')->get();
        $visitorUsers = User::where('role', 'visitor')->get();
        return view("visitor.index", compact("users", "visitors", "visitorUsers"));
    }

    public function create()
    {
        return view("users.create");
    }

    public function store(Request $request)
    {
        // Store user logic
    }

    /**
     * Update visitor status (pending -> selesai)
     */
    public function updateVisitorStatus(Request $request, $id)
    {
        $visitor = visitor::findOrFail($id);
        $visitor->status = $request->status;
        $visitor->save();

        return redirect()->route('visitor.index')->with('success', 'Status visitor berhasil diperbarui!');
    }

    /**
     * Logout a visitor session (delete visitor user)
     */
    public function logoutVisitor($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'visitor') {
            // Delete session for this user
            DB::table('sessions')->where('user_id', $user->id)->delete();
            // Delete the visitor user
            $user->delete();
        }

        return redirect()->route('users.index')->with('success', 'Visitor session berhasil dihapus!');
    }
}
