<div id="data-container" class="data-container">
    <?php
    require_once view('components/filters.php');
    ?>

    <?php
    require_once view('components/table.php');
    ?>
</div>
<?php
require_once view('components/context_menu.php');
    ?>
<div id="alert-request" class="alert-request">
    <?php
        if (isset($icon_view)) {
            echo '<img id="icon-view" src="'.icon($icon_view).'" alt="">';
        }
    ?>
    <span id="text-alert"></span>
    <img src="<?php echo icon('policies_data/data_right/x.svg'); ?>" alt="">
</div>
