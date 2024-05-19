
<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap">
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
        top: 125px;
        left: 210px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border-radius: 5px;
    }

    .sign {
        position: absolute;
        top: 290px;
        left: 267px;
        display: flex;
        flex-direction: column;
        padding: 20px;
        border-radius: 5px;
    }

    .barcode {
        position: absolute;
        top: 495px;
        left: 490px;
        padding: 10px;
        border-radius: 5px;
    }

    .phone {
        position: absolute;
        top: 362px;
        left: 310px;
        padding: 10px;
        border-radius: 5px;
    }

    .blga {
        position: absolute;
        top: 438px;
        left: 310px;
        padding: 10px;
        border-radius: 5px;
    }
    
    
    .bress {
        position: absolute;
        top: 400px;
        left: 310px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .lastname {
        position: absolute;
        top: 208px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }

    .firstname {
        position: absolute;
        top: 132px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .middle {
        position: absolute;
        top: 174px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }

    .dob {
        position: absolute;
        top: 242px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }

    .nin {
        position: absolute;
        top: 299px;
        left: 165px;
        padding: 10px;
        border-radius: 5px;
    }

    .tracking {
        position: absolute;
        top: 363px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .resstate {
        position: absolute;
        top: 413px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .bstate {
        position: absolute;
        top: 439px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .address {
        position: absolute;
        top: 470px;
        left: 100px;
        padding: 10px;
        border-radius: 5px;
    }
    
    .gender {
        position: absolute;
        top: 288px;
        left: 100px;
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
        width: 146px;
        height: 167px;
    }

   .small-images {
        width: 70px;
        height: 15px;
    }

    .smallimage {
        width: 140px;
        height: 140px;
    }
    
    
     
        
    .medium-text {
            font-family: 'Public Sans', sans-serif;
            font-weight: 300;
            font-size: 10px;
    }
    
    #formatted-text{
        white-space: pre;
        font-size: 25px;
        letter-spacing: 1px; 
    }
    
</style>

<body onload="downloadPDF()">
    <div class="image-container">
        <img src="{{ asset('img/slips/nvs.png') }}" alt="Centered Image">
        <div class="image-content">
            <img src="data:image/jpeg;base64,{{ base64_encode($data['photo']) }}" alt="Additional Image" class="small-image">
        </div>

        <div class="sign">
            <img src="data:image/jpeg;base64,{{ base64_encode($data['signature']) }}" alt="Additional Image" class="small-image">
        </div>

        <div class="barcode">
           <p class="medium-text">{{ $data['address'] ?? null }}</p>
        </div>

        <div class="phone">
            <p class="medium-text">{{ $data['phone'] ?? null }}</p>
        </div>

        <div class="lastname">
            <p class="medium-text">{{ $data['surname'] ?? null }}</p>
        </div>

         <div class="middle">
            <p class="medium-text">{{ $data['middlename'] ?? null }}</p>
        </div>

        <div class="firstname">
            <p class="medium-text">{{ $data['firstname'] ?? null }}</p>
        </div>

        <div class="dob">
            <p class="medium-text">{{ $data['formattedDob'] ?? null }}</p>
        </div>

        <div class="gender">
            <p class="medium-text">{{ $data['gender'] ?? null }}</p>
        </div>

        <div class="nin">
            <p class="medium-text"id="formatted-text">{{ $data['nin'] ?? null }}</p>
        </div>
        
         <div class="tracking">
            <p class="medium-text">{{ $data['tracking_id'] ?? null }}</p>
        </div>
        
           <div class="resstate">
            <p class="medium-text">{{ $data['state'] ?? null }}</p>
        </div>
        
        <div class="bstate">
            <p class="medium-text">{{ $data['birthstate'] ?? null }}</p>
        </div>
        
        <div class="address">
            <p class="medium-text">{{ $data['address'] ?? null }}</p>
        </div>
    
        <div class="blga">
            <p class="medium-text">{{ $data['birthlga'] ?? null }}</p>
        </div>
        
         <div class="bress">
            <p class="medium-text">{{ $data['restown'] ?? null }}</p>
        </div>
    </div>
</body>

<script>
    function downloadPDF() {
        var element = document.querySelector('.image-container'); // Change the selector to match your container
        var opt = {
            margin: 0, // Adjust margin as needed
            filename: '{{ $data['nin'] }}_basic_slip.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(element).set(opt).save();
    }
</script>

</html>

