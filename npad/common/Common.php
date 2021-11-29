<?php
class Common {
    static $_HOME_PAGE = "http://nganphat.ttcjsc.vn/";
//     static $_HOME_PAGE = "http://localhost/nganphat";
    
//    static $_MAIL_SERVER_ADDRESS = 'hien.works';
//    static $_MAIL_SERVER_ADDRESS = 'smtp.gmail.com';
//    static $_MAIL_SERVER_USER = 'mail@hien.works';
//    static $_MAIL_SERVER_PASS = 'Khang@0604';
//    static $_MAIL_SERVER_EMAIL_DISPLAY = 'NGÃ‚N PHÃT';
 
    static $_MAIL_SERVER_ADDRESS = 'smtp.office365.com';
    static $_MAIL_SERVER_USER = 'nganphat_test@ttcjsc.vn';
    static $_MAIL_SERVER_PASS = 'Qwer@7890#!';
    static $_MAIL_SERVER_EMAIL_DISPLAY = 'NGÃ‚N PHÃT';

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
        $mail->setFrom('mail@hien.works', 'NGÃ‚N PHÃT');
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
            '/Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ|Ã€|Ã|áº |áº¢|Ãƒ|Ã‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´|Ã¥/' => 'a',
            '/Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»|áº¿|á»‡|á»ƒ|á»…|Ãˆ|Ã‰|áº¸|áºº|áº¼|ÃŠ|á»€|áº¾|á»†|á»‚|á»„|Ã«/' => 'e',
            '/Ã¬|Ã­|á»‹|á»‰|Ä©|ÃŒ|Ã|á»Š|á»ˆ|Ä¨|Ã®/' => 'i',
            '/Ã²|Ã³|á»|á»|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»|á»›|á»£|á»Ÿ|á»¡|Ã’|Ã“|á»Œ|á»Ž|Ã•|Ã”|á»’|á»|á»˜|á»”|á»–|Æ |á»œ|á»š|á»¢|á»ž|á» |Ã¸/' => 'o',
            '/Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯|Ã™|Ãš|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®|Å¯|Ã»/' => 'u',
            '/á»³|Ã½|á»µ|á»·|á»¹|á»²|Ã|á»´|á»¶|á»¸/' => 'y',
            '/Ä‘|Ä/' => 'd',
            '/Ã§/' => 'c',
            '/Ã±/' => 'n',
            '/Ã¤|Ã¦/' => 'ae',
            '/Ã¶/' => 'oe',
            '/Ã¼/' => 'ue',
            '/Ã„/' => 'Ae',
            '/Ãœ/' => 'Ue',
            '/Ã–/' => 'Oe',
            '/ÃŸ/' => 'ss',
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
        $str = preg_replace("/(Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ)/", 'a', $str);
        $str = preg_replace("/(Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»|áº¿|á»‡|á»ƒ|á»…)/", 'e', $str);
        $str = preg_replace("/(Ã¬|Ã­|á»‹|á»‰|Ä©)/", 'i', $str);
        $str = preg_replace("/(Ã²|Ã³|á»|á»|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»|á»›|á»£|á»Ÿ|á»¡)/", 'o', $str);
        $str = preg_replace("/(Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯)/", 'u', $str);
        $str = preg_replace("/(á»³|Ã½|á»µ|á»·|á»¹)/", 'y', $str);
        $str = preg_replace("/(Ä‘)/", 'd', $str);
        $str = preg_replace("/(Ã€|Ã|áº |áº¢|Ãƒ|Ã‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´)/", 'A', $str);
        $str = preg_replace("/(Ãˆ|Ã‰|áº¸|áºº|áº¼|ÃŠ|á»€|áº¾|á»†|á»‚|á»„)/", 'E', $str);
        $str = preg_replace("/(ÃŒ|Ã|á»Š|á»ˆ|Ä¨)/", 'I', $str);
        $str = preg_replace("/(Ã’|Ã“|á»Œ|á»Ž|Ã•|Ã”|á»’|á»|á»˜|á»”|á»–|Æ |á»œ|á»š|á»¢|á»ž|á» )/", 'O', $str);
        $str = preg_replace("/(Ã™|Ãš|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®)/", 'U', $str);
        $str = preg_replace("/(á»²|Ã|á»´|á»¶|á»¸)/", 'Y', $str);
        $str = preg_replace("/(Ä)/", 'D', $str);
        return $str;
    }
    
    static function convertMoney($str) {
        if (is_numeric($str)) {
            return number_format($str) . ' Ä‘';
        } else {
//             return number_format(0) . ' Ä‘';
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