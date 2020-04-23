<?php
/**
 * Created by PhpStorm.
 * User: dannexdaniels
 * Date: 2/21/19
 * Time: 7:47 PM
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="<?php echo base_url('assets/')?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/')?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="<?php echo base_url('assets/')?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url('assets/')?>vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo base_url('assets/')?>css/main.css" rel="stylesheet" media="all">

    <style>
        .required:after{content: " *"; color: red;}
        .o {display: none;}
    </style>

</head>

<body>
<div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Driver Registration</h2>
            </div>
            <div class="card-body">
                <?php echo form_open(base_url()."API/create_driver");?>
                    <div class="form-row m-b-55">
                        <div class="name required">Name</div>
                        <div class="value">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="first_name" required>
                                        <label class="label--desc">first name</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="last_name" required>
                                        <label class="label--desc">last name</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name required">ID Number</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" name="id_no" maxlength="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name required">Email</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="email" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row m-b-55">
                        <div class="name required">Phone</div>
                        <div class="value">
                            <div class="row row-refine">
                                <div class="col-3">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="area_code" value="+254" disabled>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="number" name="phone">
                                        <label class="label--desc">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row m-b-55">
                        <div class="name required">License</div>
                        <div class="value">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="license_no" required>
                                        <label class="label--desc">Licence Number</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="date" name="license_exp" required>
                                        <label class="label--desc">Expiry</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name required">DL Class</div>
                        <div class="value">
                            <div class="input-group">
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="dl_class" required>
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option>Class A</option>
                                        <option>Class B</option>
                                        <option>Class C</option>
                                        <option>Class D</option>
                                        <option>Class E</option>
                                        <option>Class F</option>
                                        <option>Class G</option>
                                        <option>Class H</option>
                                        <option>Class I</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>

        </div>
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Vehicle Details</h2>
            </div>
            <div class="card-body">

                    <div class="form-row m-b-55">
                        <div class="name required">Vehicle</div>
                        <div class="value">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="plate_no" required>
                                        <label class="label--desc">Registration Number</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="logbook_no" required>
                                        <label class="label--desc">Log Book Number</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name required">Model</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" name="model" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name required">Capacity</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" name="capacity" maxlength="10" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row m-b-55">
                        <div class="name required">Insurance</div>
                        <div class="value">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="ins_no" required>
                                        <label class="label--desc">Insurance Number</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="date" name="ins_exp" required>
                                        <label class="label--desc">Expiry</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row p-t-20">
                        <label class="label label--block required">Are you the owner of the vehicle?</label>
                        <div class="p-t-15">
                            <label class="radio-container m-r-55">Yes
                                <input type="radio" name="owner" value="yes" checked="checked" onclick="hideOwner()">
                                <span class="checkmark"></span>
                            </label>
                            <label class="radio-container">No
                                <input type="radio" name="owner" value="no" onclick="showOwner()">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                <div class="form-row">
                    <div class="name required">Bank</div>
                    <div class="value">
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="dl_class">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option>Baclays Bank</option>
                                    <option>Bank of Africa</option>
                                    <option>Co-operative Bank</option>
                                    <option>Equity Bank</option>
                                    <option>Family Bank</option>
                                    <option>KCB Bank</option>
                                    <option>National Bank</option>
                                    <option>NIC Bank</option>
                                    <option>Standard Chartered Bank</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="form-row" id="bank">
                        <div class="name required">Bank Account Number</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" name="owner_bank">
                            </div>
                        </div>
                    </div>

            </div>
        </div>
        <div class="card card-5">
            <div class="card-heading o">
                <h2 class="title" >Owner Details</h2>
            </div>
            <div class="card-body">

                    <div class="form-row m-b-55 o">
                        <div class="name required">Name</div>
                        <div class="value">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="owner_first_name">
                                        <label class="label--desc">First Name</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="owner_last_name" >
                                        <label class="label--desc">Last Name</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name required">ID Number</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" name="owner_id_no" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="form-row m-b-55 o">
                        <div class="name required" >Phone</div>
                        <div class="value">
                            <div class="row row-refine">
                                <div class="col-3">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="area_code" value="+254" disabled>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="number" name="owner_phone">
                                        <label class="label--desc">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row o">
                        <div class="name required">Email</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="email" name="owner_email" >
                            </div>
                        </div>
                    </div>
                    <div class="form-row o">
                        <div class="name required">Bank Account Number</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" name="owner_bank">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="btn btn--radius-2 btn--red" type="submit">Register</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    function showOwner() {
        $(".o").show();
    }

    function hideOwner() {
        $(".o").hide();
    }
</script>

<!-- Jquery JS-->
<script src="<?php echo base_url('assets/')?>vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="<?php echo base_url('assets/')?>vendor/select2/select2.min.js"></script>
<script src="<?php echo base_url('assets/')?>vendor/datepicker/moment.min.js"></script>
<script src="<?php echo base_url('assets/')?>vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="<?php echo base_url('assets/')?>js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
