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
            <h1>Periodical Account Creation Report</h1>
        </center>
        <center>
            <h3>Period : From : <input type="text" id="from" value="<?php echo $fromMIS; ?>" readonly> To : <input type="text" id="to" value="<?php echo $toMIS; ?>" readonly></h3>
        </center>

        <hr>
        <h4>Member Account Creation</h4>
        <table border="2">
            <thead>
                <tr>
                    <th>
                        AccountNo
                    </th>
                    <th>
                        Acc holder ID
                    </th>
                    <th>
                        Acc holder name
                    </th>
                    <th>
                        Acc holder NIC
                    </th>
                    <th>
                        Acc type
                    </th>

                    <th>
                        Created Date
                    </th>
                    <th>
                        Account balance
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM member_account WHERE DATE(CreatedDate) BETWEEN '$fromMIS'  AND '$toMIS'";
                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                $k = 0;
                while ($record = mysqli_fetch_assoc($resultset)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $record['account_no']; ?>

                        </td>
                        <td>
                            <?php echo $record['memberID']; ?>
                        </td>
                        <?php
                        $memID = $record['memberID'];
                        $sql1 = "SELECT * FROM member WHERE member_id='$memID'";
                        $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
                        while ($record1 = mysqli_fetch_assoc($resultset1)) {

                        ?>
                            <td>
                                <?php echo $record1['first_name']; ?>
                                <?php echo $record1['last_name']; ?>
                            </td>
                        <?php  } ?>
                        <td>
                            <?php echo $record['NIC']; ?>
                        </td>
                        <td>
                            <?php echo $record['AccType']; ?>
                        </td>
                        <td>
                            <?php echo $record['TransDate']; ?>
                        </td>
                        <td>
                            <?php echo $record['TransAmount']; ?>
                        </td>




                    </tr>

                <?php
                } ?>

                <tr>
                    <td colspan="6" style="background-color:  #bcbcbc ;">
                        <p style="font-weight:bold">Total Member Account Balance</p>
                    </td>
                    <?php
                    $sql3 = "SELECT SUM(TransAmount) AS Amount FROM member_account WHERE DATE(CreatedDate) BETWEEN '$fromMIS'  AND '$toMIS'";
                    $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                    $data3 = mysqli_fetch_assoc($resultset3);

                    ?>
                    <td><?php echo $data3['Amount'] ?></td>
                </tr>

            </tbody>
        </table><br>
        <hr>
        <h4>Employee Account Creation</h4>
        <table border="2">
            <thead>
                <tr>
                    <th>
                        AccountNo
                    </th>
                    <th>
                        Acc holder ID
                    </th>
                    <th>
                        Acc holder name
                    </th>
                    <th>
                        Acc holder NIC
                    </th>
                    <th>
                        Acc type
                    </th>

                    <th>
                        Created Date
                    </th>
                    <th>
                        Account balance
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM employee_account WHERE DATE(CreatedDate) BETWEEN '$fromMIS'  AND '$toMIS'";
                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                $k = 0;
                while ($record = mysqli_fetch_assoc($resultset)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $record['account_no']; ?>

                        </td>
                        <td>
                            <?php echo $record['emp_ID']; ?>
                        </td>
                        <?php
                        $empID = $record['emp_ID'];
                        $sql1 = "SELECT * FROM employee WHERE emp_ID='$empID'";
                        $resultset1 = mysqli_query($conn, $sql1) or die("database error:" . mysqli_error($conn));
                        while ($record1 = mysqli_fetch_assoc($resultset1)) {

                        ?>
                            <td>
                                <?php echo $record1['first_name']; ?>
                                <?php echo $record1['last_name']; ?>
                            </td>
                        <?php  } ?>
                        <td>
                            <?php echo $record['NIC']; ?>
                        </td>
                        <td>
                            <?php echo $record['AccType']; ?>
                        </td>
                        <td>
                            <?php echo $record['TransDate']; ?>
                        </td>
                        <td>
                            <?php echo $record['TransAmount']; ?>
                        </td>




                    </tr>

                <?php
                } ?>

                <tr>
                    <td colspan="6" style="background-color:  #bcbcbc ;">
                        <p style="font-weight:bold">Total Employee Account Balance</p>
                    </td>
                    <?php
                    $sql3 = "SELECT SUM(TransAmount) AS Amount FROM employee_account WHERE DATE(CreatedDate) BETWEEN '$fromMIS'  AND '$toMIS'";
                    $resultset3 = mysqli_query($conn, $sql3) or die("database error:" . mysqli_error($conn));
                    $data3 = mysqli_fetch_assoc($resultset3);

                    ?>
                    <td><?php echo $data3['Amount'] ?></td>
                </tr>

            </tbody>
        </table><br>
        <hr>

        <h4>Non Member Pawning Account Creation</h4>
        <table border="2">
            <thead>
                <tr>
                    <th>
                        AccountNo
                    </th>
                    <th>
                        NIC
                    </th>
                    <th>
                        FirstName
                    </th>
                    <th>
                        AccType
                    </th>
                    <th>
                        TransAmount
                    </th>

                    <th>
                        Created Date
                    </th>
                    <th>
                        TransDate
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM non_member_account WHERE DATE(CreatedDate) BETWEEN '$fromMIS'  AND '$toMIS'";
                $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                $k = 0;
                while ($record = mysqli_fetch_assoc($resultset)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $record['account_No']; ?>

                        </td>
                        <td>
                            <?php echo $record['NIC']; ?>
                        </td>

                        <td>
                            <?php echo $record['FirstName']; ?>
                        </td>

                        <td>
                            <?php echo $record['AccType']; ?>
                        </td>
                        <td>
                            <?php echo $record['TransAmount']; ?>
                        </td>
                        <td>
                            <?php echo $record['CreatedDate']; ?>
                        </td>
                        <td>
                            <?php echo $record['TransDate']; ?>
                        </td>




                    </tr>

                <?php
                } ?>

                

            </tbody>
        </table><br>

        <br>



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