<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AdminModel;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }
    public function index()
    {
        $title = 'Quản lý Admin';

        $admin = $this->admin->getAdmin();

        return view('admin.profile-admin', compact('title', 'admin'));
    }

    public function updateAdmin(Request $request)
    {
        $fullName = $request->fullName;
        $password = $request->password;
        $email = $request->email;
        $address = $request->address;

        $admin = $this->admin->getAdmin();
        $oldPass = $admin->password;

        if ($password != $oldPass) {
            $password = md5($password);
        }
        

        $dataUpdate = [
            'fullName' => $fullName,
            'password' => $password,
            'email' => $email,
            'address' => $address
        ];
        $update = $this->admin->updateAdmin($dataUpdate);
        $newinfo = $this->admin->getAdmin();
        if ($update) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $newinfo
                ]
            );
        } else {
            return response()->json(['success' => false, 'message' => 'Không có thông tin nào thay đổi!']);
        }
    }

    public function updateAvatar(Request $req)
    {
        // dd($req->all());
        $avatar = $req->file('avatarAdmin');

        // Tạo tên mới cho tệp ảnh
        $filename = 'avt_admin.jpg'; // Tên tệp mới
        unlink(public_path('admin/assets/images/user-profile/avt_admin.jpg'));

        // Di chuyển ảnh vào thư mục public/admin/assets/images/user-profile/
        $update = $avatar->move(public_path('admin/assets/images/user-profile'), $filename);

        if (!$update) {
            return response()->json(['error' => true, 'message' => 'Có vấn đề khi cập nhật ảnh!']);
        }
        return response()->json(['success' => true, 'message' => 'Cập nhật ảnh thành công!']);
    }

    /**
     * Show current user profile (admin or staff)
     */
    public function profile()
    {
        $title = 'Thông tin cá nhân';
        $adminUser = session()->get('admin');
        
        if (!$adminUser) {
            return redirect()->route('admin.login')->with('error', 'Vui lòng đăng nhập');
        }

        // Get user data from database
        $userData = \DB::table('tbl_admin')->where('adminId', $adminUser['adminId'] ?? null)->first();
        
        if (!$userData) {
            return redirect()->route('admin.dashboard')->with('error', 'Không tìm thấy thông tin người dùng');
        }

        return view('admin.profile', compact('title', 'userData'));
    }

    /**
     * Update current user profile
     */
    public function updateProfile(Request $request)
    {
        $adminUser = session()->get('admin');
        
        if (!$adminUser) {
            return back()->with('error', 'Vui lòng đăng nhập');
        }

        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'fullName' => $validated['fullName'],
            'email' => $validated['email'],
            'phoneNumber' => $validated['phoneNumber'],
            'address' => $validated['address'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = md5($validated['password']);
        }

        \DB::table('tbl_admin')
            ->where('adminId', $adminUser['adminId'])
            ->update($updateData);

        // Update session
        session()->put('admin', array_merge($adminUser, $updateData));

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

}
