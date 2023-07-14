<?php
// Template Name: IRL Maker
?>
<!DOCTYPE html>
<html>

<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  <link rel="stylesheet" href="../../wp-content/themes/irl-theme/style.css" />
  <script src="../../wp-content/themes/irl-theme/html2pdf.js"></script>
  <script src="../../wp-content/themes/irl-theme/loadimages.js"></script>
  <script>
    <?php
    $post_id = get_the_ID();
    $irl_sel_rud = get_post_meta($post_id, '_irl_sel_rud', true);
    $irl_rud_size = get_post_meta($post_id, '_irl_rud_size', true);
    $irl_rud_wght = get_post_meta($post_id, '_irl_rud_wght', true);
    $irl_front_img = get_post_meta($post_id, '_irl_front_img', true);
    $irl_back_img = get_post_meta($post_id, '_irl_back_img', true);
    $irl_xray_img = get_post_meta($post_id, '_irl_xray_img', true);
    $irl_size_grade = get_post_meta($post_id, 'irl_size_grade', true);
    $irl_origin = get_post_meta($post_id, 'irl_origin', true);
    $irl_vendor = get_post_meta($post_id, 'irl_vendor', true);
    if (!empty($irl_sel_rud)) {
      // Convert the PHP array to a JSON string
      $irl_sel_rud_json = json_encode($irl_sel_rud);
      $irl_rud_size_json = json_encode($irl_rud_size);
      $irl_rud_wght_json = json_encode($irl_rud_wght);
      $irl_front_img_json = json_encode($irl_front_img);
      $irl_back_img_json = json_encode($irl_back_img);
      $irl_xray_img_json = json_encode($irl_xray_img);

      // Output the JSON string as a JavaScript array
      echo 'var values = ' . $irl_sel_rud_json . ';';
      echo 'var rudSize = ' . $irl_rud_size_json . ';';
      echo 'var rudWght = ' . $irl_rud_wght_json . ';';
      echo 'var rudFront = ' . $irl_front_img_json . ';';
      echo 'var rudBack = ' . $irl_back_img_json . ';';
      echo 'var rudXray = ' . $irl_xray_img_json . ';';
      echo 'var rudGrade = "' . $irl_size_grade . '";';
      echo 'var rudOrigin = "' . $irl_origin . '";';
      echo 'var rudVendor = "' . $irl_vendor . '";';

    }

    ?>
    console.log(rudXray);
  </script>

