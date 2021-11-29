<?php
    include 'npad/lib/gmail/Mail.php';

	$message = '';       
	$mail_name = $_POST['mail_name'] ?? '';
    $mail_phone = $_POST['mail_phone'] ?? '';
    $mail_contact = $_POST['mail_contact'] ?? '';
    $mail_content = $_POST['mail_content'] ?? '';
    $send_url = $_POST['send_url'] ?? '';
    $status = 'error';
    if (empty($mail_name) || empty($mail_phone)
        || empty($mail_contact) || empty($mail_content)){
         $message = "<span style='color: red'>* Bạn hãy nhập đủ thông tin.</span>";
    } else if (!Common::isPhoneNumber($mail_phone)) {
        $message = "<span style='color: red'>* Bạn nhập sai trường Số Điện Thoại. Hãy nhập lại.</span>";
    } else if (!Common::isEmail($mail_contact)) {
        $message = "<span style='color: red'>* Bạn nhập sai trường Email. Hãy nhập lại.</span>";
    } else {
	    // Send Mail
	    $titleMail = 'Thông Tin Liên Hệ Tư Vấn Nganphat.com.vn';
	    $bodyMail = '';
	    $bodyMail .= 'Thông tin khách hàng như sau : <br>';
	    $bodyMail .= 'Tên Khách Hàng : ' .$mail_name. '<br>';
	    $bodyMail .= 'Số Điện Thoại : ' .$mail_phone. '<br>';
	    $bodyMail .= 'Email : ' .$mail_contact. '<br>';
	    $bodyMail .= 'Nội Dung : ' .$mail_content. '<br>';
	    $bodyMail .= 'Gửi từ URL : ' .$send_url. '<br><br>';
	    $to_mail = Common::$_NP_MAIL;
	    Mail::send('hieutk13.4@gmail.com', $mail_name, "", $titleMail, $bodyMail);
	    
	    $message = "<span style='color: red'>* Cám ơn bạn đã liên hệ. Chúng tôi sẽ liên lạc với bạn sớm nhất.</span>";
	    $status = "success";
    }
    var_dump($message);die;
    // echo json_encode(['message' => $message, 'status' => $status]);die;
?>