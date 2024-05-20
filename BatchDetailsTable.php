<?php include 'header.php'; ?>
<!-- Database value in Table -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-inline mr-auto w-100">
                                <ul class="navbar-nav mr-3">
                                    <h4 class="card-header">Result Details</h4>
                                </ul>
                                <!-- <form class="form-inline my-2 my-lg-0 ml-auto">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="resultTable">
                                <thead>
                                    <tr>
                                        <th scope="col">N1 (FY)</th>
                                        <th scope="col">N2 (DSY)</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">FY (Pass students)</th>
                                        <th scope="col">SY (Pass students)</th>
                                        <th scope="col">TY (Pass students)</th>
                                        <th scope="col">BE (Pass students)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                    $Batch = $_POST['Batch'];
                    // $batch = 2019;
                    // echo "$batch";
                    include 'BatchDetailsBackend.php';
                    echo "<tr style='background-color:white;'>";
                    echo "<td class='border-bottom'>$fy_students</td>";
                    echo "<td class='border-bottom'>$DSY_students</td>";
                    echo "<td class='border-bottom'>$total_students</td>";

                    echo "<td class='border-bottom'> $fy_passed</td>";
                    echo "<td class='border-bottom'>$sy_passed</td>";
                    echo "<td class='border-bottom'>$ty_passed</td>";
                    echo "<td class='border-bottom'>$BE_passed</td>";

                  ?>
                                </tbody>
                            </table>
                            <!-- Button to trigger download -->
                            <button class="btn btn-primary mt-3" id="downloadBtn">Download Table</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top 10 students -->
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-inline mr-auto w-100">
                                <ul class="navbar-nav mr-3">
                                    <h4 class="card-header">Top 10 Students</h4>
                                </ul>
                                <!-- <form class="form-inline my-2 my-lg-0 ml-auto">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="result-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">PRN no.</th>
                                        <th scope="col">Student Name</th>
                                        <!-- <th scope="col">FY</th>
                                        <th scope="col">SY</th>
                                        <th scope="col">TY</th>
                                        <th scope="col">BE</th> -->
                                        <th scope="col">Batch</th>
                                        <th scope="col">cgpa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $Batch = $_POST['Batch'];
                                    // include 'ResultListBackend.php';
                                    include('connection.php');
                                    $qq = "SELECT * From `student` where batch='$Batch' order by cgpa desc limit 10";
                                    $ResultDATA=mysqli_query($connection,$qq);
                                    while ($row = mysqli_fetch_array($ResultDATA)) {
                                        echo "<tr style='background-color:white;'>";
                                        echo "<td class='border-bottom'>$row[prn]</td>";
                                        echo "<td class='border-bottom'>$row[student_name]</td>";
                                        // echo "<td class='border-bottom'>$row[FY]</td>";
                                        // echo "<td class='col-3 border-bottom'>$row[SY]</td>";
                                        // echo "<td class='col-3 border-bottom'>$row[TY]</td>";
                                        // echo "<td class='col-3 border-bottom'>$row[BE]</td>";
                                        echo "<td class='col-3 border-bottom'>$row[batch]</td>";
                                        echo "<td class='col-3 border-bottom'>$row[cgpa]</td>";

                                        // echo '<td class="border-bottom">
                                        // <a href="ResultListDelete.php?id=' . $row['prn'] . '"><button class="btn btn-danger m-2"><i class="fa-solid fa-trash m-1"></i>Delete</button></a>
                                        // </th>';
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- top 10 students end -->

</div>
<!-- Main Content End -->
<?php include 'footer.php'; ?>

<!-- JavaScript to handle table download -->
<script>
    document.getElementById("downloadBtn").addEventListener("click", function () {
        // Select the table element
        var table = document.getElementById("resultTable");
        // Create a new Blob object with table data
        var blob = new Blob([table.outerHTML], {
            type: "application/vnd.ms-excel;charset=utf-8"
        });
        // Trigger the download using a temporary link
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "result_table.xls"; // File name
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });
</script>
