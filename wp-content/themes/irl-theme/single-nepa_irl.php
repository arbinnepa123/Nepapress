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
  </script>
</head>
<body>
  <!-- Nepa_id -->
  <!-- /* Pop up / alert Box / Model box  */ -->
  <div id="Nepa_alert-body">
    <div id="alert">
      <p id="Nepa_alert-msg"> Welcome to the tutorialsPoint! </p>
      <button class="Nepa_closePopup" id="Nepa_PopupBtn1"> Add value to origin</button>
      <button class="Nepa_closePopup" id="Nepa_PopupBtn2"> Replace value to origin</button>
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
            <div class="Nepa_box">

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
            <span class="Nepa_extra2"><span  id="Nepa_product"></span></span>
            <span class="Nepa_form-text">Size:</span>
            <span class="Nepa_section2_common" ><span id="Nepa_size"></span></span>
            <span class="Nepa_form-text">Weight:</span>
            <span class="Nepa_section2_common">
            <span  id="Nepa_weight"></span>
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
        <div class="Nepa_section1_bottom">
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
      <div class="Nepa2_section2">
        <div class="Nepa_top_right Nepa_common">
          <div class="Nepa_right_container">
            <?php
            if (!empty($image_url)) {
              echo '<div class="Nepa_top_image" id="Nepatopimage">
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
                      <img class="Nepa_img_main" src="' . $image_url2 . '"  alt="">
                      </div>
                      <div class="Nepa_image_label">
                        
                      <div class="Nepa_image_label_first">' . $COA["imglabel"] . '</div>
                      <div class="Nepa_image_label_second">' . $COA["imglabel2"] . '</div>';
              } else if (empty($image_url)) {
                echo ' 
                        <div class="Nepa_sec_page Nepa_section" id = "NepasectionEdit" style="${values.length > 4?"height:100%;":""}">
                        <div class="Nepa_products_img" id="NepaproductsImg" >

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

  <button onclick='Nepa_generatePDF("a5","mad2")' style="margin:0 auto; padding:15px;background-color:red;color:white;font-size:arial;" class="Nepa_generatepdf">Generate Pdf Print</button>
    <button onclick='Nepa_generatePrintPDF("a5","mad2")' style="margin:0 auto;padding:15px;background-color:red;color:white;font-size:arial;" class="Nepa_generatepdf">Generate Pdf</button>

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
    function Nepa_generatePDF(Size, head_element) {
        $("input[type='text']").css({ "border-bottom": "none", "outline": "none" })
        $("textarea").css({ "border": "none", "color": "#2F48A4" })
        $(".scale-input").css({ "Background": "none" })
        // $(".Nepa_Container").css({ "Background":"none" })
        // $(".box").css({ "Background":"none" })
        // $(".Nepa_top-right").css({ "Background":"none" })
        let firstcontain = document.getElementsByClassName("Nepa_Container");
        let secondcontain = document.getElementsByClassName("Nepa_box");
        let thirdcontain = document.getElementsByClassName("Nepa_top_right");
        let forthcontain = document.getElementsByClassName("Nepa_fixed_top");
        let fifthcontain = document.getElementsByClassName("Nepa_hr");
        let sixthcontain = document.getElementsByClassName("Nepa_top-left");
        let seventhcontain = document.getElementsByClassName("Nepa_section1_bottom");
        let eighthcontain = document.getElementsByClassName("Nepa_form-text");
        let ninthcontain = document.getElementsByClassName("Nepa_extra");
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
    function Nepa_generatePrintPDF(Size, head_element)
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
    $("#NepaproductsImg").empty();
    //modified arbin
    $("#productsImg2").empty();

    let Nepa_nonJhapacnt = 0;
    let Nepa_nonKajucnt = 0;
    let Nepa_startPop = 1;
    var Nepa_rudTested = ''
    var Nepa_rudSizeUse = ''
    var Nepa_rudWghtUse = ''
    let Nepa_valueTest = [];
    let Nepa_indexStoreStart = 0;
    let Nepa_indexStoreEnd = 0;
    let Nepa_lasti;
    for(let i = 0;i<values.length;i++){
      Nepa_valueTest[i] = parseInt(values[i].replace(" Mukhi","0"));
      console.log("hello "+ Nepa_valueTest[i]);
    }
    let j = 0;
    for(let i = 0;i<Nepa_valueTest.length;i++){
      if(i == 0){
        j = (i+2)*10;
      }
      else if(j == Nepa_valueTest[i]){
        Nepa_indexStoreEnd = i;
        j = (i+2) * 10;
      }
      else{
        Nepa_lasti = i;
       break;
      }
    }
    //Nepa weight section
    if(values.length > 6){
      let Nepa2_sgrade = document.getElementById('Nepa_weight')
    let sum = 0;
    for(let i = 0 ;i<rudSize.length;i++){
        sum += parseFloat(rudWght[i]);
    }
      Nepa2_sgrade.innerHTML = sum.toFixed(2) + " gms"

 
    }
    else
    {
    rudWght.map((Nepa_wghtUse) => {

      if (Nepa_rudWghtUse) {
        Nepa_rudWghtUse = Nepa_rudWghtUse + ' | ' + (parseFloat(Nepa_wghtUse).toFixed(2)).toString();
      }
      else {
        Nepa_rudWghtUse = Nepa_rudWghtUse + (parseFloat(Nepa_wghtUse).toFixed(2)).toString()
      }
      let rweight = document.getElementById('Nepa_weight')
      rweight.innerHTML = Nepa_rudWghtUse + " gms"
    })
  }
  if(values.length > 6){
    let Nepa2_rSize = document.getElementById('Nepa_size')
      Nepa2_rSize.innerHTML = rudGrade;
    }
    else{
    //Nepa size section
    rudSize.map((Nepa_rSize) => {
      //size nepa
      if (Nepa_rudSizeUse) {
        Nepa_rudSizeUse = Nepa_rudSizeUse + ' | ' + Nepa_rSize
      }
      else {
        Nepa_rudSizeUse = Nepa_rudSizeUse + Nepa_rSize
      }

      let Nepa2_sgrade = document.getElementById('Nepa_size')
      Nepa2_sgrade.innerHTML = Nepa_rudSizeUse + " mm"
    })
  }
    console.log("hello" + Nepa_indexStoreEnd);
    if(Nepa_indexStoreEnd != 0){
      console.log("index is active");
      let Nepa_rudTested = '('  + values[Nepa_indexStoreStart].replace(" Mukhi", "M") +' - ' + values[Nepa_indexStoreEnd].replace(" Mukhi", "M") + ')';
      let Nepa_product = document.getElementById("Nepa_product");
      Nepa_product.innerHTML = Nepa_rudTested + " - " + rudGrade;
        let k = Nepa_lasti;
        console.log(k + '\n');
        for(k;k<=values.length;k++){
          console.log(k + '\n');
          if(typeof(values[k]) === 'undefined'){
            console.log("break");
            break;
          }
          Nepa_rudTested = Nepa_rudTested + ' | ' + values[k].replace(" Mukhi", "M");
          Nepa_product.innerHTML = Nepa_rudTested;
        }
    }
    else{
    //Nepa Product section
    values.map((Nepa_value) => {
      // let intUse = Integer.parseInt(wghtUse);
      // Replace "Mukhi" with "M" so that while selecting the multiple values, Rudraksha Tested field occupies less space   
   
      if (Nepa_rudTested) {
        Nepa_rudTested = Nepa_rudTested + ' | ' + Nepa_value.replace(" Mukhi", "M")
      }
      else {
        Nepa_rudTested = Nepa_rudTested + Nepa_value.replace(" Mukhi", "M")
      }

      let Nepa_product = document.getElementById("Nepa_product");
      let Nepa_showGrade = " -" + rudGrade;
      Nepa_product.innerHTML = Nepa_rudTested + (values.length <= 6?Nepa_showGrade:"");

      if (!Nepa_value.includes("Japa")) {
        Nepa_nonJhapacnt++
      }

      if (!Nepa_value.includes("Kaju")) {
        Nepa_nonKajucnt++
      }

    })
  }

    // To set the origin to Indonsian if japa mala is selected  and give a choice of India or Nepal after the Kaju is selected.
    // below code automatically adds Indonesia if jhapa mala is selected whereas it generates a popup with options if kaju is selected.  


    if (Nepa_rudTested.includes("Japa") || Nepa_rudTested.includes("Kaju")) {
      // To set the origin to Indonsian if japa mala is selected    
      if (Nepa_rudTested.includes("Japa")) {
        if (Nepa_nonJhapacnt == 0) {
          Nepa_originRudra = ["Indonesia"]
        }
        else {
          if (!Nepa_originRudra.includes("Indonesia")) {
            Nepa_originRudra.push("Indonesia")
          }
          if (!Nepa_originRudra.includes("Nepal") && Nepa_rudTested.includes("Kaju") && values.length >= 2) {   // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected. 
            Nepa_originRudra.unshift("Nepal")
          }
          else if (!Nepa_originRudra.includes("Nepal") && !Nepa_rudTested.includes("Kaju") && values.length >= 2) {   // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected.
            Nepa_originRudra.unshift("Nepal")
          }
          if (Nepa_originRudra.includes("Nepal") && Nepa_rudTested.includes("Kaju") && values.length == 2) {  // This checks if the origin Nepal is present or  while kaju & japa  are selected only selected and removes the Nepal
            Nepa_originRudra.shift("Nepal")
          }
        }
      }
      else {
        if (Nepa_originRudra.includes("Indonesia")) {
          Nepa_originRudra.splice(Nepa_originRudra.indexOf("Indonesia"), 1)
        }
      }


      // To set the origin to India/Nepal When Kaju is selected
      //
      if (Nepa_rudTested.includes("Kaju")) {
        function Nepa_addIndia(Nepa_count) {
          if (Nepa_count == 0) {
            Nepa_originRudra = ["India(1M Kaju)"]
          }
          else {
            if (!Nepa_originRudra.includes("India(1M Kaju)")) {
              //Avoid the push of "India(1M Kaju)" to originRudra arry, this prevents the duplication of value in Rudraksha Origin field after the kaju is selected
              Nepa_originRudra.push("India(1M Kaju)")
            }
          }
          $("#rudOrigin").text(Nepa_originRudra)
          document.getElementById("Nepa_alert-body").style.display = "none";
        }
        function Nepa_popupAlert() {
          document.getElementById("Nepa_alert-body").style.display = "flex";
        }
        function Nepa_closepopup() {
          document.getElementById("Nepa_alert-body").style.display = "none";

        }

        if (Nepa_stopPop == 0) {
          document.getElementById("Nepa_alert-msg").innerText = `Select the Origin of the 1 Mukhi Kaju Rudraksha`;
          $("#Nepa_PopupBtn1").text("India").click(() => Nepa_addIndia(Nepa_nonKajucnt))
          $("#Nepa_PopupBtn2").text("Nepal").click(() => Nepa_closepopup())
          Nepa_popupAlert()
        }
        Nepa_stopPop = 1;
      }
      else {
        Nepa_stopPop = 0
        if (Nepa_originRudra.includes("India(1M Kaju)")) {
          Nepa_originRudra.splice(Nepa_originRudra.indexOf("India(1M Kaju)"), 1)
        }
        if (!Nepa_originRudra.includes("Nepal") && Nepa_rudTested.includes("Japa") && values.length >= 2) {
          // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected. 
          Nepa_originRudra.unshift("Nepal")
        }
        else if (!Nepa_originRudra.includes("Nepal") && !Nepa_rudTested.includes("Japa") && values.length >= 2) {
          // This checks if the origin Nepal is present or not while kaju, japa and other rudraksha are selected.
          Nepa_originRudra.unshift("Nepal")
        }
        if (Nepa_originRudra.includes("Nepal") && Nepa_rudTested.includes("Japa") && values.length == 2) {
          // This checks if the origin Nepal is present or  while kaju & japa  are selected only selected and removes the Nepal
          Nepa_originRudra.shift("Nepal")
        }
        $("#rudOrigin").text(Nepa_originRudra)
      }
    }
    else {
      Nepa_stopPop = 0
      Nepa_originRudra = ["Nepal"]
    }
    $("#Nepa_rudTested").text(Nepa_rudTested)
    $("#rudOrigin").text(Nepa_originRudra)

    // End of the automation for Rudraksha origin field

    // to get the no of faces of rudraksha and populate the input box of number of faces
    let Nepa_faces = ''
    let Nepa_count = 0 //for productImg
    let Nepa_cnt = 0 //for singleProduct image
    let Nepa_openParent = ''
    let Nepa_openParent2 = ''
    let Nepa_gridColn = 0; // to make the product images sit in the grid 
    var Nepa_columns;
    var Nepa_rows;
    let Nepa_elements = "";
    var Nepa_imgWidth;
    var Nepa_random = Math.floor((Math.random() * 1000) + 1)

    values.map((Nepa_value) => {
      Nepa_cnt++
      Nepa_gridColn++
      if (Nepa_gridColn == 3) {
        Nepa_gridColn = Nepa_gridColn / 3;
      }


      if (values.length == 1) {
        Nepa_openParent = `<div id="Nepa_singleProductImg${Nepa_cnt}" class="Nepa_products" style="grid-column:1/-1; display: grid; grid-template-columns: 1fr 1fr;">`

        $(`#Nepa_singleProductImg${Nepa_cnt}`).empty();
        //arbin
        $(`#singleProductImg2${Nepa_cnt}`).empty();
        $('#NepaproductsImg').append(Nepa_openParent)
        $('#productsImg2').append(Nepa_openParent2)
      }
      else if (values.length == 2) {
        Nepa_openParent = `<div id="Nepa_singleProductImg${Nepa_cnt}" class="Nepa_products" style="grid-column:1/span 2; display: grid; grid-template-columns: 1fr 1fr;">`
        $(`#Nepa_singleProductImg${Nepa_cnt}`).empty();
        $('#NepaproductsImg').append(Nepa_openParent)
      }
      else if (values.length >= 7) {
        if (values.length >= 19) {
          Nepa_columns = "repeat(4,1fr)"
          Nepa_rows = "repeat(4,1fr)"
          Nepa_imgWidth = "53px"
        } 
        else if(values.length > 10){
          Nepa_columns = "repeat(3,1fr)"
          Nepa_rows = "repeat(3,1fr)"
          Nepa_imgWidth = "68px"
        }
        else {
          Nepa_columns = "repeat(2,1fr)"
          Nepa_rows = "repeat(3,1fr)"
          Nepa_imgWidth = "85px"
        }
        if (Nepa_cnt <= 2) {
          Nepa_openParent = `<div  id="Nepa_singleProductImg${Nepa_cnt}" class="Nepa_products" style="grid-column:${Nepa_gridColn}/${Nepa_gridColn + 1}; display: grid; grid-template-columns: ${Nepa_columns}; grid-template-rows: ${Nepa_rows};">`

          $('#NepaproductsImg').css({
            "grid-template-colums": "1fr 1fr"
          })
       

          $('.Nepa_sec_page').css("justify-content", "flex-start")
          $(`#Nepa_singleProductImg${Nepa_cnt}`).empty();

          $('#NepaproductsImg').append(Nepa_openParent)
      
        }
      } 
      //arbin
      if(values.length >4 && values.length <7){
        Nepa_openParent = `<div  id="Nepa_singleProductImg${Nepa_cnt}"  class="Nepa_products" style="${values.length > 4 && values.length < 7?"border-bottom:solid 1px #D2691E;padding-bottom:10px;":""} grid-column:1/4; display: grid; grid-template-columns:repeat(4,1fr);">`

$(`#Nepa_singleProductImg${Nepa_cnt}`).empty();
$('#NepaproductsImg').append(Nepa_openParent)
      }
      else {
        Nepa_openParent = `<div  id="Nepa_singleProductImg${Nepa_cnt}" class="Nepa_products" style="grid-column:${Nepa_gridColn}/${Nepa_gridColn + 1}; display: grid; grid-template-columns: 1fr 1fr;">`

        $(`#Nepa_singleProductImg${Nepa_cnt}`).empty();
        $('#NepaproductsImg').append(Nepa_openParent)
      }
      Nepa_count++



      Nepa_face = Nepa_value.match(/\d+/g);
      if (Nepa_face) {
        Nepa_faces ? Nepa_faces = Nepa_faces + ',' + Nepa_face : Nepa_faces = Nepa_face[0];
      }
      Nepa_imageTypes = ['Front', 'Rear', 'X-Ray', 'Weight']
      if (values.length <= 6) {
        let Nepa_leftRudBead = 0;
     
        // let prdImgCnt=0;
        Nepa_imageTypes.map(
          (Nepa_type) => {
            Nepa_count++
            let Nepa_id = Nepa_count + Nepa_value.replace(/\s/g, '') + Nepa_random
            var frontid = ''

            frontid = `measurement2`
            if (Nepa_count == 2 || Nepa_count == 7 || Nepa_count == 10 || Nepa_count == 14 || Nepa_count == 22 || Nepa_count == 27) {
              rud = `measurement${Nepa_count}`
            }
            if (Nepa_type == 'Front') {
              if(values.length == 1){
                Nepa_leftRudBead = 18;
                BottomRudBead = 16;
              }
              else if(values.length == 2)
              {
               Nepa_leftRudBead = 11.5;
               BottomRudBead = 16;
             }
             else if(values.length == 3  || values.length == 4){
              Nepa_leftRudBead = 25;
              BottomRudBead = 16;
             }
             else if(values.length == 6){
              Nepa_leftRudBead = 13.9;
              BottomRudBead=0;
             }
             else if(values.length >4 && values.length <7){
              Nepa_leftRudBead = 16;
              BottomRudBead = 0;
             }

             
              Nepa_elements = ` 
                      <div style="position:relative; ">
                      <div class="product-label" style="${values.length == 3  || values.length == 4?"font-size:9px;":"font-size:10px;"}text-align:center">
                        <span>${Nepa_value} </span>(${Nepa_value != "Kantha Mala" ? Nepa_value != "Japa Mala" ? Nepa_type == "Front"? "Size":"": "Avg. Bead Size" : "Avg. Bead Size"})
                      </div>
                      <!--arbin-->
                      <div class="Nepa_product-image caliper-section" style=${values.length == 1?"border-top-style:solid;border-top-width:1px;border-top-color:#D2691E;border-right-style:solid;border-right-width:1px;border-right-color:#D2691E;":""} >
                        
                        <canvas id="${Nepa_id}-canvas" style="display:none"></canvas>          
                        <label for="${Nepa_id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important; ${values.length == 3 || values.length ==  4 || values.length == 1?"justify-content: flex-start;":"justify-content:flex-end;"}"><!--arbin-->
                          <div id="caliper${Nepa_count}" class="caliper">
                           
                            <img id="vernier-scale${Nepa_count}" src="../../wp-content/themes/irl-theme/calliper/calliper_head.png" />
                            <div class="moveable-jaw" style="z-index: 1000;">
                              <img src="${rudFront[Nepa_cnt - 1]}" id="${Nepa_id}" class="img-${Nepa_type} front-caliper-img" style=" position: absolute;left:${Nepa_leftRudBead}%;bottom:${BottomRudBead}%;" >
                              <img id="jaw${Nepa_count}" style="left: 0%; " src="../../wp-content/themes/irl-theme/calliper/jam.png" />
                              <div id="output${Nepa_count}"></div>
                              <div id="outputoutputSec${Nepa_count}"></div>
                              </div>
                            </div>                              
                        </label>
                      </div>
                  
                      </div>

                      <style>
                      #caliper${Nepa_count} {
                        width: 80%;
                        height: 85%;
                        position: relative;
                        user-select: none;
                      }
                      .generated::after {
                          content: none;
                      }

                      #main-scale${Nepa_count} {
                        width: 120%;
                        height: 20.5%;
                        position: absolute;
                        top: 27.2%;
                        background: url(../../wp-content/themes/irl-theme/calliper/scale1.png);
                        background-size: contain;
                        background-repeat: no-repeat;
                      }
                      /* arbin*/
                      #vernier-scale${Nepa_count} {
                      /*  left:${values.length == 1?0:32}px;*/
                        top:${values.length == 1?42:values.length > 4?0:8}px;
                        height: ${values.length == 1?60:values.length > 4?100:80}%;
                        position: absolute;
                        z-index: 999;
                      }

                      #jaw${Nepa_count} {
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

                      #caliper${Nepa_count} input {
                        position: absolute;
                        bottom: -20px;
                        width: 80%;
                      }

                      div#output${Nepa_count} {
                        
                        position: absolute;
                        top: ${values.length >4?23:values.length == 1?40:0}%;
                          left:${values.length > 4?54:values.length ==1?105.5:50}%;
                        height: ${values.length > 4?15:values.length==2?12:9.5}%;
                        width: 44.44%;
                        z-index: 99999999;
                      } 
                        </style>
                        `
              $(`#Nepa_singleProductImg${Nepa_cnt}`).append(Nepa_elements)
              cropperShadow(rudFront[Nepa_cnt - 1], Nepa_id, `${Nepa_id}-canvas`, 'Front', Nepa_count);
              var caliper = document.getElementById(`caliper${Nepa_count}`)
              var parent = document.getElementById(`output${Nepa_count}`);
              var parent2 = document.getElementById(`outputoutputSec${Nepa_count}`);
              var jaw = document.getElementById(`jaw${Nepa_count}`)
              var input = document.getElementById(`measurement${Nepa_count}`)

              var calimg = $(`#${Nepa_id}`)
              jaw.style.left = '0'

              var jawLeft = 0
              var mouseX = 0


              // this is to display the number on  calliper display 
              const displayNum = (Nepa_value) => {

                while (parent.firstChild) {
                  parent.removeChild(parent.firstChild);
                }
                var counter = 0;
                var numberString = Nepa_value.toString();
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
                  var numbers = Nepa_value.toString();
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
                  parent.style.left = Nepa_value / 1.7 + 40.5 + '%'
                  parent.style.top = "43.38%";
                } else {
                  
                  // parent.style.left = value / 0.9 + 32 + '%'
                  if (values.length == 2) {
                    console.log("checkpoint");
                    parent.style.left = Nepa_value / 1.7 + 19.5 + '%'
                    parent.style.top = "30.98%";
                  }
                  else if (values.length == 3 || values.length == 4) {
                    
                    // if(value >= 24 && value <=26){
                    //     trigger = 2;
                    // }
                    // else if(value >26 && value < 30){
                    //   trigger = 5;
                    // }
                 
                      
                      if(Nepa_value >=8 && Nepa_value <10){
                        trigger =-8;
                        trigger = (Nepa_value - triggerPoint)+trigger;
                      }
                      else{
                      if(Nepa_value > triggerPoint){
                       
                        trigger = -13;
                        trigger = (Nepa_value - triggerPoint)+ (Nepa_value>40?-13.9:trigger);
                      }
                    }
                  
                    parent.style.left = Nepa_value / 1.6 + (70.5 + trigger) + '%'
                    parent.style.top = "31.48%";
                  }
                  else if(values.length >4){
                    if(Nepa_value >=8 && Nepa_value <10){
                    trigger = (Nepa_value - triggerPoint)-1;
                    }
                    else{
                    //   trigger = -2;
                    //  triggerPoint =10;
                    //   trigger =trigger-(value-triggerPoint);
                    }
                    parent.style.left = Nepa_value / 1.6 + (40.5 + (Nepa_value>=10 && Nepa_value <17?-3:Nepa_value>=17 && Nepa_value<23?-0.5:Nepa_value>=23 && Nepa_value <30?2:Nepa_value >=30 && Nepa_value < 36?4:Nepa_value >=36 && Nepa_value < 41?6:Nepa_value>=41 && Nepa_value <47?8:Nepa_value >=47?10:trigger)) + '%';
                    parent.style.top = "23.48%";
                  }

        
                }
              // });
                // console.log("parent 2 ko test" + parent2)
                parent2.style.left = Nepa_value / 0.9 + 27.5 + '%'

                if (numberArray.length <= 1) {
                  parent.style.paddingLeft = "13%";
                }
                if (numberArray.length > 1) {
                  parent.style.paddingLeft = "6.5%";
                }
              }

              displayNum(rudSize[Nepa_cnt - 1]);


            } else if (Nepa_type == 'Weight') {
              let checkJapa = Nepa_value.includes("Japa Mala")
              Nepa_elements = ` 
                        <div style="position:relative;">
                        <div class="product-label" style="${values.length == 3  || values.length == 4?"font-size:9px;":"font-size:10px;"} text-align:center">
                                <span>${Nepa_value}</span>(${Nepa_value != "Kantha Mala" ? Nepa_value != "Japa Mala" ? Nepa_type : "Weight" : "Avg. Bead Wt."})
                                </div>
                          <div class="Nepa_product-image" style="${values.length == 1?"border-top:solid 1px #D2691E;":values.length >4?"":"border-bottom:solid 1px #D2691E;"}">
                            
                              <canvas id="rud-canvas${Nepa_count}" style="display:none"></canvas> 
                              <label for="${Nepa_id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important; justify-content: center; ">
                              <div class="moveable-jaw" style="display:flex; width:auto; ">
                              <!--arbin-->
                            ${checkJapa ? `<img id="weight${Nepa_count}" style="left: 0%;" ${values.length == 1?"height=80px width=150px":values.length > 4?"height=40px width=80px":"height=60px width=120px"} src="../../wp-content/themes/irl-theme/" />
                      <img id="rud${Nepa_count}" class="japa-weight" src style=" position: absolute; height: 100%!important; min-height:auto;" height="80px" width="150px"/>` : `<img id="weight${Nepa_count}" style="left: 0%;" src="../../wp-content/themes/irl-theme/weight/weight.png"${values.length == 1?"height=80px width=150px":values.length > 4?"height=40px width=80px":values.length == 3 || values.length ==4?"height=60px width=100px":"height=60px width=120px"} />
                      <img id="rud${Nepa_count}" class="rudrakshaWeight" src="${rudFront[Nepa_cnt - 1]}" style=" position: absolute; height: auto; min-height:auto;"/>
                      <div id="output${Nepa_count}" style="position: absolute; left: 21px; bottom: 12px;"></div>
                      <div id="outputSec${Nepa_count}"></div>`}
                                </div>
                                <input style="display:none;" placeholder="00.00" maxlength="5" type="text" value="${rudWght[Nepa_cnt - 1]}" id="wghtmeasurement${Nepa_count}" class="weight-input hide-on-pdf" style="scale:1.2; position: absolute; background-color: coral!important; top:3px; border:1px solid coral; left: 50%; translate: -50%; width: 30px; " />
                                </label>
                                </div>
                            
                                </div>`


              var element_style = `
                                <style>
                                #output${Nepa_count}{
    
                                  top:${values.length == 1?38:values.length >4?28:30.9}%;
                                  height: ${values.length == 1?5.5:values.length > 4?10:8.8}%!important;
                                  display: flex;
                                  min-height: auto;
                                  left: ${values.length == 1?75.1:75.2}%!important;
                                  align-items: center;
                                  bottom: 8.3%!important;
                                }
                                #output${Nepa_count} img{
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


              $(`#Nepa_singleProductImg${Nepa_cnt}`).append(Nepa_elements)
              $(`#Nepa_singleProductImg${Nepa_cnt}`).append(element_style)
           
              if (!checkJapa) {
                cropperShadow(rudWght[Nepa_cnt - 1], `rud${Nepa_count}`, `rud-canvas${Nepa_count}`, 'Weight', Nepa_count);
                var wghtparent = document.getElementById(`output${Nepa_count}`);
                var wghtparent2 = document.getElementById(`outputSec${Nepa_count}`);
                var wghtjaw = document.getElementById(`weight${Nepa_count}`)
                var wghtinput = document.getElementById(`wghtmeasurement${Nepa_count}`)
                wghtjaw.style.left = '0'
                var wghtjawLeft = 0





                // this function displays the number on the screen of weigth machine
                const displayNum = (Nepa_value) => {

                  while (wghtparent.firstChild) {
                    wghtparent.removeChild(wghtparent.firstChild);
                  }
                  var counter = 0;
                  var numberString = Nepa_value.toString();
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
                    var numbers = Nepa_value.toString();
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



                  wghtparent.style.left = Nepa_value / 0.9 + 25.25 + '%'

                  if (numberArray.length <= 1) {
                    wghtparent.style.paddingLeft = "10%";
                  }
                  if (numberArray.length > 1) {
                    wghtparent.style.paddingLeft = "7%";
                  }



                }

                function weight_val() {
                  let Nepa_value = wghtinput.Nepa_value
                  displayNum(Nepa_value);
                }
                weight_val();
                wghtinput.addEventListener('change', function () {
                  weight_val();
                  // wghtjaw.style.left =  '50%'
                })
              }
            } else {

              Nepa_elements = ` <div>
              <div class="product-label" style="${values.length == 3  || values.length == 4?"font-size:9px;":"font-size:10px;"} text-align:center">             
                          <span>${Nepa_value} </span>(${Nepa_value == "Kantha Mala" || Nepa_value == "Japa Mala" ? Nepa_type == "Rear" ? "Beads" :"Rear": Nepa_type == "Rear"?"Front":"Rear"})
                          </div>
              <div class="Nepa_product-image" style="${values.length == 1?Nepa_type=="Rear"?"border-top:solid 1px #D2691E;":"border-top:solid 1px #D2691E;border-right:solid 1px #D2691E;":Nepa_type=="Rear"?" ":values.length > 4?"":"border-bottom:solid 1px #D2691E;"}"><input
                        type="file"
                            accept="image/*"
                            name="image"
                            id="${Nepa_id}Input"
                            onchange="cropperShadow('${Nepa_id}Input','${Nepa_id}','canvas${Nepa_id}','Other','${Nepa_count}')"
                            style="display: none"
                          />
                          <canvas id="canvas${Nepa_id}" style="display:none"></canvas> 
                          <label ${Nepa_type == "Rear" ? 'style="scale:0.6; display: flex; justify-content: center;"' : null} for="${Nepa_id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important">
                                                
                              <img id="${Nepa_id}" class="img-${Nepa_type}" src="${Nepa_type == "Rear" ? rudBack[Nepa_cnt - 1] : rudFront[Nepa_cnt - 1]}" style="${values.length == 2?Nepa_type == "Rear" ? "scale:0.3; " : "scale:0.5":values.length >4 ? "scale:0.5":"scale:0.8"}"/>
                              
                          </label></div>
                       
                          </div>`
              $(`#Nepa_singleProductImg${Nepa_cnt}`).append(Nepa_elements)
           
              Nepa_type == "Rear" ? cropperShadow(rudBack[Nepa_cnt - 1], Nepa_id, `canvas${Nepa_id}`, 'Rear', Nepa_count) : cropperShadow(rudFront[Nepa_cnt - 1], Nepa_id, `canvas${Nepa_id}`, 'X-Ray', Nepa_count);

            }
            var counts = [2, 7, 12, 17, 22,27]
            var size_cnt = 0;
            values.map((Nepa_count) => {

                console.log("rud{"+Nepa_count+"}");
                console.log("rud{"+counts[size_cnt]+"}");
              let calrudimg = $(`#${counts[size_cnt] + Nepa_value.replace(/\s/g, '') + Nepa_random}`)
              function calliper_val() {
                let caliper = document.getElementById(`caliper${counts[size_cnt]}`)
                let parent = $(`#output${counts[size_cnt]}`);
                let parent2 = $(`#outputoutputSec${counts[size_cnt]}`);
                let jaw = $(`#jaw${counts[size_cnt]}`)
                let input = document.getElementById(`measurement${counts[size_cnt]}`)

                // let value = input.value;
                let Nepa_value = rudSize[size_cnt];
                // here you can define your own conversion from input to pixels  
                let Nepa_id = `measurement${counts[size_cnt]}`;

                elementId = Nepa_id.match(/(\d+)/);
                console.log(`#output${counts[size_cnt]}`)
                if(values.length == 2){
                  calrudimg.css({
                  "width": `${Nepa_value / 1.5}% `,
                  "min-height": "auto"
                })
                }
                else if(values.length == 3 || values.length == 4){
                  calrudimg.css({
                  "width": `${Nepa_value / 0.7}% `,
                  "min-height": "auto"
                })
                }
                else if(values.length == 1){
                  calrudimg.css({
                  "width": `${Nepa_value / 0.9}% `,
                  "min-height": "auto"
                })
                }
                else{
                  if(values.length == 6){
                    calrudimg.css({
                  /*arbin*/
                  "width": `${Nepa_value / 1.27}% `,
                  "min-height": "auto"
                    }) 
                  }
                  else{
                calrudimg.css({
                  /*arbin*/
                  "width": `${Nepa_value / 1}% `,
                  "min-height": "auto"
                })
              }
              }
              /*arbin*/
                $(`#rud${parseInt(elementId) + 3} `).css({
                  "width": `${parseInt(Nepa_value) + (values.length == 1?3:1)}% `
                })
                /*arbin*/
                if(values.length == 2){
                  jaw.css({ "left": `${Nepa_value / 1.45}% ` })

                }
                else if(values.length == 1){
                  jaw.css({ "left" : `${Nepa_value / 0.9}% `})
                }
                else if(values.length == 5){
                  jaw.css({"left" : `${Nepa_value / 1}% `});
                }
                else if(values.length == 6){
                  jaw.css({"left" : `${Nepa_value / 1.2}% `});
                }
                else{
                  /*arbin*/
                jaw.css({ "left": `${Nepa_value / 0.65}% ` })
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
      let Nepa_cnt = 0;
    
        Nepa_count++
        values.map((Nepa_value) => {
          Nepa_cnt++
          Nepa_count++
          let Nepa_id = Nepa_count + Nepa_value.replace(/\s/g, '') + Nepa_random 
          Nepa_elements = ` <div class="Nepa_products">
          <div><input
                type="file"
                    accept="image/*"
                    name="image"
                    id="${Nepa_id}Input"
                    onchange="cropperShadow('${Nepa_id}Input','${Nepa_id}','canvas${Nepa_id}','Other','${Nepa_count}')"
                    style="display: none"
                  />
                  <canvas id="canvas${Nepa_id}" style="display:none"></canvas> 
                  <label  for="${Nepa_id}Input" style="cursor: pointer; position: relative; display:flex; font-size:10px!important">
                                        
                      <img id="${Nepa_id}" class="moreproduct" src="${rudFront[Nepa_cnt - 1]}" />
                      
                  </label>
                  </div>
                  <!--arbin-->
                  <div contenteditable="true" style="${values.length > 4 && values.length <=10? "font-size:13px;":"font-size:11px;"}text-align:center; ${Nepa_value.replace(" Mukhi", "M").length <= 8 ? "display: flex; " : ""}
      text - align: center;
      flex - wrap: nowrap;
      align - items: flex - start; "><span style="display: flex; justify - content: center; gap: 2px; align - content: center; align - items: center; ">${Nepa_value.replace(" Mukhi", "M")}</span><span style="display: flex; justify - content: center; gap: 2px; align - content: center; align - items: center; ">(${[rudSize[Nepa_cnt - 1]]} mm)</span></div></div>`

          $(`#singleProductImg1`).append(Nepa_elements)
        })
    }
    $('#rudraksha-faces').text(Nepa_faces)
    var rowrepeat;
    var Nepa_imgwidth;
    var labelheight;
    if (values.length == 2) {
      rowrepeat = 1
      labelscale = "1"
      labelheight = "108px"
      Nepa_imgwidth = "100%"
    } else if (values.length >= 3 && values.length <= 8) {
      repeat = 2
      labelscale = "0.8"
      labelheight = "107px"
      $(".Nepa_product-image").css({ "margin-bottom": "-7%" })
      $(".product-label").css({ "scale": "1.1", "margin-bottom": "-5%" })
    } 
    // else if (values.length >= 5 && values.length <= 6) {
    //   labelheight = "106.8px"
    //   repeat = 3

    //   labelscale = "0.63"
    //   $(".Nepa_product-image").css({ "margin-top": "-14%" })
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
      Nepa_imgwidth = "100%"
      $(".product-label").css({ "translate": "0" })

    }
    if (values.length == 1 || values.length > 8) {
      $('#NepaproductsImg').css("grid-template-columns", `repeat(1,1fr)`)
      $('#productsImg2').css("grid-template-columns", `repeat(1,1fr)`)
    } else {
      $('#NepaproductsImg').css({
        "grid-template-columns": `repeat(2,1fr)`,
        "grid-template-rows": `repeat(${rowrepeat},1fr)`
      })
      $('#productsImg2').css({
        "grid-template-columns": `repeat(2,1fr)`,
        "grid-template-rows": `repeat(${rowrepeat},1fr)`
      })
    }
    if(values.length == 5){
      $(".Nepa_product-image").css({ "height": "60px" });
    }
    else if(values.length == 6){
      $(".Nepa_product-image").css({ "height": "50px" });
    }
    else{
    $(".Nepa_product-image").css({ "height": labelheight })
    }
    $("#NepaproductsImg").css({ "translate": ` ${values.length > 2 ? values.length > 6 ? "0% 0%" : "0% -2%" : "0% -5%"}` })
    $("#productsImg2").css({ "translate": ` ${values.length > 2 ? values.length > 6 ? "0% 0%" : "0% -2%" : "0% -5%"}` })
    //arbin
    if(values.length >4){
      $('#NepaproductsImg label').css({
      
      "height": "100%",
      "scale": labelscale,
      // "overflow": "hidden"
    })
    }
    else{
    $('#NepaproductsImg label').css({
      
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
    $('#NepaproductsImg .Nepa_products label').css({
      "height": Nepa_imgWidth,
      "width": Nepa_imgWidth,

      // "overflow": "hidden"
    })
    $('#productsImg2 .Nepa_products label').css({
      "height": Nepa_imgWidth,
      "width": Nepa_imgWidth,

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
      var Nepa_rudWghtUse = '';
      rudWght.map((wght) => {
        total_wght = total_wght + parseInt(wght)
      })
      $("#rudWeight").text(total_wght + " mm")
      $("#rudSize").text(rudGrade)

      // Get the input value from calliper and automate the value in Rudraksha Size
      //arbin
      $("#rudraksha-faces").text("All Natural Faces")
      $(`#singleProductImg1`).css("padding", "0 5px")

      $("#NepaproductsImg").append(`<style>
      img.moreproduct {
        max-width: 50px!important;
        height:auto!important;
        max-height: 50px!important;
      }
      </style>`)

    }

    // <!-- For Cropping Image and adding shadow to images for making it look real  -->    

    function cropperShadow(cropInput, cropImage, cropCanvas, Nepa_type, counter) {
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
        if (Nepa_type != "Weight") {
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
    let section = document.getElementById("NepasectionEdit");
if(values.length == 2){
  section.style.marginTop="100px";
  console.log("it is true");
}
  </script>
</body>
</html>