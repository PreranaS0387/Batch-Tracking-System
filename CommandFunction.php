<?php
 //searching Category list
 function search_products(){
    global $conn;
      if(isset($_GET['search_data_products'])){
        $search_data_value=$_GET['search_data'];
          $search_query="Select * from `category` where product_keywords like '%$search_data_value%'";
              $result_query=mysqli_query($conn,$search_query);
              //echo $row['product_title'];
              $result_query=mysqli_query($conn,$search_query);
              $num_rows=mysqli_num_rows($result_query);
              if($num_rows==0){
                echo "<h2 class='text-danger'>Sorry..! No stock Avaliable for this Products</h2>";
              }
              while($row =mysqli_fetch_assoc($result_query)){
                $product_id=$row['id'];
                $category=$_POST['category'];
                echo "<tr>";
                    echo "<td>$row[id]</td>";
                   
                    echo "<td>$row[category]</td>";
                    echo '<td>
                    <a href="CategoryEdit.php?id='.$row['id'].'"><button class="btn btn-success m-2"><i class="fa-solid fa-pencil m-1"></i> Edit</button></a>
                    <a href="CategoryDeleteBackEnd.php?id='.$row['id'].'"><button class="btn btn-danger m-2"><i class="fa-solid fa-trash m-1"></i>Delete</button></a>
                     </th>';
                     echo "</tr>";
              }
             }
        }
?>