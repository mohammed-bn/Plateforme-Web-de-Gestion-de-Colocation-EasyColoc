<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Colocation;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $usersTotal  = User::count();
        $usersBanned = User::where('status', 'banned')->count();
        $usersActif  = User::where('status', 'actif')->count();

        $colocsTotal   = Colocation::count();
        $colocsActif   = Colocation::where('status', 'actif')->count();
        $colocsInactif = Colocation::where('status', 'inactif')->count();

        $bannedUsers = User::where('status', 'banned')->orderByDesc('updated_at')->get();

        $recentUsers = User::orderByDesc('created_at')->take(8)->get();

        return view('admin.dashboard', compact(
            'usersTotal',
            'usersBanned',
            'usersActif',
            'colocsTotal',
            'colocsActif',
            'colocsInactif',
            'bannedUsers',
            'recentUsers'
        ));
    }


    public function ban(User $user)
    {
        if ($user->id === 1) {
            return back()->with('error', 'Impossible de bannir le super admin.');
        }

        $user->update(['status' => 'banned']);

        return back()->with('success', 'Utilisateur banni avec succès.');
    }

    public function unban(User $user)
    {
        if ($user->id === 1) {
            return back()->with('error', 'Super admin protégé.');
        }

        $user->update(['status' => 'actif']);

        return back()->with('success', 'Utilisateur débanni avec succès.');
    }
}
