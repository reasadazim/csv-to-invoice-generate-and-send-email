# Read a CSV file, Generate PDF invoice, Send email to users or customers

 - [x] Reads data from a CSV file stored in ```data``` directory.
 - [x] Create PDF invoice.
 - [x] Send it to customer/user email.

## Requirements
 -   PHP version 7.1 or higher
 -  DOM extension
-   MBString extension
-   php-font-lib
-   php-svg-lib

## Instruction

 - Clone the repo.
 - Change the ```$key``` array of ```index.php``` file of the root directory as per your CSV file's column headers.  For reference, please check the CSV file in ```data``` directory.
	```
	$key  =  array(
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
	```
 - One of the column of your CSV file should contain email address of the user/customer to whom you want to send email.
 - Edit the HTML code of  ```generate_invoice.php``` file as per your invoice design.
 - For logo/image, convert the image to base64 and put the code inside ```src=""``` attribute.
 - Run the ```index.php``` file of the root directory. 
 -  You will see the log of email sending on screen with success/failure information.
 - PDF invoices will be stored in the invoice directory.
 ## Screenshots
 ![PDF Invoice](https://reasadazim.com/wp-content/uploads/2023/03/Screenshot-2023-03-16-023128.png)
![Email log](https://reasadazim.com/wp-content/uploads/2023/03/Screenshot-2023-03-16-023333-1.png)
