<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffAccessRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the authenticated admin user from session
        $admin = $request->session()->get('admin');

        // If no admin is logged in, redirect to login
        if (!$admin) {
            return redirect()->route('admin.login');
        }

        // If user is staff, restrict access to certain pages
        if (isset($admin['role']) && $admin['role'] === 'staff') {
            // Define restricted routes for staff
            $restrictedRoutes = ['admin.dashboard', 'admin.users', 'admin.admin'];

            // Check if current route is in restricted list
            if (in_array($request->route()->getName(), $restrictedRoutes)) {
                return redirect()->route('admin.staff.index')->with('error', 'Bạn không có quyền truy cập trang này');
            }
        }

        return $next($request);
    }
}
