<?php
if (is_active_sidebar('footer-widget')) {
    ?>
    <div class="black-bg">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar('footer-widget'); ?>
            </div>
        </div>
    </div>
    <?php
}
