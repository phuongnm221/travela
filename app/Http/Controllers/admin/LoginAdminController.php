<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginAdminController extends Controller
{

    private $login;

    public function __construct()
    {
        $this->login = new LoginModel();
    }
    public function index()
    {
        $title = 'Đăng nhập';

        return view('admin.login', compact('title'));
    }

    public function loginAdmin(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);

        $login = $this->login->login($username, $password);

        if ($login !== null) {
            // Get full admin data including role
            $adminData = DB::table('tbl_admin')
                ->where('username', $username)
                ->where('password', $password)
                ->first();
            
            $userRole = 'admin'; // default
            
            if ($adminData) {
                // Store all admin data in session
                $userRole = $adminData->role ?? 'admin';
                $request->session()->put('admin', [
                    'adminId' => $adminData->adminId,
                    'fullName' => $adminData->fullName,
                    'username' => $adminData->username,
                    'email' => $adminData->email,
                    'role' => $userRole,
                ]);
            } else {
                // Fallback: just store username
                $request->session()->put('admin', [
                    'username' => $username,
                    'role' => 'admin',
                ]);
            }
            
            toastr()->success('Đăng nhập thành công');
            
            // Redirect based on role
            if ($userRole === 'staff') {
                return redirect()->route('admin.booking');
            } else {
                return redirect()->route('admin.dashboard');
            }
        } else {
            toastr()->error('Thông tin đăng nhập không chính xác');
            return redirect()->route('admin.login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        toastr()->success("Đăng xuất thành công!", 'Thông báo');
        return redirect()->route('admin.login');
    }
}
