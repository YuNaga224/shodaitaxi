<?php 
namespace view\carpool\meet;
use lib\Chat;
use lib\Chatlog;

function index($user,$carpool) {
?>

<div class="chat-system">
    <div class="chat-box">
        <div class="chat-area" id="chat-area">
            <?php 
                \lib\chatlog();
            ?>
        </div>
    </div>
    <form id="form" class = "send-box flex-box" action="<?php echo CURRENT_URI?>" method="POST">
        <textarea name="text" id="textarea" cols="30" rows="1" maxlength="50" required placeholder="入力してください"></textarea>
        <!-- <input type="submit" name="submit" value="送信" id="search"> -->
        <input type="hidden" name="submit" value="送信" id="search">
        <input type="submit" name="submit" value="送信" id="search">
        <label for="search"><i class="far fa-paper-plane"></i></label>
    </form>
</div>

<div>
    <form action="<?php echo CURRENT_URI?>" method="GET">
    <input class="btn back-btn" type="submit" name="reset" value="チャット履歴をリセット">
    </form>
</div>


<?php 
}
 ?>