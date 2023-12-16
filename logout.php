<?php
include "db-actions.php";

if (session_destroy()) {
    header("location: index.php");
}