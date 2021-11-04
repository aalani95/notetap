<?php

class ProcessNewTapResults
{
    public static function getResults()
    {
        if (isset($_GET['results'])) {
            $results = $_GET['results'];
            if ($results == 'published') {
                echo '<span class="process_tap_success">Tap Published 👋</span>';
            }
            if ($results == 'failed') {
                echo '<span class="process_tap_error">☝️ Make sure title and content fields are not empty</span>';
            }
        }
    }
}
