<h1>ReviewEmbed settings</h1>

<div class="re-content">
    <?php if ($authorized) { ?>
    <div class="re-account">
        <div class="re-account-header">
            <h2 class="pull-left">
                Your account
            </h2>

            <a href="#" class="pull-right" onclick="openChildWin(); return false;">
                <i class="ion-loop"></i> <span>Sync now</span>
            </a>
        </div>
        <div class="clearfix"></div>

        <?php if ($account['trial']) { ?>
        <div>
            <div class="re-account-status pull-left">
                <strong>Current plan:</strong> Trial<br>
                <strong>Days left:</strong> <?php echo date_diff(new DateTime(), new DateTime($account['trial_finish']['date']))->days < 7 ? $account['trial_left'] : 'Trial finished!'; ?>
            </div>
            <div class="pull-right">
                <a class="re-btn re-btn--orange re-btn--xs" href="https://www.reviewembed.com/account/plan/lifetime" target="_blank">
                    <i class="ion-heart"></i> <span>Upgrade to Pro</span>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php } ?>

        <div class="re-stats">
            <div class="re-stat"><strong>Brands:</strong> <?php echo $account['brands'] ?: 0; ?></div>
            <div class="re-stat"><strong>Reviews:</strong> <?php echo $account['reviews'] ?: 0; ?></div>
            <div class="re-stat"><strong>Rating:</strong> <?php echo $account['rating'] ?: 0; ?></div>
        </div>
    </div>

    <div class="re-controls pull-left">
        <a class="re-btn re-btn--orange re-btn--xs" href="<?php echo $host; ?>/widgets/?hash=1&action=new" target="_blank">
            <i class="ion-plus"></i> <span>Add widget</span>
        </a>

        <?php if ($status) { ?>
            <span class="re-status">Widget list updated.</span>
        <?php } ?>
    </div>

    <div class="re-controls pull-right">
        <a class="re-btn re-btn--white re-btn--xs" href="<?php echo $host; ?>/brands" target="_blank">
            <i class="ion-briefcase"></i> <span>Manage brands</span>
        </a>

        <a class="re-btn re-btn--white re-btn--xs" href="<?php echo $host; ?>/reviews" target="_blank">
            <i class="ion-chatboxes"></i> <span>Manage reviews</span>
        </a>

        <a class="re-btn re-btn--white re-btn--xs m-0" href="<?php echo $host; ?>/account" target="_blank">
            <i class="ion-person"></i> <span>Account settings</span>
        </a>
    </div>
    <?php } else { ?>
    <div class="re-controls pull-left">
        <a href="#" class="re-btn re-btn--orange re-btn--xs" onclick="openChildWin(); return false;">
            <i class="ion-android-exit"></i> <span>Login</span>
        </a>

        <a href="#" class="re-btn re-btn--orange re-btn--xs" onclick="openChildWin(); return false;">
            <i class="ion-android-person-add"></i> <span>Signup</span>
        </a>
    </div>
    <?php } ?>

    <div class="re-widgets">
        <?php foreach ($widgets as $widget) { ?>
            <div class="re-widget">
                <h2 class="re-widget-title">
                    <a href="http://www.reviewembed.com/widgets" target="_blank"><?php echo $widget['name'] ?></a>
                </h2>
                <div class="widget-icons">
                    <?php if ($widget['style'] != 'landing') { ?>
                        <button type="button" data-widget="<?php echo $widget['id']; ?>" class="widget-icon widget-icon-embed" data-clipboard-text="[reviewembed hash='<?php echo $widget['hash']; ?>']">
                            <h6>Get shortcode</h6><i class="ion-code"></i>
                        </button>

                        <a href="<?php echo $host; ?>/preview/<?php echo $widget['hash']; ?>" target="_blank" class="widget-icon widget-icon-preview"><h6>Preview</h6><i class="ion-ios-eye-outline"></i></a>

                        <a href="<?php echo $host; ?>/widgets/?hash=<?php echo $widget['hash']; ?>&action=edit" target="_blank">
                            <button type="submit" class="widget-icon widget-icon-edit panel-widget-edit-trigger"><h6>Edit</h6><i class="ion-ios-compose-outline"></i></button>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo $host; ?>/l/<?php echo $widget['brand_name']; ?>" target="_blank" class="widget-icon widget-icon-preview"><h6>Preview</h6><i class="ion-ios-eye-outline"></i></a>
                    <?php } ?>

                    <a href="<?php echo $host; ?>/widgets/?hash=<?php echo $widget['hash']; ?>&action=styles" target="_blank">
                        <button type="submit" data-widget="8186" class="widget-icon widget-icon-styles"><h6>Styles</h6><i class="ion-ios-camera-outline"></i></button>
                    </a>

                    <?php if ($widget['style'] != 'landing') { ?>
                        <a href="<?php echo $host; ?>/widgets/?hash=<?php echo $widget['hash']; ?>&action=delete" target="_blank">
                            <button type="button" class="widget-icon widget-icon-delete"><h6>Delete</h6><i class="ion-ios-trash-outline"></i></button>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php if (empty($widgets)) { ?>
            <div class="re-widget">
                <p>Nothing found. Try to sync your widgets with ReviewEmbed by clicking on a link above.</p>
            </div>
        <?php } ?>
    </div>

    <form id="re-widgets-form" action="" method="post">
        <input type="hidden" name="request" id="re-widgets-raw">
    </form>
</div>

<script>
    init(location, '<?php echo $host; ?>');
</script>

<?php
    if ($status) {
        wp_add_inline_script('select', "setTimeout(function() {
            var elements = document.getElementsByClassName('re-status');
            for (var i = 0; i < elements.length; i++) {
                elements[i].className += ' re-status--hidden';
            }
    }, 3000);");
    }
?>