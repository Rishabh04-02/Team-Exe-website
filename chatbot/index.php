<?php


  if (!file_exists('config/global_config.php'))
  {
  # No config exists we will run install
    header('location: install/install_programo.php');
  }
  elseif (file_exists('patch.php')) require_once ('patch.php');
  else
  {
    $get_vars = filter_input_array(INPUT_GET);
    $qs = '';
    if (!empty($get_vars))
    {
      $qs = '?';
      foreach ($get_vars as $key => $value)
      {
        $qs .= "$key=$value&";
      }
      $qs = rtrim($qs, '&');
    }
    # Config exists we will goto the bot
    $thisFile = __FILE__;
    require_once('config/global_config.php');
    /** @noinspection PhpUndefinedVariableInspection */
    $format = (isset($get_vars['format'])) ? $get_vars['format'] : $format;
    $format = strtoupper($format);
    switch ($format)
    {
      case 'JSON':
      $gui = 'jquery';
      break;
      case 'XML':
      $gui= 'xml';
      break;
      default:
      $gui = 'plain';
    }
    if (!defined('SCRIPT_INSTALLED')) header('location: ' . _INSTALL_URL_ . 'install_programo.php');
    else header("location: gui/$gui/$qs");
  }

?>
