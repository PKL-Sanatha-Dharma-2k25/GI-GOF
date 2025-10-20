<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\PemohonModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class AuthController extends Controller
{
    public function index(): View
    {
        
        return view('login.login');
    }
    
    public function signIn(Request $request): RedirectResponse
    {
        //dd($request->all());
        $data = $request->validate([
            'username' => 'required|string',
            'password'=>'required|min:6'
        ]);
        $user = DB::table('pemohon_models')->where('username', $data['username'])->first();
         if ($user && Hash::check($data['password'], $user->password)) {
        $request->session()->put('user', [
            'id' => $user->id,
            'username' => $user->username,
            'dept_id' => $user->dept_id ?? null,
            'role' => $user->role,
        ]);
        if($user->role === 1){
            return redirect()->route('content.dashboardAdmin');//Tampilan GA
        }elseif($user->role === 2){
            return redirect()->route('content.dashboardSuperAdmin');//Tampilan MIS
        }
        return redirect()->route('content.dashboard');//Semua, except GA & MIS
    }
    return back()->withErrors([
        'username' => 'Username atau password salah!'
    ])->onlyInput('username');
    }
    public function signUp(Request $request): RedirectResponse {
       
       $password = $request->input('password'); 
       if (strlen($password)<6) {
    Session::flash('msgErr', 'Password minimal 6 karakter!');
    return redirect()->route('register.register');
}
        
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'dept' => ['required', 'string', 'max:255'],
            'password' => ['required','min:6','confirmed'],
        ]);

        $dept = $request->dept;
        
        $deptId = 0;
        if($dept == 'MIS'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
        elseif($dept == 'GA'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
        elseif($dept == 'FC'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
        elseif($dept == 'PR'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
        elseif($dept == 'WH'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
        elseif($dept == 'HRD'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
        }
        elseif($dept == 'ACC'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;}
        elseif($dept == 'PPIC'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
    elseif($dept == 'QC'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
    elseif($dept == 'IQC'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
    elseif($dept == 'FG'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }
    elseif($dept == 'EXIM'){
        $query= DepartmentModel::select('id')->where('dept_code', $dept)->get();
        $deptId = $query[0]->id;
    }

        $role = 0;// all dept = member
        if($deptId == 1){
            $role = 2; //superadmin
        }elseif($deptId == 2){
            $role = 1; //admin
        }
        $user = PemohonModel::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'dept_id' => $deptId,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);
        
        event(new Registered($user));

        ##Auth::login($user);

        Session::flash('msgUp', 'You have successfully signed up, please login');
        return redirect()->route('login.login');
    }
    public function signOut()
    {
        Session::flush();
        Session::flash('msgOut', 'You have successfully signed out');
        
        return redirect('/');
    }
public function usernameValidate(Request $request)
{     
    $exists = PemohonModel::where('username', $request->username)->exists();

    return response()->json([
        'exists' => $exists
    ]);

}
public function signInValidate(Request $request){
      $data = $request->validate([
        'username' => 'required|string',
        'password' => 'required|min:6'
    ]);

    // Cek apakah username ada di database
    $user = PemohonModel::where('username', $data['username'])->first();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'These credentials do not match our records (username not found).'
        ], 404);
    }

    // Cek apakah password cocok
    if (!Hash::check($data['password'], $user->password)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Incorrect password.'
        ], 401);
    }

    // Jika keduanya cocok
    return response()->json([
        'status' => 'success',
        'message' => 'Credentials verified successfully.',
        'user' => $user
    ]);
}

}