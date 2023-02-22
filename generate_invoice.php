<?php

ob_end_clean();

// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 


function generate_invoice($data){

// Instantiate and use the dompdf class 
$dompdf = new Dompdf();


// Load HTML content 

$html = '

<img src="data:image/png;base64,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" width="164px;">
<br>
<br>
<table style="width:100%;">
<tr>
    <td>
        <strong>'.$data["First Name"].' '.$data["Last Name"].'</strong><br>
        <strong>'.$data["Address Line 1"].' '.$data["Address Line 2"].'</strong>
    </td>
    <td style="text-align:right;">
        <strong>Date:</strong> 22/02/2023
    </td>
</tr>
</table>

<table style="width:100%;">
<tr>
    <td>
        <p>Dear <strong>'.$data["First Name"].' '.$data["Last Name"].'</strong>,</p>
        <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p style="text-align: justify;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione.</p>
        <p>Sincerely,</p>
        <p>John Doe</p>
        <p style="margin-top:-10px;">CEO, XYZ Corporation.</p>
    </td>
</tr>
</table>

<br>
<div style="width:100%;border-bottom:1px dashed #000;"></div>
<br>

<table style="width: 100%;">
    <tr>
        <td style="width:40%;">
            <img src="data:image/png;base64,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" width="100px;">
            <p style="font-size: 11px;">711-2880 Nulla St.</p>
            <p style="font-size: 11px; margin-top:-10px;">Mankato Mississippi 96522</p>
            <p style="font-size: 11px; margin-top:-10px;">info@xyz.com</p>
        </td>
        <td style="text-align:center;">
            <p style="font-size: 11px;"><strong>OFFICIAL DONATION RECEIPT FOR INCOME TAX PURPOSES</strong></p>
            <p style="font-size: 11px;">Charity Reg. No. 123456789987456 | Revenue Agency | www.xyz.com/charities</p>
        </td>
    </tr>
</table>


    <table style="width:100%;">
        <tr>
            <td style="width: 60%;">
                <p>Received with thanks from:</p>
                <p><strong>'.$data["First Name"].' '.$data["Last Name"].'</strong></p>
                <p><strong>'.$data["Address Line 1"].' '.$data["Address Line 2"].'</strong></p>
            </td>
            <td>
                <p>Receipt No.: '.$data["Reference"].'</p>
                <p>Tax Year: <strong>20xx</strong></p>
                <p>Amount Donated: <strong>'.$data["Payment Amount"].'</strong></p>
                <p>Eligible Amount of Gift: <strong>$00</strong></p>
                <p>Receipt Date: <strong>'.$data["Payment Date"].'</strong></p>
                <p>Issued Location: <strong>'.$data["Locality"].'</strong></p>
                <p>Authorized by: <strong>(Signature)</strong></p>
            </td>
        </tr>
    </table>

    <br><br>

    <table style="width:100%;">
        <tr>
            <td style="text-align:left;font-size:12px;">
                711-2880 Nulla St. Mankato Mississippi 96522
            </td>
            <td style="text-align:right;left;font-size:12px;">
                <a style="font-size:12px;text-decoration:none;" href="http://www.xyz.com">www.xyz.com</a>
            </td>
        </tr>
    </table>

';


$dompdf->loadHtml($html); 
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF to Browser 
$output = $dompdf->output();

// setting the file name dynamically
$filename = $data['Reference'].'.pdf';

// saving the invoice PDF file to local directory
file_put_contents('invoice/'.$filename, $output);

}

?>