<?php include 'header.php'; ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script> -->
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
                                    <h4 class="card-header">Analysis</h4>
                                </ul>
                                <!-- <form class="form-inline my-2 my-lg-0 ml-auto">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form> -->
                            </div>
                        </div>
                        <div class="card-body">

<table class="table table-striped table-bordered" id="Analysis_1" style="border: 2px solid black">
    <thead>
        <tr>
            <th scope="col" style="border-right: 1px solid black">Year of entry</th>
            <th scope="col" style="border-right: 1px solid black">(N1 + N2 + N3)</th>
            <th scope="col " colspan="4">Number of students who have successfully graduated without backlogs in any semester/year of study</th>
        </tr>
        <tr>
            <th style="border-right: 1px solid black"></th>
            <th style="border-right: 1px solid black"></th>
            <th colspan="4">(Without Backlog means no compartment or failures in any semester/year of study)</th>
        </tr>
        <tr>
            <th style="border-right: 1px solid black"></th>
            <th style="border-right: 1px solid black"></th>
            <th style="border: 1px solid black">FY</th>
            <th style="border: 1px solid black">SY</th>
            <th style="border: 1px solid black">TY</th>
            <th style="border: 1px solid black">BE</th>
        </tr>
    </thead>
    <tbody>

                        <!-- <table class="table table-striped table-bordered" id="Analysis_1" style="boarder:2px solid black">
                                <thead>
                                    <tr>
                                        <th scope="col">Year of entry</th>
                                        <th scope="col">(N1 + N2 +N3)</th>
                                        <th scope="col">Number of students who have successfully graduated without backlogs in any semester/year of study</th>
                                        
                                    </tr>
                                    <tr>
                                          <th></th>
                                          <th></th>
                                          <th>(Without Backlog means no compartment or failures in any semester/year of study)</th>
                              
                                    </tr>
                                    <tr>
                                          <th></th>
                                          <th></th>
                                          <th style="length: 50px;">FY</th>
                                          <th>SY</th>
                                          <th>TY</th>
                                          <th>BE</th>
                                    </tr>
                                    

                                </thead>
                                <tbody> -->
                              <?php
                  
                            include 'index_backend.php';
                            $jsonArray = json_encode($admission_years);
                  
                    //charts arrays
                    $FY_chart = array();
                    $SY_chart = array();
                    $TY_chart = array();
                    $BE_chart = array();

                    // $json_FY = json_encode($FY_chart);
                  for($i=0;$i<sizeof($admission_years);$i++){
                        $B = $admission_years[$i];
                    
                            // total students
                        $q1 = "SELECT COUNT(*) AS total_students FROM `student` where batch='$B'";
                        $result = mysqli_query($connection, $q1);
                        $row = mysqli_fetch_assoc($result);
                        $total_students = $row['total_students'];
                        
                        
                         // total no. of FY students (N1)
                         $q2 = "SELECT COUNT(*) AS fy_students FROM `student` where batch='$B' and not FY='DSY'";
                         $result2 = mysqli_query($connection, $q2);
                         $row2 = mysqli_fetch_assoc($result2);
                         $fy_students = $row2['fy_students'];
                         
                     
                         // total no. DSY students (N2)
                         $DSY_students = $total_students - $fy_students;
                    
                        // FY passed
                         $q3 = "SELECT COUNT(*) AS fy_passed FROM `student` where batch='$B' and FY='Pass'";
                         $result3 = mysqli_query($connection, $q3);
                         $row3 = mysqli_fetch_assoc($result3);
                         $fy_passed = $row3['fy_passed'];
                         array_push($FY_chart,$fy_passed);

                         // SY passed
                         $q4 = "SELECT COUNT(*) AS sy_passed FROM `student` where batch='$B' and SY='Pass' and (FY='Pass' or FY='DSY')  ";
                         $result4 = mysqli_query($connection, $q4);
                         $row4 = mysqli_fetch_assoc($result4);
                         $sy_passed = $row4['sy_passed'];
                         array_push($SY_chart,$sy_passed);

                         // TY passed
                         $q5 = "SELECT COUNT(*) AS ty_passed FROM `student` where batch='$B' and TY='Pass' and SY='Pass' and (FY='Pass' or FY='DSY')" ;
                         $result5 = mysqli_query($connection, $q5);
                         $row5 = mysqli_fetch_assoc($result5);
                         $ty_passed = $row5['ty_passed'];
                         array_push($TY_chart,$ty_passed);

                         //BE Passed
                         $q6 = "SELECT COUNT(*) AS BE_passed FROM `student` where batch='$B' and BE='Pass' and TY='Pass' and SY='Pass' and (FY='Pass' or FY='DSY')";
                         $result6 = mysqli_query($connection, $q6);
                         $row6 = mysqli_fetch_assoc($result6);
                         $BE_passed = $row6['BE_passed'];
                         array_push($BE_chart,$BE_passed);

                        echo "<tr style='background-color:white;'>";
                    
                        echo "<td class='border-bottom' style='border: 1px solid black'>$B</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$fy_students + $DSY_students</td>";

                        echo "<td class='border-bottom' style='border: 1px solid black'>$fy_passed</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$sy_passed</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$ty_passed</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$BE_passed</td>";

                        }
                        $json_FY = json_encode($FY_chart);
                        $json_SY = json_encode($SY_chart);
                        $json_TY = json_encode($TY_chart);
                        $json_BE = json_encode($BE_chart);

                  ?>
                                </tbody>
                            </table>
                            <!-- Button to trigger download -->
                            <button class="btn btn-primary mt-3" id="downloadBtn">Download Table</button>
                  </div>
                    
                
                
                <div id="" style=""><center><h6>Number of students who have successfully graduated without backlogs in any semester/year of study</h6></center></div>
                
                <div  id="echarts_1" style="width: 600px;height:400px;"></div>
                </div>
                </div>
