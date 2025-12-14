<?php

namespace App\Http\Controllers\clients;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\clients\Login;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoginController extends Controller
{

    private $login;
    protected $user;

    public function __construct()
    {
        $this->login = new Login();
        $this->user = new User();
    }
    public function index()
    {
        $title = 'Đăng nhập';
        return view('clients.login', compact('title'));
    }

    public function registerPage()
    {
        $title = 'Đăng ký';
        return view('clients.register', compact('title'));
    }

    public function register(Request $request)
    {
        $fullname = $request->fullname_register ?? null;
        $username_regis = $request->username_register ?? $request->username_regis;
        $email = $request->email_register ?? $request->email;
        $password_regis = $request->password_register ?? $request->password_regis;
        $password_confirm = $request->re_pass ?? $request->password_confirm ?? null;

        // Kiểm tra password xác nhận
        if ($password_confirm && $password_regis !== $password_confirm) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu xác nhận không khớp!'
            ]);
        }

        // Validate mật khẩu: tối thiểu 8 ký tự, 1 chữ hoa, 1 chữ thường, 1 ký tự đặc biệt
        if (strlen($password_regis) < 8) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu phải dài tối thiểu 8 ký tự!'
            ]);
        }
        if (!preg_match('/[A-Z]/', $password_regis)) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu phải chứa ít nhất 1 chữ in hoa!'
            ]);
        }
        if (!preg_match('/[a-z]/', $password_regis)) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu phải chứa ít nhất 1 chữ thường!'
            ]);
        }
        if (!preg_match('/[!@#$%^&*()_+=\-\[\]{};:\'",.<>?\/\\|`~]/', $password_regis)) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu phải chứa ít nhất 1 ký tự đặc biệt (!@#$%^&*...)!'
            ]);
        }

        $checkAccountExist = $this->login->checkUserExist($username_regis, $email);
        if ($checkAccountExist) {
            return response()->json([
                'success' => false,
                'message' => 'Tên người dùng hoặc email đã tồn tại!'
            ]);
        }

        $activation_token = Str::random(60);
        $activation_token_expires = Carbon::now()->addHours(24);

        $dataInsert = [
            'username'         => $username_regis,
            'fullname'         => $fullname,
            'email'            => $email,
            'password'         => md5($password_regis),
            'activation_token' => $activation_token,
            'activation_token_expires' => $activation_token_expires
        ];

        $this->login->registerAcount($dataInsert);

        // Gửi email kích hoạt
        $this->sendActivationEmail($email, $activation_token);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.'
        ]);
    }

    public function sendActivationEmail($email, $token)
    {
        $activation_link = route('activate.account', ['token' => $token]);

        try {
            $fromAddress = config('mail.from.address') ?: env('MAIL_FROM_ADDRESS') ?: env('MAIL_USERNAME');
            $fromName = config('mail.from.name') ?: env('MAIL_FROM_NAME') ?: 'TRAVELA';
            
            Mail::send('clients.mail.emails_activation', ['link' => $activation_link, 'title' => 'Kích hoạt tài khoản'], function ($message) use ($email, $fromAddress, $fromName) {
                $message->from($fromAddress, $fromName);
                $message->to($email);
                $message->subject('Kích hoạt tài khoản của bạn');
            });
            return true;
        } catch (\Exception $e) {
            \Log::error('Activation email send error: ' . $e->getMessage(), ['email' => $email, 'exception' => $e]);
            return false;
        }
    }

    public function activateAccount($token)
    {
        $user = $this->login->getUserByToken($token);
        if (!$user) {
            return redirect('/login')->with('error', 'Mã kích hoạt không hợp lệ hoặc đã hết hạn!');
        }

        // Kiểm tra token có còn hiệu lực không (24 giờ)
        if (!empty($user->activation_token_expires)) {
            $now = Carbon::now();
            $expires = Carbon::parse($user->activation_token_expires);
            if ($now->gt($expires)) {
                return redirect('/login')->with('error', 'Liên kết kích hoạt đã hết hạn. Vui lòng yêu cầu gửi lại email xác nhận!');
            }
        }

        $this->login->activateUserAccount($token);

        return redirect('/login')->with('message', 'Tài khoản của bạn đã được kích hoạt! Vui lòng đăng nhập.');
    }

    // Yêu cầu gửi lại email xác nhận
    public function resendActivationEmail(Request $request)
    {
        $email_or_username = $request->email_or_username;

        $user = DB::table('tbl_users')->where(function($query) use ($email_or_username) {
            $query->where('email', $email_or_username)
                  ->orWhere('username', $email_or_username);
        })->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email hoặc tên đăng nhập không tồn tại!'
            ]);
        }

        // Kiểm tra tài khoản đã được kích hoạt chưa
        if ($user->is_activated) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản của bạn đã được kích hoạt rồi!'
            ]);
        }

        // Tạo token mới và cập nhật thời hạn (24 giờ)
        $new_token = Str::random(60);
        $expires = Carbon::now()->addHours(24);

        DB::table('tbl_users')->where('userId', $user->userId)->update([
            'activation_token' => $new_token,
            'activation_token_expires' => $expires
        ]);

        // Gửi email xác nhận mới
        $sent = $this->sendActivationEmail($user->email, $new_token);
        if ($sent) {
            return response()->json([
                'success' => true,
                'message' => 'Email xác nhận đã được gửi lại. Vui lòng kiểm tra email của bạn!'
            ]);
        } else {
            \Log::error('Resend activation email failed (sendActivationEmail returned false)', ['email' => $user->email]);
            return response()->json([
                'success' => false,
                'message' => 'Lỗi gửi email. Vui lòng thử lại sau!'
            ]);
        }
    }

    //Xử lý người dùng đăng nhập
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // Lấy user theo username
        $user = DB::table('tbl_users')->where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin tài khoản không chính xác!',
            ]);
        }

        // Kiểm tra tài khoản đã được kích hoạt chưa
        if (!$user->is_activated) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản của bạn chưa được kích hoạt. Vui lòng kiểm tra email để xác nhận đăng ký!',
                'unactivated' => true
            ]);
        }

        // Kiểm tra xem tài khoản đang bị khóa hay không
        if (!empty($user->lock_until)) {
            $now = Carbon::now();
            $lockUntil = Carbon::parse($user->lock_until);
            if ($now->lt($lockUntil)) {
                $minutesLeft = $now->diffInMinutes($lockUntil);
                $requireReset = ($user->lock_level >= 3);
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản tạm thời bị khóa. Vui lòng thử lại sau ' . $minutesLeft . ' phút.',
                    'locked' => true,
                    'require_reset' => $requireReset,
                ]);
            }
        }

        // Kiểm tra mật khẩu
        if ($user->password === md5($password)) {
            // Đăng nhập thành công: reset counters và mở khóa
            DB::table('tbl_users')->where('userId', $user->userId)->update([
                'failed_attempts' => 0,
                'lock_until' => null,
                'lock_level' => 0,
                'reset_token' => null,
            ]);

            $request->session()->put('username', $username);
            $request->session()->put('avatar', $user->avatar);
            toastr()->success("Đăng nhập thành công!",'Thông báo');
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công!',
                'redirectUrl' => route('home'),
            ]);
        }

        // Mật khẩu sai: tăng failed_attempts
        $attempts = intval($user->failed_attempts ?? 0) + 1;

        if ($attempts >= 5) {
            // Tính level khóa mới
            $newLevel = intval($user->lock_level ?? 0) + 1;
            if ($newLevel > 3) $newLevel = 3;

            // Thời gian khóa theo level
            $minutes = 1;
            if ($newLevel == 2) $minutes = 5;
            if ($newLevel == 3) $minutes = 15;

            $lockUntil = Carbon::now()->addMinutes($minutes);

            DB::table('tbl_users')->where('userId', $user->userId)->update([
                'failed_attempts' => 0,
                'lock_until' => $lockUntil,
                'lock_level' => $newLevel,
            ]);

            // Tạo token đặt lại kèm expiry (30 phút) và lưu
            $reset_token = Str::random(60);
            $reset_expires = Carbon::now()->addMinutes(30);
            DB::table('tbl_users')->where('userId', $user->userId)->update(['reset_token' => $reset_token, 'reset_token_expires' => $reset_expires]);

            // Gửi email cảnh báo kèm link đặt lại mật khẩu
            try {
                Mail::send('clients.emails.account-locked', ['user' => $user, 'minutes' => $minutes, 'level' => $newLevel, 'reset_token' => $reset_token, 'expires' => $reset_expires, 'title' => 'Tài khoản bị khóa'], function($message) use ($user) {
                    $message->from(config('mail.from.address'), config('mail.from.name'));
                    $message->to($user->email)->subject('Tài khoản bị khóa tạm thời - Travela');
                });
            } catch (\Exception $e) {
                \Log::error('Mail send error (account-locked): ' . $e->getMessage());
            }

            $requireReset = ($newLevel >= 3);

            return response()->json([
                'success' => false,
                'message' => 'Tài khoản của bạn đã bị khóa tạm thời trong ' . $minutes . ' phút.',
                'locked' => true,
                'require_reset' => $requireReset,
            ]);
        } else {
            // Cập nhật số lần thử
            DB::table('tbl_users')->where('userId', $user->userId)->update(['failed_attempts' => $attempts]);
            return response()->json([
                'success' => false,
                'message' => 'Thông tin tài khoản không chính xác! (Lần thử: ' . $attempts . '/5)'
            ]);
        }
    }

    //Xử lý đăng xuất
    public function logout(Request $request)
    {
        // Xóa session lưu trữ thông tin người dùng đã đăng nhập
        $request->session()->forget('username');
        $request->session()->forget('avatar');
        $request->session()->forget('userId');
        toastr()->success("Đăng xuất thành công!",'Thông báo');
        return redirect()->route('home');
    }

    // Hiển thị trang quên mật khẩu
    public function forgotPasswordPage()
    {
        $title = 'Quên mật khẩu';
        return view('clients.forgot-password', compact('title'));
    }

    // Xử lý yêu cầu quên mật khẩu
    public function forgotPassword(Request $request)
    {
        $email_or_username = $request->email_forgot;
        
        // Tìm user theo email hoặc username
        $user = DB::table('tbl_users')->where(function($query) use ($email_or_username) {
            $query->where('email', $email_or_username)
                  ->orWhere('username', $email_or_username);
        })->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email hoặc tên đăng nhập không tồn tại!'
            ]);
        }

        // Tạo reset token và expiry (30 phút)
        $reset_token = Str::random(60);
        $expires = Carbon::now()->addMinutes(30);
        DB::table('tbl_users')->where('userId', $user->userId)->update(['reset_token' => $reset_token, 'reset_token_expires' => $expires]);

        // Gửi email hướng dẫn đặt lại mật khẩu (kèm token và thời hạn)
        try {
            Mail::send('clients.emails.forgot-password', ['user' => $user, 'reset_token' => $reset_token, 'expires' => $expires, 'title' => 'Quên mật khẩu'], function($message) use ($user) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($user->email)->subject('Đặt Lại Mật Khẩu - Travela');
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Hướng dẫn đặt lại mật khẩu đã được gửi đến email của bạn!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Mail send error (forgot-password): ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi gửi email. Vui lòng thử lại sau!'
            ]);
        }
    }

    // Hiển thị trang đặt lại mật khẩu
    public function resetPasswordPage($token)
    {
        $user = DB::table('tbl_users')->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Link không hợp lệ hoặc đã hết hạn!');
        }

        // Kiểm tra expiry token
        if (!empty($user->reset_token_expires)) {
            $now = Carbon::now();
            $expires = Carbon::parse($user->reset_token_expires);
            if ($now->gt($expires)) {
                return redirect()->route('login')->with('error', 'Link đặt lại mật khẩu đã hết hạn!');
            }
        }

        $title = 'Đặt lại mật khẩu';
        return view('clients.reset-password', compact('title', 'token'));
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $token = $request->token;
        $password_new = $request->password_reset;
        $password_confirm = $request->password_confirm;

        // Kiểm tra mật khẩu
        if ($password_new != $password_confirm) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu xác nhận không khớp!'
            ]);
        }

        if (strlen($password_new) < 6) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu phải có ít nhất 6 ký tự!'
            ]);
        }

        $user = DB::table('tbl_users')->where('reset_token', $token)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Link không hợp lệ hoặc đã hết hạn!'
            ]);
        }

        // Kiểm tra expiry token
        if (!empty($user->reset_token_expires)) {
            $now = Carbon::now();
            $expires = Carbon::parse($user->reset_token_expires);
            if ($now->gt($expires)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Link đặt lại mật khẩu đã hết hạn!'
                ]);
            }
        }

        // Cập nhật mật khẩu và mở khóa tài khoản, reset số lần vi phạm
        DB::table('tbl_users')->where('userId', $user->userId)->update([
            'password' => md5($password_new),
            'reset_token' => null,
            'reset_token_expires' => null,
            'failed_attempts' => 0,
            'lock_until' => null,
            'lock_level' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mật khẩu đã được đặt lại thành công!',
            'redirectUrl' => route('login')
        ]);
    }


}
