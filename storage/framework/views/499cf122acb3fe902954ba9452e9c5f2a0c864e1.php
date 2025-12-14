<?php echo $__env->make('admin.blocks.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container body">
    <div class="main_container">
        <?php echo $__env->make('admin.blocks.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <div class="page-title">
                    <div class="title_left">
                        <h3>Liên hệ</h3>
                    </div>

                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tại đây, bạn có thể xem và quản lý các thông tin liên lạc từ khách hàng, trả lời câu
                                    hỏi, <br> và theo dõi các trao đổi để cải thiện dịch vụ.</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-3 mail_list_column">
                                        <label for="" class="badge bg-green"
                                            style="width: 100%;line-height: 2;font-size: 16px;">Liên hệ khách
                                            hàng</label>
                                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="javascript:void(0)" class="contact-item"
                                                data-name="<?php echo e($contact->fullName); ?>" data-email="<?php echo e($contact->email); ?>"
                                                data-message="<?php echo e($contact->message); ?>" data-contactid="<?php echo e($contact->contactId); ?>">
                                                <div class="mail_list">
                                                    <div class="left">
                                                        <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
                                                    </div>
                                                    <div class="right">
                                                        <h3><?php echo e($contact->fullName); ?>

                                                            <small><?php echo e($contact->phoneNumber); ?></small>
                                                        </h3>
                                                        <p class="text-contact-truncate"><?php echo e($contact->message); ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <!-- /MAIL LIST -->

                                    <!-- CONTENT MAIL -->
                                    <div class="col-sm-9 mail_view">
                                        <div class="inbox-body">
                                            <div class="sender-info" style="border-bottom: 1px solid #ddd">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <strong></strong>
                                                        <span></span> to
                                                        <b>me</b>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="view-mail">
                                                <p></p>
                                                <div class="btn-group">
                                                    <button id="compose" class="btn btn-sm btn-primary"
                                                        type="button"><i class="fa fa-reply"></i> Reply</button>

                                                    <button class="btn btn-sm btn-default" type="button"
                                                        data-placement="top" data-toggle="tooltip"
                                                        data-original-title="Trash"><i
                                                            class="fa fa-trash-o"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /CONTENT MAIL -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>

    <!-- compose -->
    <div class="compose col-md-6  ">
        <div class="compose-header">
            Phản hồi liên hệ
            <button type="button" class="close compose-close">
                <span>×</span>
            </button>
        </div>

        <div class="compose-body">
            <div id="editor-contact" class="editor-wrapper"></div>
        </div>

        <div class="compose-footer">
            <button id="" class="send-reply-contact btn btn-sm btn-success" type="button"
                data-url="<?php echo e(route('admin.reply-contact')); ?>">Gửi</button>
        </div>
    </div>
    <!-- /compose -->

    <?php echo $__env->make('admin.blocks.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/admin/contact.blade.php ENDPATH**/ ?>