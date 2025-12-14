<!-- Debug: Check current session -->
<?php
    $sessionAdmin = session()->get('admin');
    echo "<!-- SESSION DATA DEBUG -->";
    echo "<!-- Session admin type: " . gettype($sessionAdmin) . " -->";
    echo "<!-- Session admin value: " . json_encode($sessionAdmin) . " -->";
?>
<?php /**PATH C:\xampp\htdocs\travela-master\travela-master\resources\views/admin/blocks/debug_session.blade.php ENDPATH**/ ?>