<!-- second table -->
                        
<!-- second table -->
                        
<div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-inline mr-auto w-100">
                                <ul class="navbar-nav mr-3">
                                    <h4 class="card-header">Analysis</h4>
                                </ul>
                                <!-- <form class="form-inline my-2 my-lg-0 ml-auto">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form> -->
                            </div>
                        </div>
                        <div class="card-body">


                        <table class="table table-striped table-bordered" id="Analysis_2" style="border: 2px solid black">
    <thead>
        <tr>
            <th scope="col" style="border-right: 1px solid black">Year of entry</th>
            <th scope="col" style="border-right: 1px solid black">(N1 + N2 + N3)</th>
            <th scope="col " colspan="4">Number of students who have successfully graduated in stipulated period of study</th>
        </tr>
        <tr>
            <th style="border-right: 1px solid black"></th>
            <th style="border-right: 1px solid black"></th>
            <th colspan="4">(Total of with Backlog + Without Backlog )</th>
        </tr>
        <tr>
            <th style="border-right: 1px solid black"></th>
            <th style="border-right: 1px solid black"></th>
            <th style="border: 1px solid black">FY</th>
            <th style="border: 1px solid black">SY</th>
            <th style="border: 1px solid black">TY</th>
            <th style="border: 1px solid black">BE</th>
        </tr>
    </thead>
    <tbody>


                              <?php
                  
                              include 'index_backend.php';
                  
                    //charts_2 arrays
                    $FY_chart_2 = array();
                    $SY_chart_2 = array();
                    $TY_chart_2 = array();
                    $BE_chart_2 = array();

                  for($i=0;$i<sizeof($admission_years);$i++){
                        $B = $admission_years[$i];
                    
                            // total students
                        $q1 = "SELECT COUNT(*) AS total_students FROM `student` where batch='$B'";
                        $result = mysqli_query($connection, $q1);
                        $row = mysqli_fetch_assoc($result);
                        $total_students = $row['total_students'];
                        
                         // total no. of FY students (N1)
                         $q2 = "SELECT COUNT(*) AS fy_students FROM `student` where batch='$B' and not FY='DSY'";
                         $result2 = mysqli_query($connection, $q2);
                         $row2 = mysqli_fetch_assoc($result2); 
                         $fy_students = $row2['fy_students'];
                     
                         // total no. DSY students (N2)
                         $DSY_students = $total_students - $fy_students;
                    
                        // FY passed with or without atkt
                         $q3 = "SELECT COUNT(*) AS fy_passed FROM `student` where batch='$B' and  FY='Pass' or FY='Fail A.T.K.T.' ";
                         $result3 = mysqli_query($connection, $q3);
                         $row3 = mysqli_fetch_assoc($result3);
                         $fy_passed = $row3['fy_passed'];
                         array_push($FY_chart_2,$fy_passed);

                         // SY passed with or without atkt
                         $q4 = "SELECT COUNT(*) AS sy_passed FROM `student` where batch='$B' and SY='Pass' or SY='Fail A.T.K.T.' ";
                         $result4 = mysqli_query($connection, $q4);
                         $row4 = mysqli_fetch_assoc($result4);
                         $sy_passed = $row4['sy_passed'];
                         array_push($SY_chart_2,$sy_passed);

                         // TY passed with or without atkt
                         $q5 = "SELECT COUNT(*) AS ty_passed FROM `student` where batch='$B' and TY='Pass' or TY='Fail A.T.K.T.' " ;
                         $result5 = mysqli_query($connection, $q5);
                         $row5 = mysqli_fetch_assoc($result5);
                         $ty_passed = $row5['ty_passed'];
                         array_push($TY_chart_2,$ty_passed);

                         //BE Passed with or without atkt
                         $q6 = "SELECT COUNT(*) AS BE_passed FROM `student` where batch='$B' and BE='Pass' or BE='Fail A.T.K.T.' ";
                         $result6 = mysqli_query($connection, $q6);
                         $row6 = mysqli_fetch_assoc($result6);
                         $BE_passed = $row6['BE_passed'];
                         array_push($BE_chart_2,$BE_passed);

                        echo "<tr style='background-color:white;'>";
                    
                        echo "<td class='border-bottom' style='border: 1px solid black'>$B</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$fy_students + $DSY_students</td>";

                        echo "<td class='border-bottom' style='border: 1px solid black'>$fy_passed</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$sy_passed</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$ty_passed</td>";
                        echo "<td class='border-bottom' style='border: 1px solid black'>$BE_passed</td>";

                        }

                        $json_FY_2 = json_encode($FY_chart_2);
                        $json_SY_2 = json_encode($SY_chart_2);
                        $json_TY_2 = json_encode($TY_chart_2);
                        $json_BE_2 = json_encode($BE_chart_2);
                    

                  ?>
                                </tbody>
                            </table>
                            <!-- Button to trigger download -->
                            <button class="btn btn-primary mt-3" id="downloadBtn_2">Download Table</button>
                  </div>

