<?php
if ( !defined('SENDPRESS_VERSION') ) {
  header('HTTP/1.0 403 Forbidden');
  die;
}

class SendPress_Email_Cache {
  protected static $instance;
  protected static $data = array();

  protected function __construct() {}

  public static function getInstance() {
     if(!self::$instance) {
       self:$instance = new self();
     }

     return self::$instance;
  }

  public function get($key) {
     self::getInstance();

     return isset(self::$data[$key]) ? self::$data[$key] : null;
  }

  public function set($key, $value) {
     self::getInstance();
     self::$data[$key] = $value;
  }

  public function build_cache(){
    self::getInstance();
    $email_list = SendPress_Data::get_email_id_from_queue();
    foreach ($email_list as $email) {
      $html =  SendPress_Template::get_instance()->render_html( $email->emailID, false, false , false );
      self::set( $email->emailID , $html );
    }

  }
}