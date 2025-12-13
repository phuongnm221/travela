<!-- Debug: Check current session -->
@php
    $sessionAdmin = session()->get('admin');
    echo "<!-- SESSION DATA DEBUG -->";
    echo "<!-- Session admin type: " . gettype($sessionAdmin) . " -->";
    echo "<!-- Session admin value: " . json_encode($sessionAdmin) . " -->";
@endphp
