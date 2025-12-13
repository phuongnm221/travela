<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    /**
     * Redirect to Google for authentication
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback from Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user exists by google_id
            $user = DB::table('tbl_users')->where('google_id', $googleUser->getId())->first();
            
            if ($user) {
                // User exists, update token and login
                DB::table('tbl_users')->where('userId', $user->userId)->update([
                    'provider_token' => $googleUser->token,
                    'updated_at' => Carbon::now()
                ]);
                
                // Set session like LoginController does
                session()->put('username', $user->username);
                session()->put('avatar', $user->avatar);
                session()->put('userId', $user->userId);

                return redirect('/')->with('success', 'Đăng nhập bằng Google thành công!');
            } else {
                // Check if email exists
                $existingUser = DB::table('tbl_users')->where('email', $googleUser->getEmail())->first();
                
                if ($existingUser) {
                    // Email exists, link Google to existing account
                    DB::table('tbl_users')->where('userId', $existingUser->userId)->update([
                        'google_id' => $googleUser->getId(),
                        'provider' => 'google',
                        'provider_token' => $googleUser->token,
                        'updated_at' => Carbon::now()
                    ]);
                    
                    // Set session
                    session()->put('username', $existingUser->username);
                    session()->put('avatar', $existingUser->avatar);
                    session()->put('userId', $existingUser->userId);

                    return redirect('/')->with('success', 'Liên kết Google thành công!');
                }
                
                // Create new user
                $username = $this->generateUniqueUsername($googleUser->getName());
                
                // Determine avatar: use Google avatar URL if present, otherwise relative default path
                $avatar = $googleUser->getAvatar();
                if (empty($avatar)) {
                    $avatar = 'clients/assets/images/user-profile/default.jpg';
                }

                $userId = DB::table('tbl_users')->insertGetId([
                    'username' => $username,
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Random password
                    'google_id' => $googleUser->getId(),
                    'provider' => 'google',
                    'provider_token' => $googleUser->token,
                    'is_activated' => 1, // Auto-activate for OAuth users
                    'avatar' => $avatar,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                // Set session for new user
                session()->put('username', $username);
                session()->put('avatar', $avatar);
                session()->put('userId', $userId);

                return redirect('/')->with('success', 'Đăng ký và đăng nhập thành công!');
            }
        } catch (\Exception $e) {
            \Log::error('Google OAuth error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Lỗi đăng nhập Google: ' . $e->getMessage());
        }
    }

    /**
     * Generate unique username from Google name
     */
    private function generateUniqueUsername($name)
    {
        // Remove spaces and special characters
        $username = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $name)));
        
        // Ensure username is at least 3 characters
        if (strlen($username) < 3) {
            $username = substr(md5($name), 0, 8);
        }
        
        // Check if username exists
        $original = $username;
        $counter = 1;
        
        while (DB::table('tbl_users')->where('username', $username)->exists()) {
            $username = $original . $counter;
            $counter++;
        }
        
        return $username;
    }
}
