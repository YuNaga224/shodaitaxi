<?php 
namespace partials;

function carpool_list_item($carpool,$participate_url) {

?>
    <li class="topic row bg-white shadow-sm mb-3 carpool-card p-3">
        <div>
           <p><?php echo $carpool->selected_date; ?>/<?php echo $carpool->selected_jr; ?>のグループです</p>
        </div>
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-body p-0">
                    <h4 class="card-title d-flex justify-content-center h6"><?php echo $carpool->user_1 ?></h4>
                </div>
            </div>
        </div>
        <div class="col-12">
            <?php if ($carpool->user_2 === 'EHG23hNRVe') : ?>
                <div class="card bg-dark mb-2">
                    <div class="card-body p-0">
                        <h4 class="card-title d-flex justify-content-center h6">募集中</h4>
                    </div>
                </div>
        </div>
            <?php else : ?>
                <div class="card mb-2">
                    <div class="card-body p-0">
                        <h4 class="card-title d-flex justify-content-center h6"><?php echo $carpool->user_2 ?></h4>
                    </div>
                </div>
        </div>
            <?php endif; ?>    
            <div class="col-12">
            <?php if ($carpool->user_3 === 'EHG23hNRVe') : ?>
                <div class="card bg-dark mb-2">
                    <div class="card-body p-0">
                        <h4 class="card-title d-flex justify-content-center h6">募集中</h4>
                    </div>
                </div>
        </div>
            <?php else : ?>
                <div class="card mb-2">
                    <div class="card-body p-0">
                        <h4 class="card-title d-flex justify-content-center h6"><?php echo $carpool->user_3 ?></h4>
                    </div>
                </div>
        </div>
            <?php endif; ?> 
            <div class="col-12">
            <?php if ($carpool->user_4 === 'EHG23hNRVe') : ?>
                <div class="card bg-dark">
                    <div class="card-body p-0">
                        <h4 class="card-title d-flex justify-content-center h6">募集中</h4>
                    </div>
                </div>
        </div>
            <?php else : ?>
                <div class="card">
                    <div class="card-body p-0">
                        <h4 class="card-title d-flex justify-content-center h6"><?php echo $carpool->user_4 ?></h4>
                    </div>
                </div>
        </div>
            <?php endif; ?> 
        <div class="col-auto mx-auto mt-2">
            <div class="text-center row">
                <a href="<?php echo $participate_url ?>" class="participate-btn btn shadow-sm">参加する</a>
            </div>
        </div>
    </li>
<?php 
}
?>