<?php
require_once('config.php');

//Test 
if (isset($_POST['Submit'])) {
    $name = trim($_POST['Name']);
    $Email = trim($_POST['Email']);
    $Contact = trim($_POST['Contact']);
    $Enquiry = trim($_POST['Enquiry']);
    $Note = trim($_POST['Note']);
    $Status = trim($_POST['Status']);
    $CurrentVisa = trim($_POST['CurrentVisa']);
    $Appointment = trim($_POST['Appointment']);
    $MM_Update = trim($_POST['MM_Update']);
    $Consultant = trim($_POST['Consultant']);

    $sql = "INSERT INTO OfficeHQ (Client_Name, Email_Id, Contact, Enquiry, Consultant, Notes, Status, Current_Visa, Appointment, MM_Update) VALUES ( '$name', '$Email', '$Contact', '$Enquiry', '$Consultant', '$Notes', '$Status', '$CurrentVisa', '$Appointment', '$MM_Update')";
    mysqli_query($connect, $sql);
}

require_once('header.php');
?>
<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35"></h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="multi_search_filter js-select2" id="multi_search_filter">
                                <option selected="selected">Everyone</option>
                                <?php

                                $query = "SELECT DISTINCT Consultant FROM OfficeHQ";
                                $statement = mysqli_query($connect, $query);
                                //$result = mysqli_fetch_array($statement);
                                //foreach($result as $row) {
                                while ($row = mysqli_fetch_array($statement)) {
                                    echo '<option value="' . $row["Consultant"] . '">' . $row["Consultant"] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="dropDownSelect2"></div>
                            <input type="hidden" name="hidden_country" id="hidden_country" />
                            <div style="clear:both"></div>
                        </div>
                    </div>

                    <!-- User based header-->
                    <?php
                    if ($_SESSION['RoleId'] == 1) {
                    ?>
                        <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                            <div class="table-data__tool-right">
                                <input type="file" name="file" id="file" accept=".csv">
                                <button type="submit" id="submit" name="submit" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>

                <!-- Add clients -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add Client Details
                        </button>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="inputEmployee">Select Employee Name</label>
                                        <select id="inputEmployee" name="Consultant" class="form-control">
                                            <option selected>Choose from list...</option>
                                            <option value="Somya Verma">Somya Verma</option>
                                            <option value="Kathrine Lastname">Kathrine Lastname</option>
                                            <option value="Upasana Lastname">Upasana Lastname</option>
                                            <option value="Test employee">Test employee</option>
                                        </select>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="inputFirstName">Client Name</label>
                                            <input type="text" class="form-control" name="Name" placeholder="Client name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" name="Email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Contact</label>
                                        <input type="text" class="form-control" name="Contact" placeholder="Contact">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Enquiry</label>
                                        <input type="text" class="form-control" name="Enquiry" placeholder="Enquiry">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress2">Note</label>
                                        <input type="text" class="form-control" name="Note" placeholder="Note">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">Status</label>
                                        <input type="text" class="form-control" name="Status" placeholder="Status">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">Current Visa</label>
                                        <input type="text" class="form-control" name="CurrentVisa" placeholder="Current Visa">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">Appointment</label>
                                        <input type="text" class="form-control" name="Appointment" placeholder="Appointment">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">MM_Update</label>
                                        <input type="text" class="form-control" name="MM_Update" placeholder="MM_Update">
                                    </div>


                            </div>
                            <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            <!--Import CSV File -->
            <?php
            if (isset($_POST["submit"])) {
                if ($_FILES['file']['name']) {
                    $filename = explode(".", $_FILES['file']['name']);
                    if ($filename[1] == 'csv') {
                        $handle = fopen($_FILES['file']['tmp_name'], "r");
                        //Skips first row of excel file
                        fgetcsv($handle);
                        while ($data = fgetcsv($handle)) {
                            $item1 = mysqli_real_escape_string($connect, $data[0]);
                            $item2 = mysqli_real_escape_string($connect, $data[1]);
                            $item3 = mysqli_real_escape_string($connect, $data[2]);
                            $item4 = mysqli_real_escape_string($connect, $data[3]);
                            $item5 = mysqli_real_escape_string($connect, $data[4]);
                            $item6 = mysqli_real_escape_string($connect, $data[5]);
                            $item7 = mysqli_real_escape_string($connect, $data[6]);
                            $item8 = mysqli_real_escape_string($connect, $data[7]);
                            $item9 = mysqli_real_escape_string($connect, $data[8]);
                            $item10 = mysqli_real_escape_string($connect, $data[9]);
                            $query1 = "INSERT INTO OfficeHQ (`Client_Name`,`Email_Id`,`Contact`,`Enquiry`,`Consultant`,`Notes`,`Status`,`Current_Visa`,`Appointment`,`MM_Update`) VALUES ('$item1','$item2', '$item3', '$item4', '$item5', '$item6', '$item7','$item8','$item9','$item10')";
                            //$query = "INSERT INTO OfficeHQ (`Client_Name`,`Email_Id`,`Contact`,`Enquiry`,`Consultant`,`Notes`,`Status`,`Current_Visa`,`Appointment`,`MM_Update`) VALUES ('item1','item2', 000, 'item4', 'item5', 'item6', 'item7','item8','item9','item10')";
                            mysqli_query($connect, $query1);
                        }
                        fclose($handle);
                        echo "<script>alert('Import done');</script>";
                    }
                }
            }
            ?>

            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Email Id</th>
                            <th>Contact</th>
                            <th>Enquiry</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Current Visa</th>
                            <th>Appointment</th>
                            <th>MM_Update</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>
</div>



<?php
require_once('footer.php');
?>

<!-- Filter Script -->
<script>
    $(document).ready(function() {

        load_data();

        function load_data(query = '') {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function(data) {
                    $('tbody').html(data);
                }
            })
        }

        $('#multi_search_filter').change(function() {
            $('#hidden_country').val($('#multi_search_filter').val());
            var query = $('#hidden_country').val();
            load_data(query);
        });

    });
</script>