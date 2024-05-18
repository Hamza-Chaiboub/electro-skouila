<?php

namespace Controllers;

use Dompdf\Dompdf;

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