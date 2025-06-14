<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

class Pdf
{
    public $mpdf;
    public function __construct()
    {
        $this->mpdf = new \Mpdf\Mpdf();
    }
}
