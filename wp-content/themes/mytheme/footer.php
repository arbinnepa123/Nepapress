


<script>
    function generatePDF(size) {
        var opt = {
            margin: 0,
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { dpi:900, scale: 3 },
            jsPDF:        { unit: 'mm', format: size, orientation: 'landscape' }
        };
        var element = document.getElementById('mad');
        html2pdf().from(element).set(opt).toPdf().get('pdf').then(function(pdf) {
            pdf.save()
        });
    }
</script> 

   <?php wp_footer(); ?>
</body>
</html>