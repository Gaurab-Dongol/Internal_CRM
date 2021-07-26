<?php
require_once('config.php');

$query = "SELECT DISTINCT Consultant FROM OfficeHQ";
$statement = mysqli_query($connect,$query);
$result = mysqli_fetch_array($statement,MYSQLI_ASSOC);
       
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
                                            foreach ($result as $row) {
                                                echo '<option value="' . $row["Consultant"] . '">' . $row["Consultant"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                        <input type="hidden" name="hidden_country" id="hidden_country" />
                                        <div style="clear:both"></div>
                                    </div>
                                </div>

                                <?php
                                if($_SESSION['RoleId'] == 1)
                                {
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
                                            <form>
                                                <div class="form-now">
                                                    <div class="col">
                                                        <label for="inputEmployee">Select Employee Name</label>
                                                        <select id="inputEmployee" class="form-control-1">
                                                            <option selected>Choose from list...</option>
                                                            <option value="">Somya Verma</option>
                                                            <option value="">Kathrine Lastname</option>
                                                            <option value="">Upasana Lastname</option>
                                                            <option value="">Test employee</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="inputFirstName">First Name</label>
                                                        <input type="text" class="form-control" placeholder="First name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="inputLastName">Last Name</label>
                                                        <input type="text" class="form-control" placeholder="Last name">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Address</label>
                                                    <input type="text" class="form-control" id="inputAddress" placeholder="street name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress2">Address 2</label>
                                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">State</label>
                                                        <select id="inputState" class="form-control">
                                                            <option selected>Choose...</option>
                                                            <option value="">New South Wales</option>
                                                            <option value="">Queensland</option>
                                                            <option value="">Victoria</option>
                                                            <option value="">South Australia</option>
                                                            <option value="">Western Australia</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputZip">Zip</label>
                                                        <input type="text" class="form-control" id="inputZip">
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
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