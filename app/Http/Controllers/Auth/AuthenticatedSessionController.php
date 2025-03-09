<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        
         // Vérifie s'il y a une propriété sélectionnée dans la session
        $selectedPropertyId = session()->get('selected_property');
   
        if ($selectedPropertyId) {
            // Supprime l'ID de la propriété sélectionnée de la session
            session()->forget('selected_property');
            $request->authenticate();

            $request->session()->regenerate();
            // Redirige l'utilisateur vers la page d'accueil
            return redirect()->route('home')->with('selectedProperty', $selectedPropertyId);
        }
       
   
    
    
        $request->authenticate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
