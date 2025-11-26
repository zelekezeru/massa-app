<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $role = 3;

        $user = $this->register($request, $role);

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function register(Request $request, string $role): User
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);
        
        $role = Role::findOrFail($role);

        $username = $this->generateUniqueUsername($request->name, $role);
        
        $password = $this->generatePassword($request->name, $request->phone);
        
        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($password),
            'default_password' => $password,
        ]);

        $user->assignRole($role);

        return $user;
    }

    // Generate a unique username based on name and role
    private function generateUniqueUsername(string $name, Role $role): string
    {
        $roleCode = $this->roleCode($role->name);

        $year = substr(now()->year, -2);

        $count = count($role->users) + 1;

        $username = $roleCode . '-' . str_pad($count, 3, '0', STR_PAD_LEFT) . '-' . $year;

        while( User::where('username', $username)->first() == true ) {
            $count++;

            $username = $roleCode . '-' . str_pad($count, 3, '0', STR_PAD_LEFT) . '-' . $year;
        }

        return $username;
    }

    public function roleCode($role)
    {
        $roles = [
            'super_admin' => 'SA',
            'admin' => 'AD',
            'sales_agent' => 'AG',
            'manager' => 'MG',
            'customer' => 'CU',
            'supplier' => 'SU',
            'employee' => 'EM',
            'farmer' => 'FA',
            'user' => 'US',
        ];

        return $roles[$role] ?? null;
    }

    // Generate password from name and phone's last 4 digits
    public function generatePassword($name, $phone)
    {
        $namePart = strtolower(strtok($name, ' '));

        $phonePart = substr($phone, -4);
        
        return $namePart . '@'. $phonePart;
    }
}
