<?php 
namespace lib;

use db\UserQuery;
use model\UserModel;
use Throwable;

class Auth {

    public static function login($id,$pwd) {
        try {
            if (!(UserModel::validateId($id)
                *UserModel::validatePwd($pwd))) {
                    return false;
                }

                $is_success = false;

                $user = UserQuery::fetchById($id);

                if(!empty($user)) {

                    if(password_verify($pwd, $user->pwd)) {
                        $is_success = true;
                        UserModel::setSession($user);

                    }else {
                        Msg::push(Msg::ERROR,'パスワードが一致しません');
                    }
                } else {
                    Msg::push(Msg::ERROR,'ユーザーが見つかりません');
                }
        }catch(Throwable $e) {

            $is_success = false;

            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR,'ログイン処理でエラーが発生しました.少し時間をおいて再度お試しください');
        }

        return $is_success;
    }

    public static function regist($user) {

        try{
            if(!($user->isValidId()
                *$user->isValidPwd()
                *$user->isValidNickname())) {
                    return false;
                }

                $is_success = false;

                $exist_user = UserQuery::fetchById($user->id);

                if(!empty($exist_user)) {
                    Msg::push(Msg::ERROR, 'ユーザーが既に存在します');
                    return false;
                }

                $is_success = UserQuery::insert($user);

                if($is_success) {
                    UserModel::setSession($user);
                }
        }catch(Throwable $e) {

            $is_success = false;
            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::ERROR,'ユーザー登録中にエラーが発生しました。時間をおいて再度お試しください');
        }

        return $is_success;
    }

    public static function isLogin() {
        try{

            $user = UserModel::getSession();
        }catch(Throwable $e) {
            UserModel::clearSession();
            Msg::push(Msg::DEBUG,$e->getMessage());
            return false;
        }

        if(isset($user)) {
            return true;
        }else {
            return false;
        }
    }

    public static function logout() {
        try {
            UserModel::clearSession();
        }catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
        return true;
    }

    public static function requireLogin() {
        if(!static::isLogin()) {
            Msg::push(Msg::ERROR,'ログインしてください');
            redirect('login');
        }
    }

}