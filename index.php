<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generator</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <br />
            <form action="#" method="POST" id="formadd" role="form">


                <div class="form-group">
                    <label>Select DB</label>
                    <select name="databases" id="databases" class="form-control" required="required">
                        <?php
                        $link = mysqli_init();
                        $success = mysqli_connect("localhost", "root", "", "mysql");
                        $set = mysqli_query($success, "SHOW DATABASES;");
                        $dbs = array();
                        $kabehdb = array();
                        while ($db = mysqli_fetch_row($set))
                            $dbs[] = $db[0];
                        $hasil = count($dbs);
                        for ($i = 0; $i < $hasil; $i++) {
                            print_r("<option value='$dbs[$i]'>" . $dbs[$i] . "</option>");
                        }
                        mysqli_close($success);
                        ?>
                    </select>

                </div>

                <div class="form-group">
                    <label>Select Tables</label>

                    <select name="tablenya" id="tablenya" class="form-control" required="required">
                        <option value=""></option>
                    </select>

                </div>

                <div class="form-group">
                    <label>Select Methods</label>
                    <select name="method" id="method" class="form-control" required="required">
                        <option value="1">Create</option>
                        <option value="2">Read</option>
                        <option value="3">Update</option>
                        <option value="4">Delete</option>
                        <option value="5">Select</option>
                        <option value="6">Validation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Fungsi</label>
                    <select name="fungsi" id="fungsi" class="form-control" required="required">
                        <option value="0">REST API</option>
                        <option value="1" selected>Native</option>

                    </select>
                </div>
                <div class="form-group">
                    <label>Select Framework</label>
                    <select name="fw" id="fw" class="form-control" required="required">
                        <option value="1" selected>Codeigniter4</option>
                        <option value="2">Golang Gorm Model</option>
                        <option value="3">Golang Gin Controller</option>
                        <option value="4">Golang Gin Route</option>
                        <option value="5">JS</option>
                    </select>
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <br>
            <textarea name="" style="height: 500px;" id="coding" class="form-control" required="required"></textarea>

        </div>
        <div class="col-lg-2"></div>
    </div>


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#databases").change(function(e) {
                var data = $(this).val();
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "showtable.php",
                    data: {
                        data: data
                    },
                    success: function(response) {
                        $("#tablenya").html(response);
                        $("#tablenya").change();
                    }
                });
            });

            $("#tablenya").change(function(e) {
                var data = $(this).val();
                var db = $("#databases").val();
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "showcolumn.php",
                    data: {
                        data: data,
                        db: db
                    },
                    success: function(response) {
                        $("#response").html(response);
                    }
                });
            });

            $("#formadd").submit(function(e) {
                var data = $(this).serialize();
                var method = $("#method").val();
                var fungsi = $("#fungsi").val();
                var fw = $("#fw").val();
                e.preventDefault();

                if (method == 1 && fungsi == 1 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "method/create.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 2 && fungsi == 1 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "method/read.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 3 && fungsi == 1 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "method/update.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 4 && fungsi == 1 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "method/delete.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 5 && fungsi == 1 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "method/select.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 1 && fungsi == 0 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "php_api/create.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });

                } else if (method == 2 && fungsi == 0 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "php_api/read.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 3 && fungsi == 0 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "php_api/update.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 4 && fungsi == 0 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "php_api/delete.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 5 && fungsi == 0 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "php_api/select.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (method == 6 && fw == 1) {
                    $.ajax({
                        type: "post",
                        url: "method/validate.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (fw == 2) {
                    $.ajax({
                        type: "post",
                        url: "golang/golang_gorm_model.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (fw == 3) {
                    $.ajax({
                        type: "post",
                        url: "golang/golang_gin_controller.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else if (fw == 4) {
                    $.ajax({
                        type: "post",
                        url: "golang/golang_gin_route.php",
                        data: data,
                        success: function(response) {
                            $("#coding").html(response);
                        }
                    });
                } else {
                    $("#coding").html("Not Detected Methods");
                }

            });
            $("#coding").click(function(e) {
                e.preventDefault();
                $("#coding").select();
                document.execCommand('copy');
                alert("copied");
            });
        });

        $(window).on("load", function() {
            $("#databases").change();
        });
    </script>
</body>

</html>