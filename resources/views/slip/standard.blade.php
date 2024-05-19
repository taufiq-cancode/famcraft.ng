<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=FontName&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>

<style>
    @font-face {
        font-family: 'public-sans';
        src: url('public-sans-v1.003/webfonts/PublicSans-Black.woff2') format('woff2'),
            url('public-sans-v1.003/webfonts/PublicSans-Black.woff') format('woff');
        /* Add more src declarations for different font formats if needed */
        font-weight: bold;
        font-style: normal;
    }

    /* styles.css */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff; /* Set background color for printing */
        font-family: 'Helvetica', sans-serif;
    }

    .image-container {
    width: 210mm; /* A4 paper width */
    height: 297mm; /* A4 paper height */
    margin: auto; /* Center the container horizontally */
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a slight shadow for visual separation */
    position: relative; 
    }

    .image-container img {
         margin-top: 30px;
        max-width: 90%;
        max-height: 100%;
    }

    .image-content {
        position: absolute;
        top: 81px;
        left: 600px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border-radius: 5px;
    }

    .barcode {
        position: absolute;
        top: 295px;
        left: 528px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border-radius: 5px;
    }

    .issue {
        position: absolute;
        top: 510px;
        left: 566px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border-radius: 5px;
    }

    .lastname {
        position: absolute;
        top: 125px;
        left: 296px;
        padding: 10px;
        border-radius: 5px;
    }

    .firstname {
        position: absolute;
        top: 160px;
        left: 296px;
        padding: 10px;
        border-radius: 5px;
    }

    .middlename {
        position: absolute;
        top: 193px;
        left: 296px;
        padding: 10px;
        border-radius: 5px;
    }

    .address {
        position: absolute;
        top: 130px;
        left: 437px;
        padding: 10px;
        border-radius: 5px;
        max-width: 160px; /* Adjust the value to your desired maximum width */
        text-align: left; /* Align text to the left */
    }

    .lg {
        position: absolute;
        top: 208px;
        left: 437px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .state {
        position: absolute;
        top: 229px;
        left: 437px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .dob {
        position: absolute;
        top: 480px;
        left: 255px;
        padding: 10px;
        border-radius: 5px;
    }

    .nin {
        position: absolute;
        top: 158px;
        left: 122px;
        padding: 10px;
        border-radius: 5px;
    }

    .tracking {
        position: absolute;
        top: 123px;
        left: 122px;
        padding: 10px;
        border-radius: 5px;
    }
    .gender {
        position: absolute;
        top: 222px;
        left: 296px;
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
        width: 120px;
        height: 132px;
    }

    .smallimage {
        width: 160px;
        height: 160px;
    }
    
    
    #formatted-text{
        white-space: pre;
        font-size: 45px;
        letter-spacing: 4px; 
    }
    
    .middle {
        position: absolute;
        top: 430px;
        left: 360px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .medium-text {
        font-family: 'Public Sans';
        font-weight: 400;
        font-size: 10px;
    }

</style>

<body onload="downloadPDF()">
    <div class="image-container" >
        <img src="{{ asset('img/slips/standard.png') }}" alt="Centered Image">
        <div class="image-content">
            <img src="data:image/jpeg;base64,{{ base64_encode($data['photo']) }}" alt="Additional Image" class="small-image">
        </div>

     
        <div class="middlename">
            <p class="medium-text">{{ $data['middlename'] ?? null }}</p>
        </div>

        <div class="lastname">
            <p class="medium-text">{{ $data['surname'] ?? null }}</p>
        </div>

 <div class="state">
           <p class="medium-text">{{ $data['state'] ?? null }}</p>
        </div>

        <div class="firstname">
            <p class="medium-text">{{ $data['firstname'] ?? null }}</p>
        </div>

 <div class="address">
            <p class="medium-text">{{ $data['address'] ?? null }}</p>
        </div>
        
        <div class="lg">
            <p class="medium-text">{{ $data['lg'] ?? null }}</p>
        </div>
         
        <div class="gender">
            <p class="medium-text">{{ $data['gender'] ?? null }}</p>
        </div>

        <div class="nin">
            <p class="medium-text">{{ $data['nin'] ?? null }}</p>
        </div>
        
         <div class="tracking">
            <p  class="medium-text">{{ $data['tracking_id'] ?? null }}</p>
        </div>
    </div>
</body>

<script>
    function downloadPDF() {
        var element = document.querySelector('.image-container'); // Change the selector to match your container
        var opt = {
            margin: 0, // Adjust margin as needed
            filename: '{{ $data['nin'] }}_standard_slip.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(element).set(opt).save();
    }
</script>

</html>
