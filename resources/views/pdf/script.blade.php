<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Layout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;

        }

        td {

            vertical-align: top;
            line-height: 1.75em;
            font-size: 12px;
        }
        /*.header {*/
        /*    font-weight: bold;*/
        /*}*/
        .signature {
            margin-top: 30px;
        }
        .small-text {
            font-size: 12px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            text-align: center;
            width: 100%;
        }

        .copy{
            position: relative;
        }
        .copy:after{
            content: 'Pharmacist Patient Copy';
            position: absolute;
            top: 5%; /* Adjust this to move vertically */

            left: 10%;

            margin:  0 auto;
            transform: rotate(180deg); /* Flip the text */
            font-size: 20px;
            font-weight: bold;
            writing-mode: vertical-lr; /* Writing from bottom to top */
            text-orientation: mixed;
            color: white; /* Optional text color */

        }
    </style>
</head>
<body>

<div class="container">

    <table>
        <tr>
            <td>
                <table>
                    <!-- Header Section -->
                    <tr>
                        <td colspan="4">
                            Dr Min-Qing Lee<br>
                            Level 8 / 637 Flinders Street<br>
                            Docklands VIC 3008<br>
                        </td>

                    </tr>

                    <tr style="border-top: 1px solid #000">
                        <td width="25%">
                            <strong> Prescriber no.:</strong>
                        </td>

                        <td width="25%">
                            3047046<br>
                        </td>


                        <td width="25%">
                            <strong>Phone:</strong>
                        </td>

                        <td width="25%">
                            1300 391 438
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Patient's Medicare No.
                        </td>
                        <td colspan="2">

                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            Pharmaceutical Benifits entitlement no.
                        </td>
                        <td colspan="2">

                        </td>
                    </tr>


                    <!-- Patient Details Section -->
                    <tr>
                        <td colspan="4">
                            <strong>Patient's Name:</strong> {{ $script->patient->full_name }} (dob {{$script->patient->date_of_birth}})<br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <strong>Address:</strong> {{ $script->patient->address }}<br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Date:</strong> {{ $script->medical_consultation->consultation_date }} &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1">
                            <strong>PBS:</strong> X &nbsp;
                        </td>

                        <td colspan="1">
                            <strong>RPBS:</strong>
                        </td>
                        <td colspan="2">
                            <strong>Brand substitution not permitted</strong>
                        </td>
                    </tr>
                    <!-- Prescription Section Left -->
                    <tr>
                        <td style="width: 25px; background-color: red;">

                        </td>
                        <td colspan="3" style="padding: 5px 15px">
                            {{$script->medical_consultation->notes}}
                            <br>
                            <strong>Quantity:</strong> {{ $script->treatment_detail->quantity }} units<br>
                            <strong>Location:</strong> {{ $script->treatment_detail->location }}<br>
                            <strong>Route of administration:</strong> {{ $script->treatment_detail->extra_notes }}<br>
                            <strong>Nurse:</strong> Edwin Whaites<br>
                            Clinic: Whaites Corp Pty Ltd (T/A EW Cosmetic Injector & Laser Clinics)<br>
                            23/666 Gympie Road, Lawnton QLD 4501

                        </td>
                    </tr>

                    <!-- Signature Section -->
                    <tr>
                        <td colspan="4">
                            <strong>Dr Min-Qing Lee</strong><br>
                            <div class="signature">
                                <img src="signature.png" alt="Signature" width="100"><br>
                            </div>
                        </td>

                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <!-- Header Section -->
                    <tr>
                        <td colspan="4">
                            Dr Min-Qing Lee<br>
                            Level 8 / 637 Flinders Street<br>
                            Docklands VIC 3008<br>
                        </td>

                    </tr>

                    <tr style="border-top: 1px solid #000">
                        <td width="25%">
                            <strong> Prescriber no.:</strong>
                        </td>

                        <td width="25%" class="value">
                            3047046<br>
                        </td>


                        <td width="25%">
                            <strong>Phone:</strong>
                        </td>

                        <td width="25%"  class="value">
                            1300 391 438
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Patient's Medicare No.
                        </td>
                        <td colspan="2">

                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            Pharmaceutical Benifits entitlement no.
                        </td>
                        <td colspan="2"  class="value">

                        </td>
                    </tr>


                    <!-- Patient Details Section -->
                    <tr>
                        <td colspan="4">
                            <strong>Patient's Name:</strong> {{ $script->patient->full_name }} (dob {{$script->patient->date_of_birth}})<br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <strong>Address:</strong> {{ $script->patient->address }}<br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Date:</strong> {{ $script->medical_consultation->consultation_date }} &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1">
                            <strong>PBS:</strong> X &nbsp;
                        </td>

                        <td colspan="1">
                            <strong>RPBS:</strong>
                        </td>
                        <td colspan="2">
                            <strong>Brand substitution not permitted</strong>
                        </td>
                    </tr>
                    <!-- Prescription Section Left -->
                    <tr>
                        <td style="width: 25px; background-color: red;" class="copy">

                        </td>
                        <td colspan="3" style="padding: 5px 15px">
                            {{$script->medical_consultation->notes}}
                            <br>
                            <strong>Quantity:</strong> {{ $script->treatment_detail->quantity }} units<br>
                            <strong>Location:</strong> {{ $script->treatment_detail->location }}<br>
                            <strong>Route of administration:</strong> {{ $script->treatment_detail->extra_notes }}<br>
                            <strong>Nurse:</strong> Edwin Whaites<br>
                            <strong>Clinic:</strong> Whaites Corp Pty Ltd (T/A EW Cosmetic Injector & Laser Clinics)<br>
                            23/666 Gympie Road, Lawnton QLD 4501

                        </td>
                    </tr>

                    <!-- Signature Section -->
                    <tr>
                        <td colspan="4">
                            <strong>Dr Min-Qing Lee</strong><br>
                            <div class="signature">
                                <img src="signature.png" alt="Signature" width="100"><br>
                            </div>
                        </td>

                    </tr>
                </table>
            </td>
        </tr>
    </table>




    <!-- Footer Section -->
    <div class="footer">
        This is a digital image of the prescription. The signed original will be sent to your pharmacy.<br>
        Whaites Corp Pty Ltd (T/A EW Cosmetic Injector & Laser Clinics), 666 Gympie Road, LAWNTON QLD 4501
    </div>
</div>

</body>
</html>
