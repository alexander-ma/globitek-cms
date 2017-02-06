<?php

  function h($string="") {
    return htmlspecialchars($string);
  }

  function u($string="") {
    return urlencode($string);
  }

  function raw_u($string="") {
    return rawurlencode($string);
  }

  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function display_errors($errors=array()) {
    $output = '';
    if (!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $error) {
        $output .= "<font color=\"red\"><li>{$error}</li></font>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    echo $output;
    return $output;
  }

  function sanitize_email($value="") {
    return filter_var($value, FILTER_SANITIZE_EMAIL);
  }

    function sanitize_string($value="") {
    return filter_var($value, FILTER_SANITIZE_STRING);
  }

?>
