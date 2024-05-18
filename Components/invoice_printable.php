<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
<div class="container">
    <div class="invoice-container" ref="document" id="html">
        <table style="width:100%; height:auto;  text-align:center; " BORDER=0 CELLSPACING=0>
            <thead style="background:#fafafa; padding:8px;">
            <tr style="font-size: 20px;">
                <td colspan="4" style="padding:20px 20px;text-align: left;">L E Z A D A</td>
            </tr>
            </thead>
            <tbody style="background:#ffff;padding:20px;">
            <tr>
                <td colspan="4" style="padding:20px 0 0 20px;text-align:left;font-size: 16px; font-weight: bold;color:#000;">Hello, Rita</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:left;padding:10px 10px 10px 20px;font-size:14px;">Your order details</td>
            </tr>
            </tbody>
        </table>
        <table style="width:100%; height:auto; background-color:#fff;text-align:center; padding:10px; background:#fafafa">
            <tbody>
            <tr style="color:#6c757d; font-size: 20px;">
                <td style="border-right:1.5px dashed  #DCDCDC; width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Order Date</td>
                <td style="border-right: 1.5px dashed  #DCDCDC ;width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Order No.</td>
                <td style="border-right:1.5px dashed  #DCDCDC ;width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Payment</td>
                <td style="width:25%;font-size:12px;font-weight:700;padding: 0px 0px 10px 0px;">Shipping Address</td>
            </tr>
            <tr style="background-color:#fff; font-size:12px; color:#262626;">
                <td style="border-right:1.5px dashed  #DCDCDC ;width:25%; font-weight:bold;background: #fafafa;">11.07.2021</td>
                <td style="border-right:1.5px dashed  #DCDCDC ;width:25% ; font-weight:bold;background: #fafafa;">000000001</td>
                <td style="border-right:1.5px dashed  #DCDCDC ;width:25%; font-weight:bold;background: #fafafa;">CASH</td>
                <td style="width:25%; font-weight:bold;background: #fafafa;">Kosovo, Prishtina</td>
            </tr>
            </tbody>
        </table>
        <table style="width:100%; height:auto; background-color:#fff; margin-top:0;  padding:20px; font-size:12px; border: 1px solid #ebebeb; border-top:0px;">
            <thead>
            <tr style=" color: #6c757d;font-weight: bold; padding: 5px;">
                <td style="text-align: left;">PRODUCT INFORMATION</td>
                <td style="text-align: center;">SIZE</td>
                <td style="padding: 10px;text-align:center;">QUANTITY</td>
                <td style="text-align: right;padding: 10px;">PRICE</td>
                <td style="text-align: right;padding: 10px;">TOTAL</td>
            </tr>
            </thead>
            <tbody>
            <?php /** @var $cart */
            foreach ($cart['products'] as $product): ?>
                <tr>

                    <td style="width:30%;margin-left:10px;text-align: left;"><?= $product['data']->name ?></td>
                    <td style="width:20%;padding: 10px; text-align:center;"> S</td>
                    <td style="width:10%;padding: 10px;text-align: center;"><?= $product['quantity'] ?></td>
                    <td style="width:20%; ;">
                        <table style="width:100%;">
                            <tr><td style="text-align:right;font-size:13px;">&dollar;<?= number_format($product['data']->price, 2) ?></td></tr>
                        </table>
                    </td>
                    <td style="width:20%;padding: 10px; text-align:right;font-weight: bold;font-size: 14px;">&dollar;<?= number_format($product['data']->price * $product['quantity'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <table style="width:100%; height:auto; background-color:#fff;padding:20px; font-size:12px; border: 1px solid #ebebeb; border-top:0">
            <tbody>
            <tr style="padding:20px;color:#000;font-size:15px">
                <td style="font-weight: bold;padding:5px 0px">Total</td>
                <td style="text-align:right;padding:5px 0px;font-weight: bold;font-size:16px;">&dollar;<?= number_format($cart['total'], 2) ?></td>
            </tr>

            <tr>
                <td colspan="2" style="font-weight:bold;"><span style="color:#c61932;font-weight: bold;">THANK YOU</span> for shipping with us!</td>
            </tr>
            <tr>
                <td colspan="2" style="font-weight:bold;text-align:left;padding:5px 0px 0px 00px;font-size:14px;">THRED<span>+</span> team</td>
            </tr>
            </tbody>
            <tfoot style="padding-top:20px;font-weight: bold;">
            <tr>
                <td style="padding-top:20px;">Need help? Contact us <span style="color:#c61932"> info@thred-plus.shop </span></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>
