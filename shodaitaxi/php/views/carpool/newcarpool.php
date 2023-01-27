<?php

namespace view\carpool\newcarpool;

function index()
{
?>
    <div class="bg-white p-4 shadow-sm mx-auto rounded">
        <form action="<?php echo CURRENT_URI; ?>" method="POST">
            <div class="form-group mt-3">
                <label for="date">日付</label>
                <select name="date" id="date" required class="form-control">
                    <option value="">選択して下さい</option>
                    <option value="<?php echo date('m月d日') ?>">今日：<?php echo date('m月d日') ?></option>
                    <option value="<?php echo date('m月d日', strtotime('+1 day')) ?>">明日：<?php echo date('m月d日', strtotime('+1 day')) ?></option>
                    <option value="<?php echo date('m月d日', strtotime('+2 day')) ?>">明後日：<?php echo date('m月d日', strtotime('+2 day')) ?></option>
                </select>
            </div>
            <div class="fomr-group mt-3">
                <label for="jr">札幌方面→小樽のJR</label>
                <select name="jr" id="jr" required class="form-control">
                    <option value="">選択して下さい</option>
                    <optgroup label="１講に間に合う">
                        <option value="08:01着">08:01着</option>
                        <option value="08:22着">08:22着</option>
                        <option value="08:35着">08:35着</option>
                    </optgroup>
                    <optgroup label="２講に間に合う">
                        <option value="09:45着">09:45着（快速エアポート）</option>
                        <option value="10:01着">10:01着</option>
                        <option value="10:22着">10:22着（快速エアポート）</option>
                    </optgroup>
                    <optgroup label="３講に間に合う">
                        <option value="11:47着">11:47着（快速エアポート）</option>
                        <option value="12:12着">12:12着</option>
                        <option value="12:22着">12:22着（快速エアポート）</option>
                        <option value="12:41着">12:41着</option>
                    </optgroup>
                    <optgroup label="４講に間に合う">
                        <option value="13:46着">13:46着（快速エアポート）</option>
                        <option value="14:14着">14:14着</option>
                        <option value="14:21着">14:21着（快速エアポート）</option>
                    </optgroup>
                    <optgroup label="５講に間に合う">
                        <option value="15:45着">15:45着（快速エアポート）</option>
                        <option value="15:54着">15:54着</option>

                    </optgroup>
                    <optgroup label="６講に間に合う">
                        <option value="17:22着">17:22着（快速エアポート）</option>
                        <option value="17:31着">17:31着</option>
                    </optgroup>
                    <optgroup label="７講に間に合う">
                        <option value="18:47着">18:47着（快速エアポート）</option>
                        <option value="19:12着">19:12着</option>
                    </optgroup>
                </select>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-5">
                <div>
                    <a class="ml-3" href="<?php the_url('home'); ?>">戻る</a>
                </div>
                <div>
                    <input type="submit" value="募集開始" class="btn orange-btn shadow-sm mr-3">
                </div>
            </div>
        </form>
    </div>
<?php
}
?>