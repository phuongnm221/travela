<?php echo $__env->make('clients.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('clients.blocks.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="container" style="margin-top:50px; margin-bottom: 100px">
    

    <form action="<?php echo e(route('create-booking')); ?>" method="post" class="booking-container">
        <?php echo csrf_field(); ?>
        <!-- Contact Information -->
        <div class="booking-info">
            <h2 class="booking-header">Thông Tin Liên Lạc</h2>
            <div class="booking__infor">
                <div class="form-group">
                    <label for="username">Họ và tên*</label>
                    <input type="text" id="username" placeholder="Nhập Họ và tên" name="fullName"
                    value="<?php echo e($user->fullName); ?>" required>
                    <span class="error-message" id="usernameError"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" id="email" placeholder="sample@gmail.com" name="email"
                    value="<?php echo e($user->email); ?>" required>
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <label for="tel">Số điện thoại*</label>
                    <input type="tel" id="tel" placeholder="Nhập số điện thoại liên hệ" name="tel"
                       value="<?php echo e($user->phoneNumber); ?>" required>
                    <span class="error-message" id="telError"></span>
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ*</label>
                    <input type="text" id="address" placeholder="Nhập địa chỉ liên hệ" name="address"
                    value="<?php echo e($user->address); ?>" required>
                    <span class="error-message" id="addressError"></span>
                </div>

            </div>


            <!-- Passenger Details -->
            <h2 class="booking-header">Hành Khách</h2>

            <div class="booking__quantity">
                <div class="form-group quantity-selector">
                    <label>Người lớn</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" class="quantity-input" value="1" min="1" id="numAdults"
                            name="numAdults" data-price-adults="<?php echo e($tour->priceAdult); ?>" readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>

                <div class="form-group quantity-selector">
                    <label>Trẻ em</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" class="quantity-input" value="0" min="0" id="numChildren"
                            name="numChildren" data-price-children="<?php echo e($tour->priceChild); ?>" readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>
            </div>
            <!-- Privacy Agreement Section -->
            <div class="privacy-section">
                <p>Bằng cách nhấp chuột vào nút "ĐỒNG Ý" dưới đây, Khách hàng đồng ý rằng các điều kiện điều khoản
                    này sẽ được áp dụng. Vui lòng đọc kỹ điều kiện điều khoản trước khi lựa chọn sử dụng dịch vụ của
                    Travela.</p>
                <div class="privacy-checkbox">
                    <input type="checkbox" id="agree" name="agree" required>
                    <label for="agree">Tôi đã đọc và đồng ý với <a href="#" target="_blank">Điều khoản thanh
                            toán</a></label>
                </div>
            </div>
            
            <!-- Payment Method -->
            <h2 class="booking-header">Phương Thức Thanh Toán</h2>

            <label class="payment-option">
                <input type="radio" name="payment" value="office-payment" required>
                <img src="<?php echo e(asset('clients/assets/images/contact/icon.png')); ?>" alt="Office Payment">
                Thanh toán tại văn phòng
            </label>

            <label class="payment-option">
                <input type="radio" name="payment" value="vnpay-payment" required>
                <img src="<?php echo e(asset('clients/assets/images/booking/vnpay.png')); ?>" alt="VNPAY">
                Thanh toán bằng VNPAY
            </label>

            <label class="payment-option">
                <input type="radio" name="payment" value="stripe-payment" required>
                <img src="<?php echo e(asset('clients/assets/images/booking/Stripe-Logo.png')); ?>" alt="VNPAY">
                Thanh toán bằng Stripe
            </label>

            <input type="hidden" name="payment_hidden" id="payment_hidden">
        </div>

        <!-- Order Summary -->
        <div class="booking-summary">
            <div class="summary-section">
                <div>
                    <p>Mã tour : <?php echo e($tour->tourId); ?></p>
                    <input type="hidden" name="tourId" id="tourId" value="<?php echo e($tour->tourId); ?>">
                    <h5 class="widget-title"><?php echo e($tour->title); ?></h5>
                    <p>Ngày khởi hành : <?php echo e(date('d-m-Y', strtotime($tour->startDate))); ?></p>
                    <p>Ngày kết thúc : <?php echo e(date('d-m-Y', strtotime($tour->endDate))); ?></p>
                    <p class="quantityAvailable">Số chỗ còn nhận : <?php echo e($tour->quantity); ?></p>
                </div>

                <div class="order-summary">
                    <div class="summary-item">
                        <span>Người lớn:</span>
                        <div>
                            <span class="quantity__adults">1</span>
                            <span>X</span>
                            <span class="total-price">0 VNĐ</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <span>Trẻ em:</span>
                        <div>
                            <span class="quantity__children">0</span>
                            <span>X</span>
                            <span class="total-price">0 VNĐ</span>
                        </div>
                    </div>
                    <div class="summary-item total-price">
                        <span>Tổng cộng:</span>
                        <span>0 VNĐ</span>
                        <input type="hidden" class="totalPrice" name="totalPrice" value="">
                    </div>
                </div>
               
                <button type="submit" class="booking-btn btn-submit-booking">Xác Nhận</button>

            </div>
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const hidden = document.getElementById('payment_hidden');
  const radios = document.querySelectorAll('input[name="payment"]');

  function syncPayment() {
    const selected = document.querySelector('input[name="payment"]:checked');
    hidden.value = selected ? selected.value : '';
    console.log('payment_hidden =', hidden.value);
  }

  radios.forEach(r => r.addEventListener('change', syncPayment));
  syncPayment();
});
</script>

<?php echo $__env->make('clients.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\travela\resources\views/clients/booking.blade.php ENDPATH**/ ?>