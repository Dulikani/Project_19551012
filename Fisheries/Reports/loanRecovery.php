<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body {
            background: white;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            padding: 10px;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="portrait"] {
            width: 21cm;
            height: 29.7cm;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }




        @media print {
            .noPrint {
                display: none;
                background-color: #4CAF50;
                /* Green */
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                margin-right: 0;
                margin-left: auto;

            }

        }

        @page {
            size: auto;
            margin: 0;
            padding: 50px;
        }

        .graph {
            border: none;
        }





        table {
            width: 100%;
            border-collapse: collapse;

        }

        .noPrint {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin-right: 0;
            margin-left: auto;
        }
    </style>

</head>

<body>

    <?php
    include_once("../db_connect.php");
    $fromMIS = array_key_exists('from', $_GET) ? $_GET['from'] : '';
    $toMIS = array_key_exists('to', $_GET) ? $_GET['to'] : '';

    ?>
    <center>
        <button onclick="window.print();" class="noPrint">
            Download Report
        </button>
    </center>

    <page size="">
        <center><img src="../images/ssss.png" width="100%"></center>
        <br>
        <center><img src="../images/logofish.png" width="25%"></center>

        <br>
        <center>
            <h1>Periodical Loan Recovery Status Report</h1>
        </center>
        <center>
            <h3>Period : From : <input type="text" id="from" value="<?php echo $fromMIS; ?>" readonly> To : <input type="text" id="to" value="<?php echo $toMIS; ?>" readonly></h3>
        </center>

        <hr>
        <br>
        <h3>Member Pending Loan</h4>
            <table border="2">
                <thead>
                    <tr>
                        <th>
                        Loan ID
                        </th>
                        <th>
                            Member ID
                        </th>
                        <th>
                            Account No
                        </th>
                        <th>
                        Description
                        </th>
                        <th>
                        LoanAmount
                        </th>
                        <th>
                        LoanDate
                        </th>
                        <th>
                        NoOfMonths
                        </th>
                        <th>
                        Monthly Installment
                        </th>
                        <th>
                        TotalWithInterest
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //$from1 = "<script>document.write(localStorage.getItem('from'))</script>";
                    // echo $from1;


                    // $from="2022-08-01";
                    // $to="2022-08-30";


                    $sql = "SELECT * 
                         FROM pass_loans 
                         WHERE DATE(CreatedDate) BETWEEN '$fromMIS'  AND '$toMIS' AND PaidStatus='Pending' ";

                    echo "<br>";
                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                    while ($record = mysqli_fetch_assoc($resultset)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $record['LoanID']; ?>

                            </td>
                            <td>
                                <?php echo $record['MemberID']; ?>
                            </td>
                            <td>
                                <?php echo $record['AccNo']; ?>
                            </td>
                            <td>
                                <?php echo $record['Description']; ?>
                            </td>
                            <td>
                                <?php echo $record['LoanAmount']; ?>
                            </td>
                            <td>
                                <?php echo $record['LoanDate']; ?>
                            </td>
                            <td>
                                <?php echo $record['NoOfMonths']; ?>
                            </td>
                            <td>
                                <?php echo $record['MonthlyInstallment']; ?>
                            </td>
                            <td>
                                <?php echo $record['TotalWithInterest']; ?>
                            </td>





                        </tr>

                    <?php
                    } ?>

                    <tr>
                        <td colspan="8" style="background-color:  #bcbcbc ;">
                            <p style="font-weight:bold">Total Requested Loan Amount </p>
                        </td>
                        <?php
                        $sql3 = "SELECT SUM(LoanAmount) AS Amount FROM pass_loans WHERE DATE(CreatedDate) BETWEEN '$fromMIS'  AND '$toMIS' AND PaidStatus='Pending' ";
                        $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                        $data3 = mysqli_fetch_assoc($resultset3);

                        ?>
                        <td><?php echo $data3['Amount'] ?></td>
                    </tr>

                </tbody>
            </table><br>
            <hr>
          
               



                <br>
                <br><br><br>
                <br><br>
                <center>
                    <div class="row ">

                        <div class="col">
                            <div class="signbox">
                                <p style="font-size: 14px; font-Family:arial;margin-top:20px;">..............................................</p>
                            </div>
                            <p style="font-size: 14px; font-Family:arial;">Signature</p>

                        </div>




                    </div>
                    <br><br><br>
                    <div class="row ">
                        <div class="col">
                            <p style="font-size: 12px; font-Family:arial;">Fax - 0112 80 8200 </p>
                            <p style="font-size: 12px; font-Family:arial;margin-top:-15px">Email - info@fisheries.lk </p>
                        </div>

                    </div>
                </center>


                </div>

    </page>








</body>


</html>