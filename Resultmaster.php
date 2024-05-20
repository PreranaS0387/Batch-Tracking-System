
<?php include 'header.php'; ?>
      <!-- Main Content Start-->
      <div class="main-content">
        <section class="section">
          <div class="section-body"> 
            <div class="row">
              <div class="col-9 col-md-9 col-lg-9" style="margin:auto;">
              <?php
                if(isset($_SESSION['message']))
                {
                    echo "<h4>".$_SESSION['message']."</h4>";
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                  <div class="card-header">
                    <h4>Upload Result</h4>
                  </div>
                  <div class="card-body">
                  <form action="Resultbackend.php" method="POST" enctype="multipart/form-data">
                    <!-- admitioin year -->
                    <div class="form-group">
                    <label>Select Batch (Admission year - Passout year) </label>
                    <select class="custom-select" id="batch" name="batch">
                    <option value="">Select...</option>
                      <option value=2015>2015-19</option>
                      <option value=2016>2016-20</option>
                      <option value=2017>2017-21</option>
                      <option value=2018>2018-22</option>
                      <option value=2019>2019-23</option>
                      <option value=2020>2020-24</option>
                      <option value=2021>2021-25</option>
                      <option value=2022>2022-26</option>
                      <option value=2023>2023-27</option>
                      <option value=2024>2024-28</option>
                      <option value=2025>2025-29</option>
                      <option value=2026>2026-30</option>  
                      <option value=2027>2027-31</option>
                      <option value=2028>2028-32</option>
                      <option value=2029>2029-33</option>
                      <option value=2030>2030-34</option>                     
                    </select>
                    </div> 
                    <!-- semister -->
                    <div class="form-group">
                    <label>Select semester of the result </label>
                    <select class="custom-select" id="sem" name="sem">
                      <option value="">Select...</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>                      
                    </select>
                    </div> 
                    <!-- file -->
                    <div class="form-group">
                      <label>Submit result file(.xlsx)</label>
                      <input type="file" class="form-control" id="import_file" name="import_file" autocomplete="off">
                    </div>
                    
                    <button type="submit" name="save_excel_data" class="btn btn-primary mt-3">Submit</button>
                    
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

   
<?php include 'footer.php'; ?>