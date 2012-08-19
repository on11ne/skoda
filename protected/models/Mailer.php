<?php
/**
 * Created by JetBrains PhpStorm.
 * User: online
 * Date: 19.08.12
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */

class Mailer {

    public static function sendToModerator($from, $from_name, $subject, $message) {

        $name   =   '=?UTF-8?B?' . base64_encode($from_name) . '?=';
        $subject=   '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $headers=   "From: $from_name <" . $from . ">\r\n".
                    "Reply-To: " . $from . "\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/html; charset=UTF-8";

        $to = Yii::app()->params['moderatorEmail'];

        if(mail($to, $subject, $message, $headers))
            return true;
        else
            return false;
    }

    public static function sendToAdministrator($from, $from_name, $subject, $message) {

        $name   =   '=?UTF-8?B?' . base64_encode($from_name) . '?=';
        $subject=   '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $headers=   "From: $from_name <" . $from . ">\r\n".
            "Reply-To: " . $from . "\r\n".
            "MIME-Version: 1.0\r\n".
            "Content-type: text/html; charset=UTF-8";

        $to = Yii::app()->params['adminEmail'];

        if(mail($to, $subject, $message, $headers))
            return true;
        else
            return false;
    }

    public static function sendToUser($user_email, $subject, $message) {

        $name   =   '=?UTF-8?B?' . base64_encode(Yii::app()->params['adminName']) . '?=';
        $subject=   '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $headers=   "From: $name <" . Yii::app()->params['adminEmail'] . ">\r\n".
            "Reply-To: " . Yii::app()->params['adminEmail'] . "\r\n".
            "MIME-Version: 1.0\r\n".
            "Content-type: text/html; charset=UTF-8";

        if(mail($user_email, $subject, $message, $headers))
            return true;
        else
            return false;
    }
}