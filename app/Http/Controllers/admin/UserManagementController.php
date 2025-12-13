<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\UserModel;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{

    private $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }
    public function index()
    {
        $title = 'Quản lý người dùng';

        $users = $this->users->getAllUsers();

        foreach ($users as $user) {
            if (!$user->fullName) {
                $user->fullName = "Unnamed";
            }
            if (!$user->avatar) {
                $user->avatar = 'unnamed.png';
            }
            if ($user->isActive == 'y')
                $user->isActive = 'Đã kích hoạt';
            else
                $user->isActive = 'Chưa kích hoạt';
        }
        // dd($users);

        return view('admin.users', compact('title', 'users'));
    }

    public function activeUser(Request $request)
    {
        $userId = $request->userId;

        $updateActive = $this->users->updateActive($userId);

        if ($updateActive) {
            return response()->json([
                'success' => true,
                'message' => 'Người dùng đã được kích hoạt thành công!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi kích hoạt người dùng!'
            ], 500); // Trả về mã lỗi HTTP 500 nếu có lỗi
        }
    }

    public function changeStatus(Request $request)
    {
        $userId = $request->userId;
        $status = $request->status;

        // If status is empty string, it means hard delete
        if ($status === '') {
            try {
                // Check if user has foreign key constraints
                $user = \App\Models\User::find($userId);
                if (!$user) {
                    return response()->json([
                        'success' => false,
                        'message' => "Người dùng không tồn tại!"
                    ], 404);
                }

                // Attempt to delete the user
                $user->delete();

                return response()->json([
                    'success' => true,
                    'status' => 'Đã xóa',
                    'message' => "Người dùng đã được xóa thành công!"
                ]);
            } catch (\Exception $e) {
                // If foreign key constraint error, ban the user instead
                if (strpos($e->getMessage(), 'foreign key') !== false || 
                    strpos($e->getMessage(), 'CONSTRAINT') !== false) {
                    $dataUpdate = [
                        'userId' => $userId,
                        'status' => 'b'  // Ban instead
                    ];
                    $this->users->changeStatus($userId, $dataUpdate);

                    return response()->json([
                        'success' => true,
                        'status' => 'Đã chặn',
                        'message' => "Người dùng có liên kết với dữ liệu khác. Hệ thống tự động chặn người dùng thay vì xóa."
                    ]);
                }
                
                return response()->json([
                    'success' => false,
                    'message' => "Có lỗi xảy ra khi xóa người dùng: " . $e->getMessage()
                ], 500);
            }
        }

        // For other statuses, just update
        $dataUpdate = [
            'userId' => $userId,
            'status' => $status
        ];

        $changeStatus = $this->users->changeStatus($userId, $dataUpdate);
        $statusText = $this->getStatusText($status);
        if ($changeStatus) {
            return response()->json([
                'success' => true,
                'status' => $statusText,
                'message' => "Trạng thái người dùng đã được cập nhật thành công!"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Có lỗi xảy ra khi cập nhật trạng thái người dùng!"
            ], 500);
        }
    }

    private function getStatusText($status)
    {
        switch ($status) {
            case 'b':
                return 'Đã chặn';
            case 'd':
                return 'Đã xóa';
            default:
                return 'Không xác định';
        }
    }

}