<body>
  <!-- /* Pop up / alert Box / Model box  */ -->
  <div id="alert-body">
    <div id="alert">
      <p id="alert-msg"> Welcome to the tutorialsPoint! </p>
      <button class="closePopup" id="PopupBtn1"> Add value to origin</button>
      <button class="closePopup" id="PopupBtn2"> Replace value to origin</button>
    </div>
  </div>


  <!-- for multi select with search feature dropdown box -->
  <div id="multiSelectCdn">
    <link rel="stylesheet" type="text/css" href="../../wp-content/themes/irl-theme/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../wp-content/themes/irl-theme/bootstrap-select.min.css" />
    <script type="text/javascript" src="../../wp-content/themes/irl-theme/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="../../wp-content/themes/irl-theme/bootstrap-select.min.js"></script>
  </div>
  <link rel="stylesheet" href="../../wp-content/themes/irl-theme/style.css" />


  <!-- Nepa section-->
  <?php
  // $my_date = get_field('date');
  
  // $nepaData = get_field('nepa_coa',23);
  $Date = get_field("date");
  $Name = get_field("name");
  $Invoice = get_field("invoice_number");
  $COA = get_field("nepa_coa");
  $image_url = $COA['image'];
  $image_url2 = $COA['final_image'];
  $pdf = get_field("order_pdf");

  ?>
  <div id="mad2">
    <page class="Nepa_page Nepa_fixed_top">
      <!-- Nepa certificate front page  -->
      <img src="../../wp-content/themes/irl-theme/Capture_modified4.png" alt="" class="Nepa_page-img">
    </page>

    <page class="Nepa_page Nepa_Container">
      <div class="section1">
        <div class="section1_top">
          <div class="Nepa_top-left Nepa_common">
            <h1>Rudraksha Detail Description:</h1>
          </div>

          <div class="Nepa_section1 Nepa_common">
            <div class="box">

            </div>

            <span class="Nepa_form-text"><span>Date:</span></span>
            <span class="Nepa_section2_common">
            <span><?php echo $Date; ?></span>
            </span>
            <span class="Nepa_form-text">Name:</span>
            <span class="Nepa_section2_common">
            <span></span> <?php echo $Name; ?>
            </span>
            <span class="Nepa_form-text">Invoice Number:</span>
            <span class="Nepa_section2_common">
            <span></span> <?php echo $Invoice; ?>
            </span>
            <span class="Nepa_form-text">Product Code</span>
            <span class="Nepa_section2_common">
            <span></span><?php echo $COA['product_code']; ?>
            </span>
            <span class="Nepa_form-text">Gold / Silver Used:</span>
            <span class="Nepa_section2_common">
            <span></span><?php echo implode(', ', $COA['gold_silver_used']); ?>
            </span>
            <span class="Nepa_extra">Products:</span>
            <span class="Nepa_extra2"><span  id="product"></span></span>
            <span class="Nepa_form-text">Size:</span>
            <span class="Nepa_section2_common" ><span id="size"></span></span>
            <span class="Nepa_form-text">Weight:</span>
            <span class="Nepa_section2_common">
            <span  id="weight"></span>
                      </span>
            <span class="Nepa_form-text">Specific Comments:</span>
            <span class="Nepa_section2_common">
              <span> Reddish Brown | Well Ripen<br>-  
              <?php echo $COA['specific_comment']; ?> Natural Compartments</span>
           
            </span>
          </div>
          <div class="Nepa_hr Nepa_common">
          </div>
        </div>
        <div class="section1_bottom">
          <div class="Nepa_bottom-left Nepa_common">
            <span>
              This is to certify that this piece of Rudraksha / Saligram has been selected and carefully inspected
              before
              leaving Nepa Rudraksha to confirm to the specification provided alongside. This item may be exchanged to
              the
              terms and conditions of the
              Organizations exchange policy.
            </span>
          </div>

          <div class="Nepa_footer Nepa_common">
          </div>

          <div class="Nepa_footer-text Nepa_common">
            <span>
              Signature and Stamp
            </span>
          </div>

          <div class="Nepa_stamp">
          </div>
        </div>
      </div>
      <div class="section2">
        <div class="Nepa_top-right Nepa_common">
          <div class="right_container">
            <?php
            if (!empty($image_url)) {
              echo '<div class="Nepa_top_image" id="topimage">
                      <img class="img_top" src="
                    ' . $image_url . '"
                      alt="">
                      </div>';
            }
            ?>
            <div class="Nep_main_image" style="<?php
            if (empty($image_url)) {
              echo "height:90%;";
            } else {
              echo "height:65%";
            }
            ?>">
              <?php
              if (!empty($image_url2)) {
                echo '
                      <img class="img_main" src="' . $image_url2 . '"  alt="">
                      </div>
                      <div class="Nepa_image_label">
                        
                      <div class="image_label_first">' . $COA["imglabel"] . '</div>
                      <div class="image_label_second">' . $COA["imglabel2"] . '</div>';
              } else if (empty($image_url)) {
                echo ' 
                        <div class="sec-page section" id = "sectionEdit" style="${values.length > 4?"height:100%;":""}">
                        <div class="products-img" id="productsImg" >

                        </div>
                        <div style="font-size:9px; font-family:brela">

                      
                        </div>


                      </div>
                      '
                ;
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </page>
  </div>

  <button onclick='generatePDF("a5","mad2")' style="margin:0 auto; padding:15px;background-color:red;color:white;font-size:arial;" class="generatepdf">Generate Pdf Print</button>
    <button onclick='generatePrintPDF("a5","mad2")' style="margin:0 auto;padding:15px;background-color:red;color:white;font-size:arial;" class="generatepdf">Generate Pdf</button>

  <!-- Nepa section end -->
  <script>
    var elementId;
    const tx = document.getElementsByTagName("textarea");
    for (let i = 0; i < tx.length; i++) {
      tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
      tx[i].addEventListener("input", textareaStyle, false);
    }

    function textareaStyle() {
      this.style.height = 0;
      this.style.height = (this.scrollHeight) + "px";

    }

    $("input[type='text']").css({ "border-bottom": "none", "outline": "none" })
    $("button[type='button']").css({ "border-bottom": "none", "outline": "none" })
    $(".dropdown-toggle").addClass('generated')

    // This function Generates pdf of the page. First it  convert the webpage to the canvas and read whole page as a image and then further it converts the image to pdf   
    function generatePDF(Size, head_element) {
        $("input[type='text']").css({ "border-bottom": "none", "outline": "none" })
        $("textarea").css({ "border": "none", "color": "#2F48A4" })
        $(".scale-input").css({ "Background": "none" })
        // $(".Nepa_Container").css({ "Background":"none" })
        // $(".box").css({ "Background":"none" })
        // $(".Nepa_top-right").css({ "Background":"none" })
        let firstcontain = document.getElementsByClassName("Nepa_Container");
        let secondcontain = document.getElementsByClassName("box");
        let thirdcontain = document.getElementsByClassName("Nepa_top-right");
        let forthcontain = document.getElementsByClassName("Nepa_fixed_top");
        let fifthcontain = document.getElementsByClassName("Nepa_hr");
        let sixthcontain = document.getElementsByClassName("Nepa_top-left");
        let seventhcontain = document.getElementsByClassName("section1_bottom");
        let eighthcontain = document.getElementsByClassName("Nepa_form-text");
        let ninthcontain =document.getElementsByClassName("Nepa_extra");
        for(i = 0;i<eighthcontain.length;i++){
          
        eighthcontain[i].style.visibility = "hidden";
        }
        ninthcontain[0].style.visibility = "hidden"; 
        firstcontain[0].style.backgroundColor = "rgba(0, 0, 0, 0)";
        firstcontain[0].style.backgroundImage = "none";
        firstcontain[0].style.backgroundImage = "none";
        firstcontain[0].style.backgroundImage = "none";
        secondcontain[0].style.backgroundColor = "rgba(0, 0, 0, 0)";
        thirdcontain[0].style.backgroundColor = "rgba(0, 0, 0, 0)";
        firstcontain[0].style.mixBlendMode = "screen";
        secondcontain[0].style.mixBlendMode = "screen";
        thirdcontain[0].style.mixBlendMode = "screen";
        forthcontain[0].style.display = "none";
        fifthcontain[0].style.visibility = "hidden";
        sixthcontain[0].style.visibility = "hidden";
        seventhcontain[0].style.visibility = "hidden";
        $(".hide-on-pdf").css({ "display": "none" });
        $(".upload-msg").css("display", "none");
        $(function () {
          $('textarea').each(function() {
            textareaVal= $(this).val()
            $(this).replaceWith($('<span/>').html($(this).html())).val(textareaval);
          });

          // Loop through each textarea element on the page
          $('textarea').each(function () {
            // Create a new span element
            var span = $('<span>', {
              text: $(this).val(), // Set the text content of the span to be the same as the textarea
              class: $(this).attr('class') // Copy the class attribute from the textarea to the span
            });

            // Replace the textarea with the new span element
            $(this).replaceWith(span);
          });

        });
      var opt =
      {
        margin: 0,
        filename: 'myfile.pdf',
        image: { type: 'png', quality: 1 },
        html2canvas: { dpi: 900, scale: 3 },
        jsPDF: { unit: 'mm', format: Size, orientation: 'landscape' }
      };
      var element = document.getElementById(head_element);
      html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
        pdf.save()
      });
    }
    //for printing
    function generatePrintPDF(Size, head_element)
     {
      if (Size == "a4") {
        $("input[type='text']").css({ "border-bottom": "none", "outline": "none" })
        $("textarea").css({ "border": "none", "color": "#2F48A4" })
        $(".scale-input").css({ "display": "none" })
        $(".hide-on-pdf").css({ "display": "none" })
        $(".upload-msg").css("display", "none")
        $(function () {
          // $('textarea').each(function() {
          //   textareaVal= $(this).val()
          //   $(this).replaceWith($('<span/>').html($(this).html())).val(textareaval);
          // });

          // Loop through each textarea element on the page
          $('textarea').each(function () {
            // Create a new span element
            var span = $('<span>', {
              text: $(this).val(), // Set the text content of the span to be the same as the textarea
              // class: $(this).attr('class') // Copy the class attribute from the textarea to the span
            });

            // Replace the textarea with the new span element
            $(this).replaceWith(span);
          });

        });
      }
      var opt = 
      {
        margin: 0,
        filename: 'myfile.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { dpi: 900, scale: 3 },
        jsPDF: { unit: 'mm', format: Size, orientation: 'landscape' }
      };
      var element = document.getElementById(head_element);
      html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
        pdf.save()
      });
    }

//     function generatePDF(Size, head_element) {
//     // Set styles to hide unnecessary elements and make background transparent
//     $("input[type='text']").css({ "border-bottom": "none", "outline": "none" });
//     $("textarea").css({ "border": "none", "color": "#2F48A4" });
//     $(".scale-input").css({ "background": "none" });

//     // Select elements to hide or modify
//     let eighthcontain = document.getElementsByClassName("Nepa_form-text");
//     let ninthcontain = document.getElementsByClassName("Nepa_extra");

//     // Hide elements
//     for (let i = 0; i < eighthcontain.length; i++) {
//         eighthcontain[i].style.visibility = "hidden";
//     }
//     ninthcontain[0].style.visibility = "hidden";

//     // Convert textarea elements to spans
//     $('textarea').each(function () {
//         var span = $('<span>', {
//             text: $(this).val(),
//             class: $(this).attr('class')
//         });
//         $(this).replaceWith(span);
//     });

