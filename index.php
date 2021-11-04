<?php
require 'config.php';

$pageTitle = "Notetap";
$pageAssets;
$footerAssets;

include 'inc/head.php';

// Body

?>

<section class="add_tap">
    <div class="add_tap_container content_width">

        <form autocomplete="off" method="post" action="process_newtap.php" class="add_tap_form" id="notetap_form">
            <input type="text" name="title" id="add_title" placeholder="Take a note" required>
            <div id="add_tap_toggle">
                <textarea name="content" id="add_content" placeholder="Notetap Content" required></textarea>
                <div class="add_tap_footer">
                    <a role="button" class="primary_btn icon_btn" id="notetap_form_submit">
                        <div class="icon_btn_container">
                            <span>Publish Tap</span>
                            <span class="material-icons">add</span>
                        </div>
                    </a>
                </div>
            </div>
        </form>

        <div class="process_tap_noti">
            <?php
            ProcessNewTapResults::getResults();
            ?>
        </div>

    </div>
</section>

<section class="taps">
    <div class="taps_container content_width">
        <?php

        $taps = $db->Select("SELECT id, title, content, date FROM tabs ORDER BY date DESC");

        foreach ($taps as $tap) {
            echo '<article class="tap">';
            echo '<div class="tap_head">';
            echo '<h2 class="tap_title">' . $tap['title'] . '</h2>';
            echo '</div>';
            echo '<div class="tap_mid">';

            $contentExceprt = new Excerpt();
            $excerpt = $contentExceprt->doExcerpt($tap['content'], 425, '...');

            echo '<p class="tap_content">' . $excerpt . '</p>';
            echo '<p class="tap_content_full">' . $tap['content'] . '</p>';
            echo '</div>';
            echo '<div class="tap_footer">';
            echo '<span class="tap_timestamp">';
            echo '<p>' . date('n/j/Y g:i A', strtotime($tap['date'])) . '</p>';
            echo '</span>';
            echo '</div>';
            echo '<span class="tap_id" hidden>' . $tap['id'] . '</span>';
            echo '</article>';
        }

        ?>

    </div>
</section>

<section class="tap_popup" id="tap_open">
    <div class="tap_content content_width">
        <div class="tap_popup_handles">
            <div class="tap_popup_handle">
                <span class="material-icons">delete</span>
            </div>
            <div class="tap_popup_handle">
                <span class="material-icons">edit</span>
            </div>
            <div class="tap_popup_handle">
                <span class="material-icons">close</span>
            </div>
        </div>

        <div class="tap" id="tap_popup_tap">
            <div class="tap_head">
                <h2 class="tap_title" id="tap_popup_title"></h2>
            </div>
            <div class="tap_mid">
                <div id="tap_content_scroll"></div>
                <p class="tap_content" id="tap_popup_content"></p>
            </div>
            <div class="tap_footer">
                <span class="tap_timestamp">
                    <p id="tap_popup_timestamp"></p>
                </span>
            </div>
            <span id="tap_popup_id" hidden></span>
        </div>

        <form autocomplete="off" class="edit_tap_form" id="edit_notetap_form">
            <input type="text" name="title" id="edit_title" value="" required>
            <input type="hidden" id="edit_id">
                <textarea name="content" id="edit_content" value="" required></textarea>
                <div class="edit_tap_footer">
                    <a role="button" class="primary_btn icon_btn" id="edit_notetap_form_submit">
                        <div class="icon_btn_container">
                            <span>Done editing</span>
                            <span class="material-icons">published_with_changes</span>
                        </div>
                    </a>
                </div>
        </form>

        <div class="process_tap_noti" id="edit_tap_noti">
            
        </div>

    </div>
</section>

<?php
    DeleteTapResults::getResults();
?>

<script src="/assets/js/taps_trigger.js"></script>
<script src="/assets/js/add_tap_form.js"></script>
<script src="/assets/js/remove_tap.js"></script>
<script src="/assets/js/edit_tap.js"></script>

<?php

include 'inc/footer.php';
?>