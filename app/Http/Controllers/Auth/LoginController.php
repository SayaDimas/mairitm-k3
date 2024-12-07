<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users after login based on their role.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect('/admin'); // Redirect ke halaman admin
        } elseif ($user->role === 'guru') {
            return redirect('/guru'); // Redirect ke halaman guru
        } elseif ($user->role === 'siswa') {
            return redirect('/siswa'); // Redirect ke halaman siswa
        }

        return redirect('/'); // Redirect default jika role tidak dikenali
    }
}