<!-- secnod table end -->

<!-- charts -->

<!-- secnod table end -->

<div id="" style=""><center><h6>Number of students who have successfully graduated in stipulated period of study
(Total of with Backlog + Without Backlog )</h6></center></div>
<div  id="echarts_2" style="width: 600px;height:400px;"></div>



            </div>
        </div>

        <!-- charts -->
    </section>
</div>




<!-- Main Content End -->
<?php include 'footer.php'; ?>

<!-- JavaScript to handle table download -->
<!-- <script>
    document.getElementById("downloadBtn").addEventListener("click", function () {
        // Select the table element
        var table = document.getElementById("Analysis_1");
        // Create a new Blob object with table data
        var blob = new Blob([table.outerHTML], {
            type: "application/vnd.ms-excel;charset=utf-8"
        });
        // Trigger the download using a temporary link
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "analysis_table_1.xls"; // File name
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });
</script> -->

<script>
    document.getElementById("downloadBtn").addEventListener("click", function () {
        // College name
        var collegeName = "BRACT's Vishwakarma Institute of Information Technology, Pune";

        // Select the table element
        var table = document.getElementById("Analysis_1");

        // Create a new Blob object with table data
        var blob = new Blob([getExcelData(collegeName, table)], {
            type: "application/vnd.ms-excel;charset=utf-8"
        });

        // Trigger the download using a temporary link
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "analysis_table_1.xls"; // File name
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });

    function getExcelData(collegeName, table) {
    // Get the HTML content of the table
    var tableHtml = table.outerHTML;

    // Construct the Excel data
    var excelData = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    excelData += '<head>';
    excelData += '<!--[if gte mso 9]>';
    excelData += '<xml>';
    excelData += '<x:ExcelWorkbook>';
    excelData += '<x:ExcelWorksheets>';
    excelData += '<x:ExcelWorksheet>';
    excelData += '<x:Name>Sheet1</x:Name>';
    excelData += '<x:WorksheetOptions>';
    excelData += '<x:DisplayGridlines/>';
    excelData += '</x:WorksheetOptions>';
    excelData += '</x:ExcelWorksheet>';
    excelData += '</x:ExcelWorksheets>';
    excelData += '</x:ExcelWorkbook>';
    excelData += '</xml>';
    excelData += '<![endif]-->';
    excelData += '<style>';
    excelData += 'h4,h5 { text-align: center; }'; // Center align college name
    excelData += '</style>';
    excelData += '</head>';
    excelData += '<body>';
    excelData += '<h4>' + collegeName + '<br>Department of Information Technology</h4>'; // Append college name and department
    excelData += tableHtml;
    excelData += '</body>';
    excelData += '</html>';

    return excelData;
}

