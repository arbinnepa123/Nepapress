<?php
/*
    Template Name: Nepa Coa
*/

get_header(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link href="http://cdn.syncfusion.com/21.1.35/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" />
      <!--Scripts-->
      <script src="http://cdn.syncfusion.com/js/assets/external/jquery-1.10.2.min.js"> </script>
      <script src="http://cdn.syncfusion.com/21.1.35/js/web/ej.web.all.min.js"></script>
      <link rel="stylesheet" type="text/css" href="pikaday.css">
  <script src="pikaday.js"></script>
  <script src="<?php echo get_template_directory_uri();?>/html2pdf.js"></script>
    <?php wp_head(); ?>
</head>
<body>

<?php
$my_date = get_field('date');

$nepaData = get_field('nepa_coa',23);
?>
<div id="mad">
    <div class="page">
        <!-- Nepa certificate front page  -->
        <img src="Capture_modified4.png" alt="" class="page-img">
    </div>
    
 <div class="page Container">

    <div class="top-left common">
        <h1>Rudraksha Detail Description:</h1>
    </div>

    <div class="top-right common">
    </div>
    
    <div class="section1 common">
        <span class="form-text">Date:</span>
        <span class="form-text">Name:</span>
        <span class="form-text">Invoice Number:</span>
        <span class="form-text">Product Code</span>
        <span class="form-text">Gold / Silver Used:</span>
        <span class="extra">Products:</span>
        <span class="form-text">Size:</span>
        <span class="form-text">Weight:</span>
        <span>Specific Comments:</span>
     </div>

     <div class="section2 common">
     <span class="section2_common"> <?php echo $nepaData['date'];?></span>
        <span class="section2_common"><?php echo $my_date; ?></span>
        <span class="section2_common">20302136100223</span>
        <span class="section2_common">Nepali Rudraksha</span>
        <span class="section2_common">Silver</span>
        <span class="extra2"> 2 mukhi medium</span>
        <span class="section2_common">18.68 mm</span>
        <span class="section2_common">1.8 gms</span>
        <span class="section2_common">Redish Brown | well Ripen -2 natural compartment.</span>
    </div>

    <div class="hr common">
    </div>

    <div class="bottom-left common">
        <span>
            This is to certify that this piece of Rudraksha / Saligram  has been selected and carefully inspected before leaving Nepa Rudraksha to confirm to the specification provided alongside. This item may be exchanged to the terms and conditions of the 
            Organizations exchange policy.
        </span>
    </div>

    <div class="footer common">
    </div>

    <div class="footer-text common">
        <span>
            Signature and Stamp
        </span>
    </div>

    <div class="stamp">
    </div>

 </div>
</div>

 <button onclick='generatePDF("a5")'>Generate Pdf</button>



<?php get_footer(); ?>
