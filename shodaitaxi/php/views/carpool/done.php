<?php 
namespace view\carpool\done;

function index()
{
?>
<div class="container">
    <div class="row d-flex justify-content-center bg-white rounded py-3 align-items-center">
        <h1 class="h3 col-12 mb-2 d-flex justify-content-center">ご利用ありがとうございました</h1>
        <h2 class="h4 col-12 mb-2 d-flex justify-content-center">安全に学校まで向かってください！</h2>
        <h3 class="h5 col-12 mb-5 d-flex justify-content-center">またのご利用をお待ちしております</h2>
        <a href="<?php the_url('home')?>" class="btn btn-primary col-6 mb-2">ホームへ</a>

    </div>

</div>
<?php 
}

?>