//     // Retrieve content from WordPress custom field

//     // Use html2canvas to capture the content as an image
//     html2canvas(document.getElementById(head_element)).then(function (canvas) {
//         // Create a new jsPDF instance
//         var doc = new jsPDF({ unit: 'mm', format: Size, orientation: 'landscape' });

//         // Add the captured image to the PDF with transparency
//         doc.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight());

//         // Save the PDF
//         doc.save('myfile.pdf');
//     });
// }



  </script>
  <script>


    //arbin-code
    // let product = document.getElementById("product");
    // product.innerHTML = values;
    //arbin-code
let counter = 0;

    console.log(values);

    // to get the all the Rudraksha selected by the user for further processing
    var kajuOrigin;
    // $('#rudraksha-select').change(() => {
    // let values = $('#rudraksha-select').val()
    $("#productsImg").empty();
    //modified arbin
    $("#productsImg2").empty();

    let nonJhapacnt = 0;
    let nonKajucnt = 0;
    let startPop = 1;
    var rudTested = ''
    var rudSizeUse = ''
    var rudWghtUse = ''
    let valueTest = [];
    let indexStoreStart = 0;
    let indexStoreEnd = 0;
    let lasti;
    for(let i = 0;i<values.length;i++){
      valueTest[i] = parseInt(values[i].replace(" Mukhi","0"));
      console.log("hello "+ valueTest[i]);
    }
    let j = 0;
    for(let i = 0;i<valueTest.length;i++){
      if(i == 0){
        j = (i+2)*10;
      }
      else if(j == valueTest[i]){
        indexStoreEnd = i;
        j = (i+2) * 10;
      }
      else{
        lasti = i;
       break;
      }
    }
    //Nepa weight section
    if(values.length > 6){
      let sgrade = document.getElementById('weight')
    let sum = 0;
    for(let i = 0 ;i<rudSize.length;i++){
        sum += parseFloat(rudWght[i]);
    }
      sgrade.innerHTML = sum.toFixed(2) + " gms"

 
    }
    else
    {
    rudWght.map((wghtUse) => {

      if (rudWghtUse) {
        rudWghtUse = rudWghtUse + ' | ' + (parseFloat(wghtUse).toFixed(2)).toString();
      }
      else {
        rudWghtUse = rudWghtUse + (parseFloat(wghtUse).toFixed(2)).toString()
      }
      let rweight = document.getElementById('weight')
      rweight.innerHTML = rudWghtUse + " gms"
    })
  }
  if(values.length > 6){
    let rSize = document.getElementById('size')
      rSize.innerHTML = rudGrade;
    }
    else{
    //Nepa size section
    rudSize.map((rSize) => {
      //size nepa
      if (rudSizeUse) {
        rudSizeUse = rudSizeUse + ' | ' + rSize
      }
      else {
        rudSizeUse = rudSizeUse + rSize
      }

      let sgrade = document.getElementById('size')
      sgrade.innerHTML = rudSizeUse + " mm"
    })
  }
    console.log("hello" + indexStoreEnd);
    if(indexStoreEnd != 0){
      console.log("index is active");
      let rudTested = '('  + values[indexStoreStart].replace(" Mukhi", "M") +' - ' + values[indexStoreEnd].replace(" Mukhi", "M") + ')';
      let product = document.getElementById("product");
      product.innerHTML = rudTested + " - " + rudGrade;
        let k = lasti;
        console.log(k + '\n');
        for(k;k<=values.length;k++){
          console.log(k + '\n');
          if(typeof(values[k]) === 'undefined'){
            console.log("break");
            break;
          }
          rudTested = rudTested + ' | ' + values[k].replace(" Mukhi", "M");
          product.innerHTML = rudTested;
        }
    }
    else{
    //Nepa Product section
    values.map((value) => {
      // let intUse = Integer.parseInt(wghtUse);
      // Replace "Mukhi" with "M" so that while selecting the multiple values, Rudraksha Tested field occupies less space   
   
      if (rudTested) {
        rudTested = rudTested + ' | ' + value.replace(" Mukhi", "M")
      }
      else {
        rudTested = rudTested + value.replace(" Mukhi", "M")
      }

      let product = document.getElementById("product");
      let showGrade = " -" + rudGrade;
      product.innerHTML = rudTested + (values.length <= 6?showGrade:"");

      if (!value.includes("Japa")) {
        nonJhapacnt++
      }

      if (!value.includes("Kaju")) {
        nonKajucnt++
      }

    })
  }

    // To set the origin to Indonsian if japa mala is selected  and give a choice of India or Nepal after the Kaju is selected.
    // below code automatically adds Indonesia if jhapa mala is selected whereas it generates a popup with options if kaju is selected.  


    if (rudTested.includes("Japa") || rudTested.includes("Kaju")) {
      // To set the origin to Indonsian if japa mala is selected    
      if (rudTested.includes("Japa")) {
        if (nonJhapacnt == 0) {
          originRudra = ["Indonesia"]
        }
        else {
          if (!originRudra.includes("Indonesia")) {
            originRudra.push("Indonesia")
          }
          if (!originRudra.includes("Nepal") && rudTested.includes("Kaju") && values.length >= 2) {   // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected. 
            originRudra.unshift("Nepal")
          }
          else if (!originRudra.includes("Nepal") && !rudTested.includes("Kaju") && values.length >= 2) {   // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected.
            originRudra.unshift("Nepal")
          }
          if (originRudra.includes("Nepal") && rudTested.includes("Kaju") && values.length == 2) {  // This checks if the origin Nepal is present or  while kaju & japa  are selected only selected and removes the Nepal
            originRudra.shift("Nepal")
          }
        }
      }
      else {
        if (originRudra.includes("Indonesia")) {
          originRudra.splice(originRudra.indexOf("Indonesia"), 1)
        }
      }


      // To set the origin to India/Nepal When Kaju is selected
      //
      if (rudTested.includes("Kaju")) {
        function addIndia(count) {
          if (count == 0) {
            originRudra = ["India(1M Kaju)"]
          }
          else {
            if (!originRudra.includes("India(1M Kaju)")) {
              //Avoid the push of "India(1M Kaju)" to originRudra arry, this prevents the duplication of value in Rudraksha Origin field after the kaju is selected
              originRudra.push("India(1M Kaju)")
            }
          }
          $("#rudOrigin").text(originRudra)
          document.getElementById("alert-body").style.display = "none";
        }
        function popupAlert() {
          document.getElementById("alert-body").style.display = "flex";
        }
        function closepopup() {
          document.getElementById("alert-body").style.display = "none";

        }

        if (stopPop == 0) {
          document.getElementById("alert-msg").innerText = `Select the Origin of the 1 Mukhi Kaju Rudraksha`;
          $("#PopupBtn1").text("India").click(() => addIndia(nonKajucnt))
          $("#PopupBtn2").text("Nepal").click(() => closepopup())
          popupAlert()
        }
        stopPop = 1;
      }
      else {
        stopPop = 0
        if (originRudra.includes("India(1M Kaju)")) {
          originRudra.splice(originRudra.indexOf("India(1M Kaju)"), 1)
        }
        if (!originRudra.includes("Nepal") && rudTested.includes("Japa") && values.length >= 2) {
          // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected. 
          originRudra.unshift("Nepal")
        }
        else if (!originRudra.includes("Nepal") && !rudTested.includes("Japa") && values.length >= 2) {
          // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected.
          originRudra.unshift("Nepal")
        }
        if (originRudra.includes("Nepal") && rudTested.includes("Japa") && values.length == 2) {
          // This checks if the origin Nepal is present or  while kaju & japa  are selected only selected and removes the Nepal
          originRudra.shift("Nepal")
        }
        $("#rudOrigin").text(originRudra)
      }
    }
    else {
      stopPop = 0
      originRudra = ["Nepal"]
    }
    $("#rudTested").text(rudTested)
    $("#rudOrigin").text(originRudra)

    // End of the automation for Rudraksha origin field

    // to get the no of faces of rudraksha and populate the input box of number of faces
    let faces = ''
    let count = 0 //for productImg
    let cnt = 0 //for singleProduct image
    let openParent = ''
    let openParent2 = ''
    let gridColn = 0; // to make the product images sit in the grid 
    var columns;
    var rows;
    let elements = "";
    var imgWidth;
    var random = Math.floor((Math.random() * 1000) + 1)

    values.map((value) => {
      cnt++
      gridColn++
      if (gridColn == 3) {
        gridColn = gridColn / 3;
      }


      if (values.length == 1) {
        openParent = `<div id="singleProductImg${cnt}" class="products" style="grid-column:1/-1; display: grid; grid-template-columns: 1fr 1fr;">`

        $(`#singleProductImg${cnt}`).empty();
        //arbin
        $(`#singleProductImg2${cnt}`).empty();
        $('#productsImg').append(openParent)
        $('#productsImg2').append(openParent2)
      }
      else if (values.length == 2) {
        openParent = `<div id="singleProductImg${cnt}" class="products" style="grid-column:1/span 2; display: grid; grid-template-columns: 1fr 1fr;">`
        $(`#singleProductImg${cnt}`).empty();
        $('#productsImg').append(openParent)
      }
      else if (values.length >= 7) {
        if (values.length >= 19) {
          columns = "repeat(4,1fr)"
          rows = "repeat(4,1fr)"
          imgWidth = "53px"
        } 
        else if(values.length > 10){
          columns = "repeat(3,1fr)"
          rows = "repeat(3,1fr)"
          imgWidth = "68px"
        }
        else {
          columns = "repeat(2,1fr)"
          rows = "repeat(3,1fr)"
          imgWidth = "85px"
        }
        if (cnt <= 2) {
          openParent = `<div  id="singleProductImg${cnt}" class="products" style="grid-column:${gridColn}/${gridColn + 1}; display: grid; grid-template-columns: ${columns}; grid-template-rows: ${rows};">`

          $('#productsImg').css({
            "grid-template-colums": "1fr 1fr"
          })
       

          $('.sec-page').css("justify-content", "flex-start")
          $(`#singleProductImg${cnt}`).empty();

          $('#productsImg').append(openParent)
      
        }
      } 
      //arbin
      if(values.length >4 && values.length <7){
        openParent = `<div  id="singleProductImg${cnt}"  class="products" style="${values.length > 4 && values.length < 7?"border-bottom:solid 1px #D2691E;padding-bottom:10px;":""} grid-column:1/4; display: grid; grid-template-columns:repeat(4,1fr);">`

$(`#singleProductImg${cnt}`).empty();
$('#productsImg').append(openParent)
      }
      else {
        openParent = `<div  id="singleProductImg${cnt}" class="products" style="grid-column:${gridColn}/${gridColn + 1}; display: grid; grid-template-columns: 1fr 1fr;">`

        $(`#singleProductImg${cnt}`).empty();
        $('#productsImg').append(openParent)
      }
      count++



      face = value.match(/\d+/g);
      if (face) {
        faces ? faces = faces + ',' + face : faces = face[0];
      }
      imageTypes = ['Front', 'Rear', 'X-Ray', 'Weight']
      if (values.length <= 6) {
        let leftRudBead = 0;
     
        // let prdImgCnt=0;
        imageTypes.map(
          (type) => {
            count++
            let id = count + value.replace(/\s/g, '') + random
            var frontid = ''

            frontid = `measurement2`
            if (count == 2 || count == 7 || count == 10 || count == 14 || count == 22 || count == 27) {
              rud = `measurement${count}`
            }
            if (type == 'Front') {
              if(values.length == 1){
                leftRudBead = 18;
                BottomRudBead = 16;
              }
              else if(values.length == 2)
              {
               leftRudBead = 11.5;
               BottomRudBead = 16;
             }
             else if(values.length == 3  || values.length == 4){
              leftRudBead = 25;
              BottomRudBead = 16;
             }
             else if(values.length == 6){
              leftRudBead = 13.9;
              BottomRudBead=0;
             }
             else if(values.length >4 && values.length <7){
              leftRudBead = 16;
              BottomRudBead = 0;
             }

             
              elements = ` 
                      <div style="position:relative; ">
                      <div class="product-label" style="${values.length == 3  || values.length == 4?"font-size:9px;":"font-size:10px;"}text-align:center">
                        <span>${value} </span>(${value != "Kantha Mala" ? value != "Japa Mala" ? type == "Front"? "Size":"": "Avg. Bead Size" : "Avg. Bead Size"})
                      </div>
                      <!--arbin-->
                      <div class="product-image caliper-section" style=${values.length == 1?"border-top-style:solid;border-top-width:1px;border-top-color:#D2691E;border-right-style:solid;border-right-width:1px;border-right-color:#D2691E;":""} >
                        
                        <canvas id="${id}-canvas" style="display:none"></canvas>          
                        <label for="${id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important; ${values.length == 3 || values.length ==  4 || values.length == 1?"justify-content: flex-start;":"justify-content:flex-end;"}"><!--arbin-->
                          <div id="caliper${count}" class="caliper">
                           
                            <img id="vernier-scale${count}" src="../../wp-content/themes/irl-theme/calliper/calliper_head.png" />
                            <div class="moveable-jaw" style="z-index: 1000;">
                              <img src="${rudFront[cnt - 1]}" id="${id}" class="img-${type} front-caliper-img" style=" position: absolute;left:${leftRudBead}%;bottom:${BottomRudBead}%;" >
                              <img id="jaw${count}" style="left: 0%; " src="../../wp-content/themes/irl-theme/calliper/jam.png" />
                              <div id="output${count}"></div>
                              <div id="outputoutputSec${count}"></div>
                              </div>
                            </div>                              
                        </label>
                      </div>
                  
                      </div>

                      <style>
                      #caliper${count} {
                        width: 80%;
                        height: 85%;
                        position: relative;
                        user-select: none;
                      }
                      .generated::after {
                          content: none;
                      }

                      #main-scale${count} {
                        width: 120%;
                        height: 20.5%;
                        position: absolute;
                        top: 27.2%;
                        background: url(../../wp-content/themes/irl-theme/calliper/scale1.png);
                        background-size: contain;
                        background-repeat: no-repeat;
                      }
                      /* arbin*/
                      #vernier-scale${count} {
                      /*  left:${values.length == 1?0:32}px;*/
                        top:${values.length == 1?42:values.length > 4?0:8}px;
                        height: ${values.length == 1?60:values.length > 4?100:80}%;
                        position: absolute;
                        z-index: 999;
                      }

                      #jaw${count} {
                        height: ${values.length == 1?60:values.length > 4?100:80}%;
                        position: absolute;
                        bottom: ${values.length == 1?30:values.length > 4?0:10}px;    
                      }

                      .moveable-jaw {
                        width: 100%;
                        height: 100%;
                        position: absolute;
                        bottom: 0;
                      }

                      .scale-tick {
                        position: absolute;
                        bottom: 10px;
                        font-size: 12px;
                        color: transparent;
                        text-align: center;
                      }

                      .scale-tick::before {
                        position: absolute;
                        height: 10px;
                        bottom: -10px;
                        width: 1px;
                        content: '';
                        background: transparent;
                      }

                      .scale-line {
                        position: absolute;
                        bottom: 2px;
                        width: 1px;
                        height: 5px;
                        background-color: transparent;
                      }

                      #caliper${count} input {
                        position: absolute;
                        bottom: -20px;
                        width: 80%;
                      }

                      div#output${count} {
                        
                        position: absolute;
                        top: ${values.length >4?23:values.length == 1?40:0}%;
                          left:${values.length > 4?54:values.length ==1?105.5:50}%;
                        height: ${values.length > 4?15:values.length==2?12:9.5}%;
                        width: 44.44%;
                        z-index: 99999999;
                      } 
                        </style>
                        `
              $(`#singleProductImg${cnt}`).append(elements)
              cropperShadow(rudFront[cnt - 1], id, `${id}-canvas`, 'Front', count);
              var caliper = document.getElementById(`caliper${count}`)
              var parent = document.getElementById(`output${count}`);
              var parent2 = document.getElementById(`outputoutputSec${count}`);
              var jaw = document.getElementById(`jaw${count}`)
              var input = document.getElementById(`measurement${count}`)

              var calimg = $(`#${id}`)
              jaw.style.left = '0'

              var jawLeft = 0
              var mouseX = 0


              // this is to display the number on  calliper display 
              const displayNum = (value) => {

                while (parent.firstChild) {
                  parent.removeChild(parent.firstChild);
                }
                var counter = 0;
                var numberString = value.toString();
                var inputArray = numberString.split('');
                for (var i = 0; i < inputArray.length; i++) {
                  if (inputArray[i] === '.') {
                    var counter = 1;
                  }
                }


                if (counter) {
                  var numbers = numberString.split('.');
                  if (numbers[0]) {
                    var number = numbers[0];
                  } else {
                    number = '0';

                  }
                  var decimal = numbers[1];
                } else {
                  var numbers = value.toString();
                  var number = numbers;
                  var decimal = '00';
                }

                if (number.split('').length == 1) {
                  if (values.length == 1) {
                    parent.style.paddingLeft = "6.53%";
                  } else if (values.length == 2) {
                    parent.style.paddingLeft = "6%";
                  } else {
                    parent.style.paddingLeft = "6.25%";
                  }
                }
                var numberArray = number.split('');
                if (decimal.split('').length == 1) {
                  decimal = decimal + "0";
                }
                var decimalArray = decimal.split('');

                const convertNumber = (digit) => {
                  /*arbin*/
                  img.style.height = '25%';
                  img.style.display = 'inline-block';

                  if (digit[i] === '1') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/1.png');
                  } else if (digit[i] === '2') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/2.png');
                  } else if (digit[i] === '3') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/3.png');
                  } else if (digit[i] === '4') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/4.png');
                  } else if (digit[i] === '5') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/5.png');
                  } else if (digit[i] === '6') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/6.png');
                  } else if (digit[i] === '7') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/7.png');
                  } else if (digit[i] === '8') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/8.png');
                  } else if (digit[i] === '9') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/9.png');
                  } else if (digit[i] === '0') {
                    img.setAttribute('src', '../../wp-content/themes/irl-theme/calliper/0.png');
                  }

                }

                for (var i = 0; i < numberArray.length; i++) {

                  var img = document.createElement('img');
                  convertNumber(numberArray);
                  parent.appendChild(img);

                }

                for (var i = 0; i < decimalArray.length; i++) {

                  var img = document.createElement('img');
                  convertNumber(decimalArray);
                  parent.appendChild(img);

                }
              
                // if (values.length == 1) {
                //   /*arbin*/
                //   $('#output2').css("top", '42.5%')
                //   parent.style.left = value / 0.58 + 25.8 + '%'
                // } else {
                //   // parent.style.left = value / 0.58 + 65 + '%'
                //   if (values.length == 2) {
                //     parent.style.left = value /0.58 + 25.8 + '%'
                //     parent.style.top = "30.25%";
                //   }
                //   if(values.length == 3 || values.length == 4){
                //     console.log("v="+(parseInt(v)/1.95));
                //     parent.style.left = parseInt(v) / 1.95 + 87 + '%'
                //     parent.style.top = "30.25%";
                //   }
                //   if (values.length > 4) {
                //     parent.style.top = "30%";
                //   }
                // }
                // values.map((v) =>{
                  let trigger = 0;
                  let triggerPoint = 8;
                if (values.length == 1) {
                 
                  // parent.style.left = value / 0.9 + 25.8 + '%'
                  parent.style.left = value / 1.7 + 40.5 + '%'
                  parent.style.top = "43.38%";
                } else {
                  
                  // parent.style.left = value / 0.9 + 32 + '%'
                  if (values.length == 2) {
                    console.log("checkpoint");
                    parent.style.left = value / 1.7 + 19.5 + '%'
                    parent.style.top = "30.98%";
                  }
                  else if (values.length == 3 || values.length == 4) {
                    
                    // if(value >= 24 && value <=26){
                    //     trigger = 2;
                    // }
                    // else if(value >26 && value < 30){
                    //   trigger = 5;
                    // }
                 
                      
                      if(value >=8 && value <10){
                        trigger =-8;
                        trigger = (value - triggerPoint)+trigger;
                      }
                      else{
                      if(value > triggerPoint){
                       
                        trigger = -13;
                        trigger = (value - triggerPoint)+ (value>40?-13.9:trigger);
                      }
                    }
                  
                    parent.style.left = value / 1.6 + (70.5 + trigger) + '%'
                    parent.style.top = "31.48%";
                  }
                  else if(values.length >4){
                    if(value >=8 && value <10){
                    trigger = (value - triggerPoint)-1;
                    }
                    else{
                    //   trigger = -2;
                    //  triggerPoint =10;
                    //   trigger =trigger-(value-triggerPoint);
                    }
                    parent.style.left = value / 1.6 + (40.5 + (value>=10 && value <17?-3:value>=17 && value<23?-0.5:value>=23 && value <30?2:value >=30 && value < 36?4:value >=36 && value < 41?6:value>=41 && value <47?8:value >=47?10:trigger)) + '%';
                    parent.style.top = "23.48%";
                  }

        
                }
              // });
                // console.log("parent 2 ko test" + parent2)
                parent2.style.left = value / 0.9 + 27.5 + '%'

                if (numberArray.length <= 1) {
                  parent.style.paddingLeft = "13%";
                }
                if (numberArray.length > 1) {
                  parent.style.paddingLeft = "6.5%";
                }
              }

              displayNum(rudSize[cnt - 1]);


            } else if (type == 'Weight') {
              let checkJapa = value.includes("Japa Mala")
              elements = ` 
                        <div style="position:relative;">
                        <div class="product-label" style="${values.length == 3  || values.length == 4?"font-size:9px;":"font-size:10px;"} text-align:center">
                                <span>${value}</span>(${value != "Kantha Mala" ? value != "Japa Mala" ? type : "Weight" : "Avg. Bead Wt."})
                                </div>
                          <div class="product-image" style="${values.length == 1?"border-top:solid 1px #D2691E;":values.length >4?"":"border-bottom:solid 1px #D2691E;"}">
                            
                              <canvas id="rud-canvas${count}" style="display:none"></canvas> 
                              <label for="${id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important; justify-content: center; ">
                              <div class="moveable-jaw" style="display:flex; width:auto; ">
                              <!--arbin-->
                            ${checkJapa ? `<img id="weight${count}" style="left: 0%;" ${values.length == 1?"height=80px width=150px":values.length > 4?"height=40px width=80px":"height=60px width=120px"} src="../../wp-content/themes/irl-theme/" />
                      <img id="rud${count}" class="japa-weight" src style=" position: absolute; height: 100%!important; min-height:auto;" height="80px" width="150px"/>` : `<img id="weight${count}" style="left: 0%;" src="../../wp-content/themes/irl-theme/weight/weight.png"${values.length == 1?"height=80px width=150px":values.length > 4?"height=40px width=80px":values.length == 3 || values.length ==4?"height=60px width=100px":"height=60px width=120px"} />
                      <img id="rud${count}" class="rudrakshaWeight" src="${rudFront[cnt - 1]}" style=" position: absolute; height: auto; min-height:auto;"/>
                      <div id="output${count}" style="position: absolute; left: 21px; bottom: 12px;"></div>
                      <div id="outputSec${count}"></div>`}
                                </div>
                                <input style="display:none;" placeholder="00.00" maxlength="5" type="text" value="${rudWght[cnt - 1]}" id="wghtmeasurement${count}" class="weight-input hide-on-pdf" style="scale:1.2; position: absolute; background-color: coral!important; top:3px; border:1px solid coral; left: 50%; translate: -50%; width: 30px; " />
                                </label>
                                </div>
                            
                                </div>`


              var element_style = `
                                <style>
                                #output${count}{
    
                                  top:${values.length == 1?38:values.length >4?28:30.9}%;
                                  height: ${values.length == 1?5.5:values.length > 4?10:8.8}%!important;
                                  display: flex;
                                  min-height: auto;
                                  left: ${values.length == 1?75.1:75.2}%!important;
                                  align-items: center;
                                  bottom: 8.3%!important;
                                }
                                #output${count} img{
                                  opacity:20%;
                                }

                                
                                .japa-weight{
                                  width:auto!important;
                                }
                                
                                .moveable-jaw{
                                  justify-content:center;
                                }
                                </style>
                                `


              $(`#singleProductImg${cnt}`).append(elements)
              $(`#singleProductImg${cnt}`).append(element_style)
           
              if (!checkJapa) {
                cropperShadow(rudWght[cnt - 1], `rud${count}`, `rud-canvas${count}`, 'Weight', count);
                var wghtparent = document.getElementById(`output${count}`);
                var wghtparent2 = document.getElementById(`outputSec${count}`);
                var wghtjaw = document.getElementById(`weight${count}`)
                var wghtinput = document.getElementById(`wghtmeasurement${count}`)
                wghtjaw.style.left = '0'
                var wghtjawLeft = 0





                // this function displays the number on the screen of weigth machine
                const displayNum = (value) => {

                  while (wghtparent.firstChild) {
                    wghtparent.removeChild(wghtparent.firstChild);
                  }
                  var counter = 0;
                  var numberString = value.toString();
                  var inputArray = numberString.split('');
                  for (var i = 0; i < inputArray.length; i++) {
                    if (inputArray[i] === '.') {
                      var counter = 1;
                    }
                  }


                  if (counter) {
                    var numbers = numberString.split('.');
                    if (numbers[0]) {
                      var number = numbers[0];
                    } else {
                      number = '0';

                    }
                    var decimal = numbers[1];
                  } else {
                    var numbers = value.toString();
                    var number = numbers;
                    var decimal = '0';
                  }

                  var numberArray = number.split('');
                  // if (decimal.split('').length == 1) {
                  //     // decimal = decimal + "0";
                  // }
                  var decimalArray = decimal.split('');

                  const convertNumber = (digit) => {
                    img.style.height = '90%';
                    img.style.display = 'inline-block';
                    // img.style.marginRight = '2px';

                    if (digit[i] === '1') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/1.png');
                    } else if (digit[i] === '2') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/2.png');
                    } else if (digit[i] === '3') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/3.png');
                    } else if (digit[i] === '4') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/4.png');
                    } else if (digit[i] === '5') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/5.png');
                    } else if (digit[i] === '6') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/6.png');
                    } else if (digit[i] === '7') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/7.png');
                    } else if (digit[i] === '8') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/8.png');
                    } else if (digit[i] === '9') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/9.png');
                    } else if (digit[i] === '0') {
                      img.setAttribute('src', '../../wp-content/themes/irl-theme/weight/0.png');
                    }
                  }

                  for (var i = 0; i < numberArray.length; i++) {
                    var img = document.createElement('img');
                    convertNumber(numberArray);
                    wghtparent.appendChild(img);
                  }

                  for (var i = 0; i < decimalArray.length; i++) {
                    var img = document.createElement('img');
                    convertNumber(decimalArray);
                    wghtparent.appendChild(img);
                  }



                  wghtparent.style.left = value / 0.9 + 25.25 + '%'

                  if (numberArray.length <= 1) {
                    wghtparent.style.paddingLeft = "10%";
                  }
                  if (numberArray.length > 1) {
                    wghtparent.style.paddingLeft = "7%";
                  }



                }

                function weight_val() {
                  let value = wghtinput.value
                  displayNum(value);
                }
                weight_val();
                wghtinput.addEventListener('change', function () {
                  weight_val();
                  // wghtjaw.style.left =  '50%'
                })
              }
            } else {

              elements = ` <div>
              <div class="product-label" style="${values.length == 3  || values.length == 4?"font-size:9px;":"font-size:10px;"} text-align:center">             
                          <span>${value} </span>(${value == "Kantha Mala" || value == "Japa Mala" ? type == "Rear" ? "Beads" :"Rear": type == "Rear"?"Front":"Rear"})
                          </div>
              <div class="product-image" style="${values.length == 1?type=="Rear"?"border-top:solid 1px #D2691E;":"border-top:solid 1px #D2691E;border-right:solid 1px #D2691E;":type=="Rear"?" ":values.length > 4?"":"border-bottom:solid 1px #D2691E;"}"><input
                        type="file"
                            accept="image/*"
                            name="image"
                            id="${id}Input"
                            onchange="cropperShadow('${id}Input','${id}','canvas${id}','Other','${count}')"
                            style="display: none"
                          />
                          <canvas id="canvas${id}" style="display:none"></canvas> 
                          <label ${type == "Rear" ? 'style="scale:0.6; display: flex; justify-content: center;"' : null} for="${id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important">
                                                
                              <img id="${id}" class="img-${type}" src="${type == "Rear" ? rudBack[cnt - 1] : rudFront[cnt - 1]}" style="${values.length == 2?type == "Rear" ? "scale:0.3; " : "scale:0.5":values.length >4 ? "scale:0.5":"scale:0.8"}"/>
                              
                          </label></div>
                       
                          </div>`
              $(`#singleProductImg${cnt}`).append(elements)
           
              type == "Rear" ? cropperShadow(rudBack[cnt - 1], id, `canvas${id}`, 'Rear', count) : cropperShadow(rudFront[cnt - 1], id, `canvas${id}`, 'X-Ray', count);

            }
            var counts = [2, 7, 12, 17, 22,27]
            var size_cnt = 0;
            values.map((count) => {

                console.log("rud{"+count+"}");
                console.log("rud{"+counts[size_cnt]+"}");
              let calrudimg = $(`#${counts[size_cnt] + value.replace(/\s/g, '') + random}`)
              function calliper_val() {
                let caliper = document.getElementById(`caliper${counts[size_cnt]}`)
                let parent = $(`#output${counts[size_cnt]}`);
                let parent2 = $(`#outputoutputSec${counts[size_cnt]}`);
                let jaw = $(`#jaw${counts[size_cnt]}`)
                let input = document.getElementById(`measurement${counts[size_cnt]}`)

                // let value = input.value;
                let value = rudSize[size_cnt];
                // here you can define your own conversion from input to pixels  
                let id = `measurement${counts[size_cnt]}`;

                elementId = id.match(/(\d+)/);
                console.log(`#output${counts[size_cnt]}`)
                if(values.length == 2){
                  calrudimg.css({
                  "width": `${value / 1.5}% `,
                  "min-height": "auto"
                })
                }
                else if(values.length == 3 || values.length == 4){
                  calrudimg.css({
                  "width": `${value / 0.7}% `,
                  "min-height": "auto"
                })
                }
                else if(values.length == 1){
                  calrudimg.css({
                  "width": `${value / 0.9}% `,
                  "min-height": "auto"
                })
                }
                else{
                  if(values.length == 6){
                    calrudimg.css({
                  /*arbin*/
                  "width": `${value / 1.27}% `,
                  "min-height": "auto"
                    }) 
                  }
                  else{
                calrudimg.css({
                  /*arbin*/
                  "width": `${value / 1}% `,
                  "min-height": "auto"
                })
              }
              }
              /*arbin*/
                $(`#rud${parseInt(elementId) + 3} `).css({
                  "width": `${parseInt(value) + (values.length == 1?3:1)}% `
                })
                /*arbin*/
                if(values.length == 2){
                  jaw.css({ "left": `${value / 1.45}% ` })

                }
                else if(values.length == 1){
                  jaw.css({ "left" : `${value / 0.9}% `})
                }
                else if(values.length == 5){
                  jaw.css({"left" : `${value / 1}% `});
                }
                else if(values.length == 6){
                  jaw.css({"left" : `${value / 1.2}% `});
                }
                else{
                  /*arbin*/
                jaw.css({ "left": `${value / 0.65}% ` })
                }
                if (values.length > 2 && values.length < 7) {
                  parent.css({ "padding": "0" })
                }

              }
              calliper_val();
              size_cnt++
            })

          })
      } else {
        null
      }



    })


    if (values.length >= 7) {
      let cnt = 0;
    
        count++
        values.map((value) => {
          cnt++
          count++
          let id = count + value.replace(/\s/g, '') + random 
          elements = ` <div class="products">
          <div><input
                type="file"
                    accept="image/*"
                    name="image"
                    id="${id}Input"
                    onchange="cropperShadow('${id}Input','${id}','canvas${id}','Other','${count}')"
                    style="display: none"
                  />
                  <canvas id="canvas${id}" style="display:none"></canvas> 
                  <label  for="${id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important">
                                        
                      <img id="${id}" class="moreproduct" src="${rudFront[cnt - 1]}" />
                      
                  </label>
                  </div>
                  <!--arbin-->
                  <div contenteditable="true" style="${values.length > 4 && values.length <=10? "font-size:13px;":"font-size:11px;"}text-align:center; ${value.replace(" Mukhi", "M").length <= 8 ? "display: flex; " : ""}
      text - align: center;
      flex - wrap: nowrap;
      align - items: flex - start; "><span style="display: flex; justify - content: center; gap: 2px; align - content: center; align - items: center; ">${value.replace(" Mukhi", "M")}</span><span style="display: flex; justify - content: center; gap: 2px; align - content: center; align - items: center; ">(${[rudSize[cnt - 1]]} mm)</span></div></div>`

          $(`#singleProductImg1`).append(elements)
        })
    }
    $('#rudraksha-faces').text(faces)
    var rowrepeat;
    var imgwidth;
    var labelheight;
    if (values.length == 2) {
      rowrepeat = 1
      labelscale = "1"
      labelheight = "108px"
      imgwidth = "100%"
    } else if (values.length >= 3 && values.length <= 8) {
      repeat = 2
      labelscale = "0.8"
      labelheight = "107px"
      $(".product-image").css({ "margin-bottom": "-7%" })
      $(".product-label").css({ "scale": "1.1", "margin-bottom": "-5%" })
    } 
    // else if (values.length >= 5 && values.length <= 6) {
    //   labelheight = "106.8px"
    //   repeat = 3

    //   labelscale = "0.63"
    //   $(".product-image").css({ "margin-top": "-14%" })
    //   $(".product-label").css({ "scale": "1", "margin-top": "-17%" })
    //   $(".top-header").css("margin-top", "-2%")
    //   $(".products-img").css("row-gap", "4px")
    //   $(".irl-note").css({ "bottom": "0.05cm" })

    // }
    //arbin
     else if (values.length >= 5 && values.length <= 10) {
      labelscale = "1.8"
    }
    else if(values.length >10 && values.length <=17){
      labelscale="1.6"
    }
    else if (values.length > 18 && values.length <= 20) {
      labelscale = "1.6"
    } else {
      labelheight = "220px"
      // arbin
      labelscale = "0.9"
      imgwidth = "100%"
      $(".product-label").css({ "translate": "0" })

    }
    if (values.length == 1 || values.length > 8) {
      $('#productsImg').css("grid-template-columns", `repeat(1,1fr)`)
      $('#productsImg2').css("grid-template-columns", `repeat(1,1fr)`)
    } else {
      $('#productsImg').css({
        "grid-template-columns": `repeat(2,1fr)`,
        "grid-template-rows": `repeat(${rowrepeat},1fr)`
      })
      $('#productsImg2').css({
        "grid-template-columns": `repeat(2,1fr)`,
        "grid-template-rows": `repeat(${rowrepeat},1fr)`
      })
    }
    if(values.length == 5){
      $(".product-image").css({ "height": "60px" });
    }
    else if(values.length == 6){
      $(".product-image").css({ "height": "50px" });
    }
    else{
    $(".product-image").css({ "height": labelheight })
    }
    $("#productsImg").css({ "translate": ` ${values.length > 2 ? values.length > 6 ? "0% 0%" : "0% -2%" : "0% -5%"}` })
    $("#productsImg2").css({ "translate": ` ${values.length > 2 ? values.length > 6 ? "0% 0%" : "0% -2%" : "0% -5%"}` })
    //arbin
    if(values.length >4){
      $('#productsImg label').css({
      
      "height": "100%",
      "scale": labelscale,
      // "overflow": "hidden"
    })
    }
    else{
    $('#productsImg label').css({
      
      "height": `calc(${labelheight} - 4px`,
      "scale": labelscale,
      // "overflow": "hidden"
    })
  }
    $('#productsImg2 label').css({
      "height": `calc(${labelheight} - 4px`,
      "scale": labelscale,
      // "overflow": "hidden"
    })
    $('#productsImg .products label').css({
      "height": imgWidth,
      "width": imgWidth,

      // "overflow": "hidden"
    })
    $('#productsImg2 .products label').css({
      "height": imgWidth,
      "width": imgWidth,

      // "overflow": "hidden"
    })
    // $('#productsImg img').css({
    //   "width": "auto",
    //   "height": imgwidth
    // })
    // $('#productsImg .products label img').css({
    //   "width": "auto",
    //   "height": "85%"
    // })

    // $(`.caliper img`).css({
    //     "width": "auto",
    //     "height": "auto"
    // })

    //set the length and weight of the rudraksha

    $("#rudSize").text(rudSize.toString() + " mm")
    $("#rudWeight").text(rudWght.toString() + " gms")

    if (values.length > 8) {
      //set the length and weight of the rudraksha when products are more than 6

      var total_wght = 0;
      var rudWghtUse = '';
      rudWght.map((wght) => {
        total_wght = total_wght + parseInt(wght)
      })
      $("#rudWeight").text(total_wght + " mm")
      $("#rudSize").text(rudGrade)

      // Get the input value from calliper and automate the value in Rudraksha Size
      //arbin
      $("#rudraksha-faces").text("All Natural Faces")
      $(`#singleProductImg1`).css("padding", "0 5px")

      $("#productsImg").append(`<style>
      img.moreproduct {
        max-width: 50px!important;
        height:auto!important;
        max-height: 50px!important;
      }
      </style>`)

    }

    // <!-- For Cropping Image and adding shadow to images for making it look real  -->    

    function cropperShadow(cropInput, cropImage, cropCanvas, type, counter) {
      console.log("error" + cropImage)
      let croppedCanvas = document.getElementById(cropCanvas)
      let croppedImage = document.getElementById(cropImage)
      document.getElementById(cropImage).style.display = 'block'

      const counterArry = ["2", "5", "7", "10", "12", "15", "17", "20", "22", "25", "27", "30"]
      // if (!counterArry.includes(counter)) {
      //   document.getElementById(`upload-msg${counter}`).style.display = 'none'
      // }

      // let file = fileInput.files[0];
      // let reader = new FileReader();

      // reader.addEventListener('load', () => {
      const img = new Image();
      // img.src = reader.result;
      img.src = croppedImage.src;
      console.log(img.src)


      img.addEventListener('load', () => {
        // Create a canvas element
        const canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        const ctx = canvas.getContext('2d');

        // Draw the image onto the canvas
        ctx.drawImage(img, 0, 0, img.width, img.height);

        // Get the image data
        const imageData = ctx.getImageData(0, 0, img.width, img.height);
        const pixels = imageData.data;

        // Find the boundaries of the non-transparent pixels
        let left = img.width;
        let right = 0;
        let top = img.height;
        let bottom = 0;

        for (let y = 0; y < img.height; y++) {
          for (let x = 0; x < img.width; x++) {
            const i = (y * img.width + x) * 4;
            const alpha = pixels[i + 3];
            if (alpha > 0) {
              left = Math.min(left, x);
              right = Math.max(right, x);
              top = Math.min(top, y);
              bottom = Math.max(bottom, y);
            }
          }
        }

        // Crop the image to the non-transparent portion
        if (type != "Weight") {
          const croppedWidth = right - left;
          const croppedHeight = bottom - top;
          croppedCanvas.width = croppedWidth;
          croppedCanvas.height = croppedHeight;
          const croppedCtx = croppedCanvas.getContext('2d');
          croppedCtx.drawImage(img, left, top, croppedWidth, croppedHeight, 0, 0, croppedWidth, croppedHeight);
        } else {

          const croppedWidth = right - left;
          const croppedHeight = bottom - top;
          croppedCanvas.width = croppedWidth;
          croppedCanvas.height = croppedHeight;
          const croppedCtx = croppedCanvas.getContext('2d');
          // Apply drop shadow to the canvas
          croppedCtx.shadowOffsetX = 15;
          croppedCtx.shadowOffsetY = 15;
          croppedCtx.shadowBlur = 25;
          croppedCtx.shadowColor = 'rgba(112,112,112,1)';
          croppedCtx.drawImage(img, left, top, croppedWidth + 35, croppedHeight + 25, 0, 0, croppedWidth, croppedHeight);
        }

        ctx.shadowBlur = 15;
        ctx.shadowColor = 'red';

        // Update the image element
        croppedImage.src = croppedCanvas.toDataURL();



      });

      // });

      // reader.readAsDataURL(file);
    }


    console.log(elementId)
  </script>
  <style>
    div[style="font-size:10px; text-align:center"] {
      scale: 1.1;
    }
  </style>
  <script>
    let section = document.getElementById("sectionEdit");
if(values.length == 2){
  section.style.marginTop="100px";
  console.log("it is true");
}
  </script>

</html>