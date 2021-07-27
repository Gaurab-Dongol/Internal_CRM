<?php
//require_once('config.php');

$connect = new PDO("mysql:host=localhost;dbname=Internal_CRM", "root", "root");

$query = "SELECT DISTINCT Consultant FROM OfficeHQ";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

require_once('header.php');
?>
            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">TASK
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->
            
            <section class="p-t-20">
            <div class="container">
                    <div class="row">
                    <div class="table-data__tool-left">
                                    <div class="rs-select2--light rs-select2--md">
                                    <form method="POST" class="" action="add_query.php">
                                        <select class="js-select2" name="cons" id="multi_search_filter">
                                            <option selected="selected">Everyone</option>
                                            <?php
                                                foreach($result as $row)
                                                {
                                                    echo '<option value="'.$row["Consultant"].'">'.$row["Consultant"].'</option>';	
                                                }
                                            ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                        <input type="hidden" name="hidden_country" id="hidden_country" />
                                        <div style="clear:both"></div>
                                        </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <div class="input-group">
                                                    <input type="text" id="input2-group2" name="task" placeholder="Task" class="form-control">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary" name="add">Add Task</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            <br /><br /><br />
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Consultant</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require 'config.php';
                                        $query = $connect->query("SELECT * FROM `task` ORDER BY `task_id` ASC");
                                        $count = 1;
                                        while($fetch = $query->fetch_array()){
                                        $date = date('d M', strtotime($fetch['Date']));
                                    ?>
                                    <tr>
                                        <td><?php echo $count++?></td>
                                        <td><?php echo $fetch['task']?></td>
                                        <td><?php echo $fetch['status']?></td>
                                        <td><?php echo $fetch['Consultant']?></td>
                                        <td><?php echo $date?></td>
                                        <td>
                                                <?php
                                                    if($fetch['status'] != "Done"){
                                                        echo 
                                                        '<a href="update_task.php?task_id='.$fetch['task_id'].'" class="btn btn-success"><span class="fa fa-check"></span></a> |';
                                                    }
                                                ?>
                                                <a href="delete_query.php?task_id=<?php echo $fetch['task_id']?>" class="btn btn-danger"><span class="fa fa-eraser"></span></a>
                                            
                                        </td>
                                    </tr>
                                    <?php
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

        <!-- Jquery JS-->
            <script src="vendor/jquery-3.2.1.min.js"></script>
            <!-- Bootstrap JS-->
            <script src="vendor/bootstrap-4.1/popper.min.js"></script>
            <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
            <!-- Vendor JS       -->
            <script src="vendor/slick/slick.min.js">
            </script>
            <script src="vendor/wow/wow.min.js"></script>
            <script src="vendor/animsition/animsition.min.js"></script>
            <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
            </script>
            <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
            <script src="vendor/counter-up/jquery.counterup.min.js">
            </script>
            <script src="vendor/circle-progress/circle-progress.min.js"></script>
            <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="vendor/chartjs/Chart.bundle.min.js"></script>
            <script src="vendor/select2/select2.min.js">
            </script>

            <!-- Main JS-->
            <script src="js/main.js"></script>
    
        </body>
</html>



