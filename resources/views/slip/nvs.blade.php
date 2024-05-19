<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>
<style>
    /* styles.css */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff; /* Set background color for printing */
        font-family: "Avenir Next", sans-serif;
    }

    .image-container {
        width: 210mm; /* A4 paper width */
        height: 297mm; /* A4 paper height */
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a slight shadow for visual separation */
        position: relative; /* Needed for absolute positioning of text and photos */
    }

    .image-container img {
        max-width: 100%;
        max-height: 100%;
    }

    .image-content {
        position: absolute;
        top: 99px;
        left: 15px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border-radius: 5px;
    }

    .barcode {
        position: absolute;
        top: 239px;
        left: 498px;
        padding: 10px;
        border-radius: 5px;
    }

    .phone {
        position: absolute;
        top: 373px;
        left: 490px;
        padding: 10px;
        border-radius: 5px;
    }

    .lastname {
        position: absolute;
        top: 238px;
        left: 320px;
        padding: 10px;
        border-radius: 5px;
    }

    .firstname {
        position: absolute;
        top: 278px;
        left: 320px;
        padding: 10px;
        border-radius: 5px;
    }

    .dob {
        position: absolute;
        top: 313px;
        left: 320px;
        padding: 10px;
        border-radius: 5px;
    }

    .nin {
        position: absolute;
        top: 366px;
        left: 327px;
        padding: 10px;
        border-radius: 5px;
    }


    .tracking {
        position: absolute;
        top: 210px;
        left: 490px;
        padding: 10px;
        border-radius: 5px;
    }
    .gender {
        position: absolute;
        top: 445px;
        left: 490px;
        padding: 10px;
        border-radius: 5px;
    }
    .text-container p {
        margin: 10px;
    }

    .overlay-content img {
        max-width: 100%;
    }

    .small-image {
        width: 230px;
        height: 300px;
    }

    .smallimage {
        width: 90px;
        height: 90px;
    }
    p{
        font-weight: bold;
    }
    
    #formatted-text{
          white-space: pre;
          font-size: 23px;
    }
</style>

<body onload="downloadPDF()">
    <div class="image-container">
        <img src="{{ asset('img/slips/basic.jpg') }}" alt="Centered Image">
        <div class="image-content">
            <img src="data:image/jpeg;base64,{{ base64_encode($data['photo']) }}" alt="Additional Image" class="small-image">
        </div>

        <div class="lastname">
            <p>{{ $data['surname'] ?? null }}</p>
        </div>

        <div class="firstname">
            <p>{{ $data['firstname'] ?? null }}</p>
        </div>

        <div class="dob">
            <p>{{ $data['formattedDob'] ?? null }}</p>
        </div>

        <div class="nin">
            <p id = "formatted-text">{{ $data['nin'] ?? null }}</p>
        </div>
        
    </div>
</body>

<script>
    function downloadPDF() {
        var element = document.querySelector('.image-container'); // Change the selector to match your container
        var opt = {
            margin: 0, // Adjust margin as needed
            filename: '{{ $data['nin'] }}_nvs_slip.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(element).set(opt).save();
    }
</script>

</html>
