<?php include 'header.php'; ?>
<!--Database value in Table--> 
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
                                        <th scope="col">FY</th>
                                        <th scope="col">SY</th>
                                        <th scope="col">TY</th>
                                        <th scope="col">BE</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $batch = $_POST['batch'];
                                    include 'ResultListBackend.php';
                                    while ($row = mysqli_fetch_array($ResultData)) {
                                        echo "<tr style='background-color:white;'>";
                                        echo "<td class='border-bottom'>$row[prn]</td>";
                                        echo "<td class='border-bottom'>$row[student_name]</td>";
                                        echo "<td class='border-bottom'>$row[FY]</td>";
                                        echo "<td class='col-3 border-bottom'>$row[SY]</td>";
                                        echo "<td class='col-3 border-bottom'>$row[TY]</td>";
                                        echo "<td class='col-3 border-bottom'>$row[BE]</td>";
                                        echo "<td class='col-3 border-bottom'>$row[batch]</td>";

                                        echo '<td class="border-bottom">
                                        <a href="ResultListDelete.php?id=' . $row['prn'] . '"><button class="btn btn-danger m-2"><i class="fa-solid fa-trash m-1"></i>Delete</button></a>
                                        </th>';
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
</div>

<!--Main Content End-->
<div class="text-center">
  <center>
    <button id="download-btn" class="btn btn-primary" >Download Table</button>
    </center>
</div>

<?php include 'footer.php'; ?>

<script>
    document.getElementById('download-btn').addEventListener('click', function() {
        // Get the table
        var table = document.getElementById('result-table');

        // Generate a download link
        var downloadLink = document.createElement('a');
        downloadLink.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(tableToCSV(table)));
        downloadLink.setAttribute('download', 'result_details.csv');
        document.body.appendChild(downloadLink);

        // Trigger the download
        downloadLink.click();

        // Clean up
        document.body.removeChild(downloadLink);
    });

    // Function to convert table to CSV format
    function tableToCSV(table) {
        var rows = table.querySelectorAll('tr');
        var csv = [];
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length-1; j++) {
                row.push(cols[j].innerText);
            }
            csv.push(row.join(','));
        }
        return csv.join('\n');
    }
</script>