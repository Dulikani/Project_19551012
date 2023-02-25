<?php
if ($_SESSION['use']) {
} else {
  header("Location:index.php");
}
$userType = $_SESSION['prev'];

if ($userType == "Admin") {
?>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="Dashboard.php">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Member/ Employee</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="AddMember.php">Add Member </a></li>
            <li class="nav-item"> <a class="nav-link" href="EditMember.php">Edit Member</a></li>
            <li class="nav-item"> <a class="nav-link" href="AddEmployee.php">Add Employee</a></li>
            <li class="nav-item"> <a class="nav-link" href="EditEmployee.php">Edit Employee</a></li>
            <li class="nav-item"> <a class="nav-link" href="AddUserLogins.php">Employee Logins </a></li>


          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Administration</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="CreateLoan.php">Create Loan</a></li>
            <li class="nav-item"><a class="nav-link" href="ViewLoan.php">View Loan</a></li>
            <li class="nav-item"><a class="nav-link" href="CreateDonationRequest.php">Donation Request</a></li>
            <li class="nav-item"><a class="nav-link" href="SearchDetails.php">Search Details</a></li>
            <li class="nav-item"><a class="nav-link" href="BankCreditDebit.php">Bank Credit/Debit</a></li>


          </ul>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="ContactUs.php">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Report Issue</span>
        </a>
      </li>
    </ul>
  </nav>


<?php



} elseif ($userType == "BOD") {

?>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="Dashboard.php">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
     


     
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="icon-bar-graph menu-icon"></i>
          <span class="menu-title">Manage Society</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="PendingLoans.php">Pending Loans</a></li>
            <li class="nav-item"> <a class="nav-link" href="PendingDonations.php">Pending Donations</a></li>

          </ul>
        </div>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Generate Reports</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="MISReports.php">MIS Reports</a></li>
            <li class="nav-item"> <a class="nav-link" href="PawningRecoveryReport.php">Pawning Recovery </a></li>
            <li class="nav-item"> <a class="nav-link" href="LoanRecoveryReport.php">Loan Recovery </a></li>

          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="ContactUs.php">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Report Issue</span>
        </a>
      </li>
    </ul>
  </nav>
<?php
} elseif ($userType == "Banking") {
?>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="Dashboard.php">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      
      
      
     



     
     
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Manage Banking</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="BankCreateAccount.php">Create Account</a></li>
            <li class="nav-item"> <a class="nav-link" href="ProcessLoans.php">Process Loans</a></li>
            <li class="nav-item"> <a class="nav-link" href="CreateTransaction.php">Process Transactions</a></li>
            <li class="nav-item"> <a class="nav-link" href="ProcessPawning.php">Process Pawning</a></li>
            <li class="nav-item"> <a class="nav-link" href="ProcessDonation.php">Donation Request</a></li>

          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Generate Reports</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="MISReports.php">MIS Reports</a></li>
            <li class="nav-item"> <a class="nav-link" href="PawningRecoveryReport.php">Pawning Recovery </a></li>
            <li class="nav-item"> <a class="nav-link" href="LoanRecoveryReport.php">Loan Recovery </a></li>

          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="ContactUs.php">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Report Issue</span>
        </a>
      </li>
    </ul>
  </nav>
<?php
}


?>