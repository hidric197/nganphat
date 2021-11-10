<?php
include 'npad/lib/gmail/Mail.php';
$result = Mail::send('gahiendt@gmail.com', 'DINH THE HIEN', 'hien2010@gmail.com', 'Thông Tin Order', 'Cám ơn Quý Khách đã lựa chọn sản phẩm của ngân Phát');

if ($result == 0) {
    echo 'Send mail thành công';
} else {
    echo 'Send mail không thành công';
}