</script>





<!-- <script>
    document.getElementById("downloadBtn_2").addEventListener("click", function () {
        // Select the table element
        var table = document.getElementById("Analysis_2");
        // Create a new Blob object with table data
        var blob = new Blob([table.outerHTML], {
            type: "application/vnd.ms-excel;charset=utf-8"
        });
        // Trigger the download using a temporary link
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "analysis_table_2.xls"; // File name
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });
</script> -->

<script>
    document.getElementById("downloadBtn_2").addEventListener("click", function () {
        // College name
        var collegeName = "BRACT's Vishwakarma Institute of Information Technology, Pune";

        // Select the table element
        var table = document.getElementById("Analysis_2");

        // Create a new Blob object with table data
        var blob = new Blob([getExcelData(collegeName, table)], {
            type: "application/vnd.ms-excel;charset=utf-8"
        });

        // Trigger the download using a temporary link
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "analysis_table_2.xls"; // File name
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });

    function getExcelData(collegeName, table) {
    // Get the HTML content of the table
    var tableHtml = table.outerHTML;

    // Construct the Excel data
    var excelData = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    excelData += '<head>';
    excelData += '<!--[if gte mso 9]>';
    excelData += '<xml>';
    excelData += '<x:ExcelWorkbook>';
    excelData += '<x:ExcelWorksheets>';
    excelData += '<x:ExcelWorksheet>';
    excelData += '<x:Name>Sheet1</x:Name>';
    excelData += '<x:WorksheetOptions>';
    excelData += '<x:DisplayGridlines/>';
    excelData += '</x:WorksheetOptions>';
    excelData += '</x:ExcelWorksheet>';
    excelData += '</x:ExcelWorksheets>';
    excelData += '</x:ExcelWorkbook>';
    excelData += '</xml>';
    excelData += '<![endif]-->';
    excelData += '<style>';
    excelData += 'h4,h5 { text-align: center; }'; // Center align college name
    excelData += '</style>';
    excelData += '</head>';
    excelData += '<body>';
    excelData += '<h4>' + collegeName + '<br>Department of Information Technology</h4>'; // Append college name and department
    excelData += tableHtml;
    excelData += '</body>';
    excelData += '</html>';

    return excelData;
}

