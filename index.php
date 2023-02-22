<?php

// Following code reads a CSV file
// Then Generate Invoice using DOMPDF converter
// Then email that invoice to the user/customer


require_once 'generate_invoice.php'; // generates invoice

require_once 'send_email.php'; // sends email

// Function to read a CSV file and output data as JSON
function csvToJson($fname) {
    // open csv file
    if (!($fp = fopen($fname, 'r'))) {
        die("Can't open file...");
    }
    
    //read csv headers
    $key = array(
        'Reference', 
        'Organization Name', 
        'First Name', 
        'Last Name', 
        'Email Address', 
        'Payment Status', 
        'Payment Date',
        'Payment Amount',
        'Payment Method',
        'Email Pref',
        'Address Line 1',
        'Address Line 2',
        'Administrative Area',
        'Locality',
        'Postal Code',
        'Address Country'
    );
    
    // parse csv rows into array
    $json = array();
        while ($row = fgetcsv($fp,"1024",",")) {
        $json[] = array_combine($key, $row);
    }
    
    // release file handle
    fclose($fp);
    
    // encode array to json
    return $json;
}

// path to CSV file
$local_csv_file_name = "./data/data.csv";


if(file_exists($local_csv_file_name)){ //check if the file exists in the directory to avoid error

    $data = csvToJson($local_csv_file_name);

    foreach($data as $datum){
        
        if ($datum['Reference']=="Reference"){
            //escaping the first row of the CSV since that is the header titles
        }else{

            generate_invoice($datum); // invoke invoice generate function
    
            $filepath = "../invoice/".$datum['Reference'].".pdf"; // generated invoice path

            send_email($datum, $filepath); // invoke sending email function

            sleep(1); // delay
        }

    }

}


// header('Content-Type: application/json; charset=utf-8');

// echo(json_encode($data));

?>