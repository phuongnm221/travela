<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StaffManagementController extends Controller
{
    /**
     * Display a listing of staff
     */
    public function index()
    {
        $title = 'Danh sách nhân sự';
        
        // Get all staff (role = 'staff') from tbl_admin
        $staff = \DB::table('tbl_admin')->where('role', 'staff')->get();
        
        return view('admin.staff.index', compact('title', 'staff'));
    }

    /**
     * Show the form for creating a new staff
     */
    public function create()
    {
        $title = 'Thêm nhân sự';
        return view('admin.staff.create', compact('title'));
    }

    /**
     * Store a newly created staff in storage
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'fullName' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:tbl_admin,username',
                'email' => 'required|email|max:255|unique:tbl_admin,email',
                'password' => 'required|string|min:6',
                'address' => 'nullable|string|max:255',
                'phoneNumber' => 'nullable|string|max:20',
            ]);

            $data = [
                'fullName' => $validated['fullName'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => md5($validated['password']),
                'address' => $validated['address'] ?? null,
                'phoneNumber' => $validated['phoneNumber'] ?? null,
                'role' => 'staff',
                'createdDate' => Carbon::now(),
            ];

            $inserted = \DB::table('tbl_admin')->insert([$data]);

            if ($inserted) {
                return redirect()->route('admin.staff.index')->with('success', 'Thêm nhân sự thành công!');
            } else {
                return back()->withInput()->with('error', 'Có lỗi xảy ra khi thêm nhân sự vào database');
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing staff
     */
    public function edit($id)
    {
        $title = 'Chỉnh sửa nhân sự';
        $staff = \DB::table('tbl_admin')->where('adminId', $id)->where('role', 'staff')->first();

        if (!$staff) {
            return redirect()->route('admin.staff.index')->with('error', 'Không tìm thấy nhân sự');
        }

        return view('admin.staff.edit', compact('title', 'staff'));
    }

    /**
     * Update staff in storage
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'fullName' => $validated['fullName'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'phoneNumber' => $validated['phoneNumber'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = md5($validated['password']);
        }

        $updated = \DB::table('tbl_admin')
            ->where('adminId', $id)
            ->where('role', 'staff')
            ->update($updateData);

        if ($updated) {
            return redirect()->route('admin.staff.index')->with('success', 'Cập nhật nhân sự thành công!');
        } else {
            return back()->with('error', 'Có lỗi xảy ra khi cập nhật nhân sự');
        }
    }

    /**
     * Delete staff
     */
    public function destroy($id)
    {
        $deleted = \DB::table('tbl_admin')
            ->where('adminId', $id)
            ->where('role', 'staff')
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.staff.index')->with('success', 'Xóa nhân sự thành công!');
        } else {
            return back()->with('error', 'Có lỗi xảy ra khi xóa nhân sự');
        }
    }
}
