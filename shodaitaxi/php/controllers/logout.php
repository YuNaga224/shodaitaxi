<?php 
namespace controller\logout;

use lib\Auth;
use lib\Msg;
use model\CarpoolModel;
use Throwable;

function get() {
    if(Auth::logout()) {
        Msg::push(Msg::INFO, 'ログアウトが成功しました');
        try {
            CarpoolModel::clearSession();
        }catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            return false;
        }
    }else {
        Msg::push(Msg::ERROR,'ログアウトが失敗しました');
    }

    redirect(GO_HOME);
}