
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('asset'))
{
  function asset($uri = '') {
      return base_url('assets/'.$uri); 
  }
}