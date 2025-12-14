

<div style="max-width:600px;margin:20px auto;font-family: 'Outfit', sans-serif;">
    <h2 style="color:#63AB45;">Tài khoản của bạn đã bị khóa tạm thời</h2>
    <p>Xin chào <?php echo e($user->fullName ?? $user->username); ?>,</p>
    <p>Chúng tôi phát hiện có nhiều lần đăng nhập không thành công. Tài khoản của bạn đã bị khóa tạm thời trong <strong><?php echo e($minutes); ?> phút</strong>.</p>
    <p><strong>– Xác nhận đây có phải bạn không?</strong></p>
    <p>Nếu đây là bạn, vui lòng bỏ qua email này và thử đăng nhập lại sau khi hết thời gian khóa.</p>

    <p><strong>– Đặt lại mật khẩu</strong></p>
    <p>Để đặt lại mật khẩu ngay, bấm nút dưới đây. Liên kết có kèm token bảo mật và sẽ hết hạn vào <strong><?php echo e(isset($expires) ? $expires : 'sau 30 phút'); ?></strong>.</p>
    <?php if(isset($reset_token)): ?>
    <div style="text-align:center;margin:20px 0;">
        <a href="<?php echo e(route('reset-password', ['token' => $reset_token])); ?>" style="background:#63AB45;color:#fff;padding:12px 20px;border-radius:6px;text-decoration:none;">Đặt lại mật khẩu ngay</a>
    </div>
    <?php endif; ?>
    <p style="margin-top:20px;color:#666;">Nếu bạn cần trợ giúp, liên hệ: support@travela.com</p>
</div>


<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/clients/emails/account-locked.blade.php ENDPATH**/ ?>