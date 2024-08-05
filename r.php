

<?php

// Example usage








// Sample text
$extractedText = ""; // truncated for brevity

// Function to extract specific values
function extractValue($text, $key) {
    // Create a regex pattern to match the key and capture the value
    $pattern = "/$key\s*:\s*([^\|]+)/";
    
     //$pattern = "/$key\s*[:|]\s*(" . str_repeat('\S+\s*', $numWords) . ")/";
    if (preg_match($pattern, $text, $matches)) {
        return trim($matches[1]);
    }
    return null;
}


 function extractTextAfterKeyword($text, $keyword, $endDelimiter) {
    $pattern = "/$keyword\s*(.*?)$endDelimiter/";
    preg_match_all($pattern, $text, $matches);
    return $matches[1];
}

// Extract text after 'Seller Details' and before '|'
$extractedValues = extractTextAfterKeyword($extractedText, 'Seller Details', '');







//table se value 

function parseKeyValuePairs($text) {
    $lines = explode("\n", $text);
    $data = [];

    foreach ($lines as $line) {
        // Assume columns are separated by whitespace
        $columns = preg_split('/\s{2,}/', trim($line));

        // Ensure we have exactly two columns
        if (count($columns) === 2) {
            $key = trim($columns[0]);
            $value = trim($columns[1]);
            $data[$key] = $value;
        }
    }

    return $data;
}





 
?>










<?php
function extractTextFromPDF($filePath) {
    // Specify the location of the pdftotext utility
    $pdftotextPath = 'xpdf-tools-linux-4.05/bin64/pdftotext'; // Change this path if necessary

    // Specify the output file
    $outputFile = tempnam(sys_get_temp_dir(), 'pdftotext') . '.txt';

    // Execute the pdftotext command with the -layout option to preserve the layout
    $command = escapeshellcmd("$pdftotextPath -layout $filePath $outputFile");
    shell_exec($command);

    // Read the contents of the output file
    $text = file_get_contents($outputFile);

    // Delete the temporary output file
    //unlink($outputFile);

    return $text;
}

function convertTextToHTML($text, $outputPath) {
    // Convert text to HTML
    $htmlContent = "<html>\n<head>\n<title>Converted PDF to HTML</title>\n</head>\n<body>\n";
    $htmlContent .= nl2br(htmlspecialchars($text));
    $htmlContent .= "\n</body>\n</html>";

    // Save the HTML content to a file
    file_put_contents($outputPath, $htmlContent);
}

