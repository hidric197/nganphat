<?php
class Common {
    // static $_HOME_PAGE = "http://nganphat.ttcjsc.vn/";
    static $_HOME_PAGE = "http://localhost/nganphat";
    
    static $_MAIL_SERVER_ADDRESS = 'hien.works';
    static $_MAIL_SERVER_USER = 'mail@hien.works';
    static $_MAIL_SERVER_PASS = 'Khang@0604';
    static $_MAIL_SERVER_EMAIL_DISPLAY = 'NGÂN PHÁT';
    
    static $_NP_MAIL = 'nganphat.ltd@gmail.com';
//     static $_NP_MAIL = 'hien2010@gmail.com';
    /**
     * // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'hien.works';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 2525;
        $mail->Username = 'mail@hien.works'; //  email
        $mail->Password = 'Khang@0604'; // password

        // Sender and recipient settings
        $mail->setFrom('mail@hien.works', 'NGÂN PHÁT');
     */
    
    static $_TABLE_NP_PROD = "np_product";
    
    static $_TABLE_NP_PROD_GROUP = "np_prod_group";
    
    static $_TABLE_NP_PROD_BRAND = "np_prod_brand";
    
    static $_TABLE_NP_PAGE = "np_page";
    
    static $_TABLE_NP_LANDING_PAGE = "np_landing_page";
    
    static $_TABLE_NP_PROD_TAG = "np_prod_tag";
    
    static $_TABLE_NP_PROD_FILTER = "np_prod_filter";
    
    static $_GROUP_THIET_BI_VE_SINH = "thiet-bi-ve-sinh";
    
    static $_GROUP_THIET_BI_VE_SINH_NOI_BAT = "thiet-bi-ve-sinh-noi-bat";
    
    static $_GROUP_THIET_BI_DIEN = "thiet-bi-dien";
    
    static $_GROUP_THIET_BI_DIEN_NOI_BAT = "thiet-bi-dien-noi-bat";
    
    static $_GROUP_THIET_BI_NHA_BEP = "thiet-bi-nha-bep";
    
    static $_GROUP_THIET_BI_NHA_BEP_NOI_BAT = "thiet-bi-nha-bep-noi-bat";
    
    static $_GROUP_THIET_BI_VE_SINH_TYPE = "1";
    
    static $_GROUP_THIET_BI_NHA_BEP_TYPE = "2";
    
    static $_GROUP_THIET_BI_DIEN_TYPE = "3";
    
    
    
    static $_PAGING_NUMBER = 40;
    static $_PAGING_NUMBER_VIEW = 10;
    
    static $_PAGING_NUMBER_MB = 30;
    static $_PAGING_NUMBER_VIEW_MB = 10;
    
    static $_SESSION_USER_INFO = "user_info_session";
    
    static $_SESSION_CHECKOUT_INFO = "checkout_info_session";
    
    static $SESSION_ADMIN_USER_INFO = "session_admin_user_info";
    
    static $SESSION_USER_READ_PAGE = "session_user_read_page";
    
    static $SESSION_USER_VIEW_PRODUCT = "session_user_view_product";
    
    static $SESSION_TOP_ADS = "session_top_ads";
    
    static function convertSlug($str) {
        $replacement = '-';
        $map = array();
        $quotedReplacement = preg_quote($replacement, '/');
        $default = array(
            '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
            '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
            '/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
            '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
            '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
            '/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/' => 'y',
            '/đ|Đ/' => 'd',
            '/ç/' => 'c',
            '/ñ/' => 'n',
            '/ä|æ/' => 'ae',
            '/ö/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/ß/' => 'ss',
            '/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/\\s+/' => $replacement,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        //Some URL was encode, decode first
        $str = urldecode($str);
        $map = array_merge($map, $default);
        return strtolower(preg_replace(array_keys($map), array_values($map), $str));
    }
    
    static function stripVN($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
    
    static function convertMoney($str) {
        if (is_numeric($str)) {
            return number_format($str) . ' đ';
        } else {
//             return number_format(0) . ' đ';
            return $str;
        }
    }
    
    static function isPhoneNumber($str) {
        if (!is_numeric($str)) {
            return false;
        }
        if (strlen($str) != 10 && strlen($str) != 11) {
            return false;
        }
        return true;
    }
    
    static function isEmail($str) {
        if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
}