<?php

class DeleteTapResults
{
    public static function getResults()
    {
        if (isset($_GET['delete'])) {
            $results = $_GET['delete'];

            echo '<div class="tap_deleted_noti">';
            if ($results == 'deleted') {
                echo '<span class="delete_tap_success"><span class="material-icons">done</span>Tap deleted</span>';
            }
            if ($results == 'failed') {
                echo '<span class="delete_tap_error"><span class="material-icons">warning_amber</span>An error occurred, please try again!</span>';
            }
            echo '</div>';
        }
    }
}