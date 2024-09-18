<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #000;
        }
        .container {
            width: 100%;
            padding: 20px;
            border: 1px solid #000;
        }
        .header {
            display: flex;
            justify-content: space-between;
        }
        .header p {
            margin: 0;
            padding: 0;
        }
        .info-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #000;
        }
        .info-section p {
            margin: 5px 0;
        }
        .sub-title {
            font-weight: bold;
        }
        .signature-section {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .signature-section img {
            width: 100px;
        }
        .footer {
            margin-top: 20px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
        .footer p {
            margin: 0;
            text-align: center;
            font-size: 10px;
        }
        .signature-box {
            margin-top: 20px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <div>
            <p>Dr Min-Qing Lee<br>Level 8 / 637 Flinders Street<br>Docklands VIC 3008</p>
            <p>Phone: 1300 391 438</p>
        </div>
        <div>
            <p>Prescriber no: 3047046</p>
        </div>
    </div>

    <!-- Patient Info Section -->
    <div class="info-section">
        <p><strong>Patient's Name:</strong> Mackayla Wright (dob 17/10/1994)</p>
        <p><strong>Address:</strong> 2 Riverbend Court, Lawnton QLD 4501</p>
        <p><strong>Date:</strong> 28/8/24</p>
        <p><strong>PBS:</strong> X</p>
        <p><strong>RPBS:</strong> X</p>
    </div>

    <!-- Prescription Details -->
    <div class="info-section">
        <p class="sub-title">Valid for script date only</p>
        <p class="sub-title">Valid for one treatment only</p>
        <p class="sub-title">PRP COURSE 1 Cycle</p>
        <p><strong>Quantity:</strong> 4 units</p>
        <p><strong>Location:</strong> Face and neck</p>
        <p><strong>Route of administration:</strong> Injection</p>
    </div>

    <!-- Nurse and Clinic Info -->
    <div class="info-section">
        <p><strong>Nurse:</strong> Edwin Whaites</p>
        <p><strong>Clinic:</strong> Whaites Corp Pty Ltd (T/A EW Cosmetic Injector & Laser Clinics)</p>
        <p><strong>Address:</strong> 23/666 Gympie Road, Lawnton QLD 4501</p>
    </div>

    <!-- Signature Section -->
    <div class="signature-section">
        <div>
            <p>Dr Min-Qing Lee</p>
            <img src="path-to-signature-image.png" alt="Signature">
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>This is a digital image of the prescription. The signed original will be sent to your pharmacy.</p>
        <p>Whaites Corp Pty Ltd (T/A EW Cosmetic Injector & Laser Clinics)<br>666 Gympie Road, Lawnton QLD 4501</p>
        <p>Script No.: Wright_240828103540</p>
    </div>
</div>
</body>
</html>