if (isset($_GET['file'])) {
    $filePath = 'uploads/' . basename($_GET['file']);

    if (file_exists($filePath)) {
        // Extract text from the PDF file
      $extractedText = extractTextFromPDF($filePath) ; 

$contractNo = extractValue($extractedText, 'Contract No');
$generatedDate = extractValue($extractedText, 'Generated Date');
$buyerdetailstype = extractValue($extractedText, 'Type');
$Designation = extractValue($extractedText, 'Designation');
$buyeremail = extractValue($extractedText, 'Email ID');
$buyeremail2 = extractValue($extractedText, 'GSTIN',2);
$buyergstin = extractValue($extractedText, 'GSTIN');
$Department = extractValue($extractedText, 'Department'); 
$Address = extractValue($extractedText, 'Address');
$OrganisationName = extractValue($extractedText, 'Organisation Name ');
$OfficeZone = extractValue($extractedText, 'Office Zone');
$IFDConcurrence = extractValue($extractedText, 'IFD Concurrence');
$Role = extractValue($extractedText, 'Role');
$DesignationofAdministrativeApproval = extractValue($extractedText, ' Designation of Financial Approval');
$sellerid = extractValue($extractedText, ' Seller Details');
$Ministry = extractValue($extractedText, 'Ministry');
$OrganisationName = extractValue($extractedText, 'Organisation Name');
$Contact = extractValue($extractedText, 'Contact');
$CompanyNamemail = extractValue($extractedText, 'Company Name');
$PaymentMode= extractValue($extractedText, 'Payment Mode');
$paydegination= extractValue($extractedText, 'ail ID');

$Contacteraddress = extractValue($extractedText, 'GeM Seller ID');
$sellergst = extractValue($extractedText, 'MSME Registration number');
$ID= extractValue($extractedText, 'ID');
$ProductName = extractValue($extractedText, 'Product Name');
$Brand = extractValue($extractedText, 'Brand');


$CatalogueStatus = extractValue($extractedText, 'Catalogue Status');
$SellingAs= extractValue($extractedText, 'Selling As');
$CategoryNameQuadrant  = extractValue($extractedText, 'Category Name & Quadrant');
$Model = extractValue($extractedText, 'Model');
$BrandType = extractValue($extractedText, 'Brand Type');
$HSNCode = extractValue($extractedText, 'HSN Code');


// email second extract
function getEmailsAndStore($text) {
    // Extract all email IDs from the text
    $emailIDs = extractEmailIDs($text);

    // Initialize the data array
    $datax = array();

    // Store all extracted email IDs in the data array
    $datax['all_emails'] = $emailIDs;

    // Store the second email ID in the data array, if it exists
    $datax['second_email'] = isset($emailIDs[1]) ? $emailIDs[1] : "Second email ID not found.";
 $datax['third_email']=  isset($emailIDs[1]) ? $emailIDs[1] : "Second email ID not found.";
    return $datax;
}

// Example usage
//$filePath = 'path/to/your/file.pdf';
$extractedText = extractTextFromPDF($filePath);
$datal = getEmailsAndStore($extractedText);

// Output or further process the $data array

$datal['all_emails'];
$datal['second_email'];
$datal['third_email'];
// email second extract closed 

// extract seller details 
function extractTextByKeyword($text, $keyword) {
    // Find the position of the keyword in the text
    $startPos = strpos($text, $keyword);
    
    if ($startPos === false) {
        return ''; // Keyword not found
    }
    
    // Move the start position to the end of the keyword
    $startPos += strlen($keyword);
    
    // Find the position of the delimiter '|'
    $endPos = strpos($text, '|', $startPos);
    
    if ($endPos === false) {
        return trim(substr($text, $startPos)); // No delimiter found, return text till end
    }
    
    // Extract the text from start position to delimiter
    return trim(substr($text, $startPos, $endPos - $startPos));
}

// Example usage
$extractedText = extractTextFromPDF($filePath); // Extract the entire text from the PDF
$sellerDetails = extractTextByKeyword($extractedText, 'Seller Details');
$QTY = extractTextByKeyword($extractedText, 'Registered Brand');
$ProductSpecification = extractTextByKeyword($extractedText, 'Product Specification');

$BidRAPBPNo = extractTextByKeyword($extractedText, 'Bid/RA/PBP No.:');


// Seller deatails Closed




// Sample data structure with fixed keys and different values
$data = [
            'contract_number' => $contractNo,
            'generated_date' => $generatedDate,
            'Bid_Number_Against_Contract' => $BidRAPBPNo,
            'type' => $buyerdetailstype,
            'organisation_details' => [
                'type' => $buyerdetailstype,
                'ministry' => $Ministry,
                'department' =>$Department,
                'organisation_name' => $OrganisationName,
                'office_zone' => $OfficeZone,
                'address' => $Address
            ],
            'buyer_details' => [
                'designation' => $Designation,
                'contact_no' => $Contact,
                'email_id' => $buyeremail,
                'gstin' => $buyergstin
            ],
            'financial_approval_details' => [
                'ifd_concurrence' => $IFDConcurrence,
            ],
            'paying_authority_details' => [
                'ceo' => $Role,
                'payment_mode' => $PaymentMode,
                'paydesignation' => $paydegination,
                'email_id' => $secondEmailID,
                'gstin' => '-',
                'address' => ''
            ],
            'seller_deal' => [
                'company_seller_id_name' => $sellerid,
                'contact_no' => $Contacteraddress,
                'email_id' => $CompanyNamemail,
                'address' => '',
                'udyam' => '',
                'msme_registration_number' => $ID,
                'mse_social_category' => '',
                'mse_gender' => '',
                'gstin' => $sellergst
            ],
            'product_details' => [
                [
                    'product_name' => $ProductName,
                    'quantity' => '',
                    'unit_price' => '',
                    'total_price' => '',
                    'brand' => $Brand,
                    'brand_type' => $BrandType,
                    'catalogue_status' =>$CatalogueStatus,
                    'selling_as' => $SellingAs,
                    'category_name_quadrant' => $CategoryNameQuadrant ,
                    'model' => $Model,
                    'hsn_code' => $HSNCode
                ]
            ],
            'consignee_details' => [
                [
                    'designation' => '',
                    'email_id' => isset($emails[2]) ? $emails[2] : "Third email ID not found.",
                    'contact' => '-',
                    'gstin' => $buyergstin,
                    'address' => '',
                    'item' => $ProductName,
                    'quantity' => '',
                    'delivery_start' => $generatedDate,
                    'delivery_completed_by' => 'Minimum within 10 days'
                ]
            ],
            'product_specifications' => [
                'specification' => $ProductSpecification
            ]
        ];






// Function to generate dynamic form HTML
function generateForm($data, $prefix = '') {
    $html = '';
    foreach ($data as $key => $value) {
        $name = $prefix ? "{$prefix}[{$key}]" : $key;
        if (is_array($value)) {
            $html .= '<fieldset>';
            $html .= '<legend>' . htmlspecialchars($key) . '</legend>';
            $html .= generateForm($value, $name);
            $html .= '</fieldset>';
        } else {
            $html .= '<label class="labelf" style="Color:red; font-size:28px; width:100%" for="' . htmlspecialchars($name) . '">' . htmlspecialchars($key) . ':</label>';
            $html .= '<input style="Color:green; font-size:28px; width:100%" type="text" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '"><br>';
        }
    }
    return $html;
}

// Generate the form HTML
$formHTML = '<form method="post" action="extprocess_form.php" class="form">';
$formHTML .= generateForm($data);
$formHTML .= '<input type="submit" value="Submit" class"submit">';
$formHTML .= '</form>';

// Display the form
echo $formHTML;
// here form closed 


// Display the form
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Extracted PDF Data</title>
            <style>
                .labelf {
                    font-weight: bold;
                    margin-bottom: 5px;
                }
                .inputf {
                    margin-bottom: 15px;
                    padding: 10px;
                    font-size: 16px;
                    width: 50%;
                }
                fieldset {
                    margin-bottom: 20px;
                    padding: 10px;
                    border: 1px solid #ccc;
                }
                legend {
                    font-weight: bold;
                    color: #333;
                }
                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                    text-align: center;
                    text-decoration: none;
                    outline: none;
                    color: #fff;
                    background-color: #4CAF50;
                    border: none;
                    border-radius: 15px;
                    box-shadow: 0 9px #999;
                }
                .btn:hover {background-color: #3e8e41}
                .btn:active {
                    background-color: #3e8e41;
                    box-shadow: 0 5px #666;
                    transform: translateY(4px);
                }
            </style>
        </head>
        <body>
            <h1 style="text-align:center;">Extracted PDF Data</h1>
            <form action="save_data.php" method="post">' . $formHtml . '
                <input class="btn" type="submit" value="Save Data">
            </form>
        </body>
        </html>';
   





        // Save the extracted text to a new .txt file
        $textFileName = 'uploads/' . pathinfo($filePath, PATHINFO_FILENAME) . '.txt';
        file_put_contents($textFileName, $extractedText);

        // Convert the .txt file to HTML
        $htmlFileName = 'uploads/' . pathinfo($filePath, PATHINFO_FILENAME) . '.html';
        convertTextToHTML($extractedText, $htmlFileName);

        // Display the link to the HTML file
        echo "HTML file created: <a href='" . htmlspecialchars($htmlFileName) . "'>" . htmlspecialchars($htmlFileName) . "</a><br>";
        echo nl2br(htmlspecialchars($extractedText));
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}





?>

<?php
function extractEmailIDs($text) {
    // Define a regular expression to find all email addresses
    preg_match_all('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $matches);

    // Return the list of email addresses found
    return $matches[0];
}
?>


<?php
function getNthEmailID($text, $n) {
    // Extract all email IDs from the text
    $emailIDs = extractEmailIDs($text);

    // Check if there are enough email IDs
    if (isset($emailIDs[$n - 1])) {
        // Return the Nth email ID (index starts at 0, so $n-1)
        return $emailIDs[$n - 1];
    } else {
        // Handle the case where the Nth email ID is not found
        return "Email ID not found.";
    }
}

// Example usage
//$filePath = 'path/to/your/file.pdf';
$extractedText = extractTextFromPDF($filePath);
$secondEmailID = getNthEmailID($extractedText, 2);
echo "Second Email ID: " . $secondEmailID;





