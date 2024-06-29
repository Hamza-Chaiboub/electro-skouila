<?php

namespace Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceController
{
    public static function index(): void
    {
        $cart = $_SESSION['cart'];
        view('invoice/index.view', ['cart' => $cart]);
        dd($cart);
    }

    public static function print()
    {
        $cart = $_SESSION['cart'];
        // instantiate and use the dompdf class
        $options = new Options();
        $options->set('chroot', realpath(''));
        //dd($options);
        $dompdf = new Dompdf();
        ob_start();
        require root_path('Components/invoice_printable.php');
        $html = ob_get_clean();
        $dompdf->loadHtml($html);

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream('invoice', array("Attachment" => false));
    }
}