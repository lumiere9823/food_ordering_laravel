<?php
$file = 'C:\laragon\etc\ssl\cacert.pem';

if (file_exists($file)) {
    echo "File $file tồn tại.<br>";

    // Đọc nội dung của file
    $contents = file_get_contents($file);

    if ($contents !== false) {
        echo 'Nội dung của file:<br>';
        echo nl2br(htmlspecialchars($contents));
    } else {
        echo 'Không thể đọc nội dung của file.';
    }
} else {
    echo "File $file không tồn tại.";
}
?>