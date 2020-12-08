<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');
// Extend the TCPDF class to create custom Header and Footer
class PDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $this->SetY(10);
        // $image_file = base_url() . 'assets/img/logo/logos.jpg';
        // $this->Image($image_file, 'C', 6, '', '', 'JPG', false, 'C', false, 300, 'C', false, false, 0, false, false, false);

        // Title
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(0, 15, 'Wahyu Arta Digital', 0, 0, 'C', 0, '', 0, false, 'M', '');
        $this->ln();
        // Sub Title
        $this->SetY(17);
        $this->SetFont('helvetica', 'I', 12);
        $this->Cell(0, 15, 'Kramat Jati', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
