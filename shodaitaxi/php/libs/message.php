<?php 
namespace lib;

use model\AbstractModel;
use Throwable;

class Msg extends AbstractModel {
    protected static $SESSION_NAME = '_msg';
    public const ERROR = 'error';
    public const INFO = 'info';
    public const DEBUG = 'debug';

    public static function push($type,$msg) {

        if(!is_array(static::getSession())) {
            static::init();
        }

        $msgs = static::getSession();
        $msgs[$type][] = $msg;
        static::setSession($msgs);
    }

    public static function flush() {
        try {
            $msgs_with_type = static::getSessionAndFlush() ?? [];

            echo '<div id="messages">';

            foreach($msgs_with_type as $type => $msgs) {
                if($type === static::DEBUG && !DEBUG) {
                    continue;
                }

                $color = $type === static::INFO ? 'alert-info' : 'alert-danger';

                foreach($msgs as $msg) {
                    echo "<div class='alert $color'>{$msg}</div>";
                }
            }
            echo '</div>';
        } catch (Throwable $e) {

            Msg::push(Msg::DEBUG, $e->getMessage());
            Msg::push(Msg::DEBUG, 'Msg::Flushで例外発生');
        }
    }

    private static function init() {

        static::setSession([
            static::ERROR => [],
            static::INFO => [],
            static::DEBUG => []
        ]);
    }
}