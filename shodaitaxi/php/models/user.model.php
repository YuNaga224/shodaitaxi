<?php 
namespace model;

use lib\Msg;

class UserModel extends AbstractModel {

    public string $id;
    public string $pwd;
    public string $nickname;
    public string $relate_carpool = "none";
    public int $user_num = 0;

    protected static $SESSION_NAME = '_user';

    public function isValidId() {

        return static::validateId($this->id);
    }

    public static function validateId($val) {
        $res = true;

        if(empty($val)) {

            Msg::push(Msg::ERROR, 'ユーザーIDを入力して下さい');
            $res = false;
        } else {

            if(strlen($val) > 20) {
                Msg::push(Msg::ERROR,'ユーザーIDは20桁以下で入力してください');
                $res = false;
            }

            if(!is_alnum($val)) {
                Msg::push(Msg::ERROR, 'ユーザーIDは半角英数字で入力してください');
                $res = false;
            }
        }
        return $res;
    }

    public static function validatePwd($val) {
        $res = true;

        if(empty($val)) {
            Msg::push(Msg::ERROR,'パスワードを入力して下さい');
            $res = false;
        }else {
            if(strlen($val) < 6) {
                Msg::push(Msg::ERROR, 'パスワードは６桁以上で入力してください');
                $res = false;
            }
            if(!is_alnum($val)) {
                Msg::push(Msg::ERROR,'パスワードは半角英数字で入力してください');
                $res = false;
            }
        }
        return $res;
    }

    public function isValidPwd() {
        return static::validatePwd($this->pwd);
    }

    public static function validateNickname($val) {
        $res = true;

        if(empty($val) ) {
            Msg::push(Msg::ERROR,'ニックネームを入力してください');
            $res = false;
        }else {
            if(mb_strlen($val) > 8) {
                Msg::push(Msg::ERROR,'ニックネームは8桁以下で入力してください');
                $res = false;
            }
        }
        return $res;
    }

    public function isValidNickname() {
        return static::validateNickname($this->nickname);
    }
}