</script>








<script type="text/javascript">
      // Initialize the echarts instance based on the prepared dom
      var myChart = echarts.init(document.getElementById('chart'));

      // Specify the configuration items and data for the chart
      console.log("11111111111111111")
      var javascriptArray = <?php echo $jsonArray; ?>;
      var option = {
        title: {
          text: ''
        },
        tooltip: {},
        legend: {
          data: ['sales']
        },
        
        xAxis: {
            
          data: javascriptArray
        },
        yAxis: {},
        series: [
          {
            name: 'sales',
            type: 'bar',
            data: [5, 20, 36, 10, 10, 20]
          }
        ]
      };

      // Display the chart using the configuration items and data just specified.
      myChart.setOption(option);
    </script>



<!-- chart-1 -->

<script>
    var javascriptArray = <?php echo $jsonArray; ?>;
    var js_FY = <?php echo $json_FY; ?>;
    var js_SY = <?php echo $json_SY; ?>;
    var js_TY = <?php echo $json_TY; ?>;
    var js_BE = <?php echo $json_BE; ?>;

    console.log("---",js_FY)
        // Initialize ECharts instance
        var myChart = echarts.init(document.getElementById('echarts_1'));

        // PHP variables converted to JavaScript
        var posList = [
            'left',
            'right',
            'top',
            'bottom',
            'inside',
            'insideTop',
            'insideLeft',
            'insideRight',
            'insideBottom',
            'insideTopLeft',
            'insideTopRight',
            'insideBottomLeft',
            'insideBottomRight'
        ];

        var app = {
            configParameters: {
                rotate: {
                    min: -90,
                    max: 90
                },
                align: {
                    options: {
                        left: 'left',
                        center: 'center',
                        right: 'right'
                    }
                },
                verticalAlign: {
                    options: {
                        top: 'top',
                        middle: 'middle',
                        bottom: 'bottom'
                    }
                },
                position: {
    options: posList.reduce(function (map, pos) {
      map[pos] = pos;
      return map;
    }, {})
  },
                distance: {
                    min: 0,
                    max: 100
                }
            },
            config: {
                rotate: 90,
                align: 'left',
                verticalAlign: 'middle',
                position: 'insideBottom',
                distance: 15,
                onChange: function () {
                    var labelOption = {
                        rotate: app.config.rotate,
                        align: app.config.align,
                        verticalAlign: app.config.verticalAlign,
                        position: app.config.position,
                        distance: app.config.distance
                    };
                    myChart.setOption({
                        series: [
                            { label: labelOption },
                            { label: labelOption },
                            { label: labelOption },
                            { label: labelOption }
                        ]
                    });
                }
            }
        };

        var labelOption = {
            show: true,
            position: app.config.position,
            distance: app.config.distance,
            align: app.config.align,
            verticalAlign: app.config.verticalAlign,
            rotate: app.config.rotate,
            formatter: '{c}  {name|{a}}',
            fontSize: 16,
            rich: { name: {} }
        };

        var option = {
            
            tooltip: {
                trigger: 'axis',
                axisPointer: { type: 'shadow' }
            },
            legend: { data: ['FY', 'SY', 'TY', 'B.Tech'] },
            toolbox: {
                show: true,
                orient: 'vertical',
                left: 'right',
                top: 'center',
                feature: {
                    mark: { show: true },
                    dataView: { show: true, readOnly: false },
                    magicType: { show: true, type: ['line', 'bar', 'stack'] },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },
            xAxis: [{ type: 'category', axisTick: { show: false }, data: javascriptArray}],
            yAxis: [{ type: 'value' }],
            series: [
                { name: 'FY', type: 'bar', barGap: 0, label: labelOption, emphasis: { focus: 'series' }, data:js_FY },
                { name: 'SY', type: 'bar', label: labelOption, emphasis: { focus: 'series' }, data: js_SY },
                { name: 'TY', type: 'bar', label: labelOption, emphasis: { focus: 'series' }, data: js_TY },
                { name: 'B.Tech', type: 'bar', label: labelOption, emphasis: { focus: 'series' }, data: js_BE }
            ]
        };

        // Set ECharts option
        option && myChart.setOption(option);
    </script>




<!-- chart-2 -->

<script>
    // var javascriptArray = ;
    var js_FY_2 = <?php echo $json_FY_2; ?>;
    var js_SY_2 = <?php echo $json_SY_2; ?>;
    var js_TY_2 = <?php echo $json_TY_2; ?>;
    var js_BE_2 = <?php echo $json_BE_2; ?>;

    console.log("---",js_FY)
        // Initialize ECharts instance
        var myChart = echarts.init(document.getElementById('echarts_2'));

        // PHP variables converted to JavaScript
        var posList = [
            'left',
            'right',
            'top',
            'bottom',
            'inside',
            'insideTop',
            'insideLeft',
            'insideRight',
            'insideBottom',
            'insideTopLeft',
            'insideTopRight',
            'insideBottomLeft',
            'insideBottomRight'
        ];

        var app = {
            configParameters: {
                rotate: {
                    min: -90,
                    max: 90
                },
                align: {
                    options: {
                        left: 'left',
                        center: 'center',
                        right: 'right'
                    }
                },
                verticalAlign: {
                    options: {
                        top: 'top',
                        middle: 'middle',
                        bottom: 'bottom'
                    }
                },
                position: {
    options: posList.reduce(function (map, pos) {
      map[pos] = pos;
      return map;
    }, {})
  },
                distance: {
                    min: 0,
                    max: 100
                }
            },
            config: {
                rotate: 90,
                align: 'left',
                verticalAlign: 'middle',
                position: 'insideBottom',
                distance: 15,
                onChange: function () {
                    var labelOption = {
                        rotate: app.config.rotate,
                        align: app.config.align,
                        verticalAlign: app.config.verticalAlign,
                        position: app.config.position,
                        distance: app.config.distance
                    };
                    myChart.setOption({
                        series: [
                            { label: labelOption },
                            { label: labelOption },
                            { label: labelOption },
                            { label: labelOption }
                        ]
                    });
                }
            }
        };

        var labelOption = {
            show: true,
            position: app.config.position,
            distance: app.config.distance,
            align: app.config.align,
            verticalAlign: app.config.verticalAlign,
            rotate: app.config.rotate,
            formatter: '{c}  {name|{a}}',
            fontSize: 16,
            rich: { name: {} }
        };

        var option = {
            tooltip: {
                trigger: 'axis',
                axisPointer: { type: 'shadow' }
            },
            legend: { data: ['FY', 'SY', 'TY', 'B.Tech'] },
            toolbox: {
                show: true,
                orient: 'vertical',
                left: 'right',
                top: 'center',
                feature: {
                    mark: { show: true },
                    dataView: { show: true, readOnly: false },
                    magicType: { show: true, type: ['line', 'bar', 'stack'] },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },
            xAxis: [{ type: 'category', axisTick: { show: false }, data: javascriptArray}],
            yAxis: [{ type: 'value' }],
            series: [
                { name: 'FY', type: 'bar', barGap: 0, label: labelOption, emphasis: { focus: 'series' }, data:js_FY_2 },
                { name: 'SY', type: 'bar', label: labelOption, emphasis: { focus: 'series' }, data: js_SY_2 },
                { name: 'TY', type: 'bar', label: labelOption, emphasis: { focus: 'series' }, data: js_TY_2 },
                { name: 'B.Tech', type: 'bar', label: labelOption, emphasis: { focus: 'series' }, data: js_BE_2 }
            ]
        };

        // Set ECharts option
        option && myChart.setOption(option);
    </script>