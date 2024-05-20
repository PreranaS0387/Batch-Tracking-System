<?php 
session_start();
if(!$_SESSION['email'])
{
    header('Location:log_in.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin - Result Backtracking</title>
  <link rel="stylesheet" href="assets/css/App.min.css">
  <link rel="stylesheet" href="assets/css/Style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
  .main-sidebar .sidebar-menu li a span {
    color: white;
  }
  .main-sidebar .sidebar-menu li a {
    color: white;
  }
  .main-sidebar .sidebar-menu li a:hover {
    background: red;
  }
  .light-sidebar .main-sidebar .sidebar-menu li ul.dropdown-menu li a {
    color: white;    
  }
  a img {
    width: 38%;
    height: 100%;
    padding: 0px;
  }
  .light-sidebar.sidebar-mini .main-sidebar .sidebar-menu li ul.dropdown-menu li a {
    color: black;
  }
  .org-name {
    font-size: 1.25rem;
    color: #214974; /* Dark blue color */
    font-family: "Times New Roman", Times, serif;
  }
  .navbar-custom {
    background-color: #808080; /* Light background color for visibility */
  }
  .text-danger {
    color: red !important;
  }
  .after-w-dot::after {
    content: "\2022"; /* Adds a dot after the element */
    color: red;
    margin-left: 5px;
  }
</style>
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg navbar-custom sticky" style="height: 72px;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
          <a href="https://www.viit.ac.in/"> <span class="org-name">
            Vishwakarma Institute of Information Technology, Pune
          </span></a>
          <a class="text-danger" href="log_out.php">Log out <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
        <div class="form-inline">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a></li>
          </ul>
        </div>
      </nav>
      <div class="main-sidebar sidebar-style-2" style="background:#0072bc !important;">
        <aside id="" style="background:#0072bc !important;">
          <div class="sidebar-brand" style="height: 100%;background:#0072bc;">
            <a href="index.php"> <img src="assets/img/viit_img.png" alt="Logo Image"><span></span> </a>
          </div>
          <ul class="sidebar-menu" style="background:#0072bc !important; height:100%">
            <li class="dropdown">
              <a href="index.php" class="nav-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa-solid fa-code"></i><span>Upload Result</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="Resultmaster.php">Upload Result File</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa-brands fa-product-hunt"></i><span>Result List </span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="ResultListForm.php">Result List </a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fa-solid fa-circle-info"></i><span>Batch Result</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="BatchDetailsForm.php">Batch Detail Form</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
