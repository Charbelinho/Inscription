<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/FDC.css">
    <title>AdminLTE 3 | Top Navigation</title>
    <?php include 'assets/styles.php' ?>
</head>

<body class="hold-transition layout-top-nav text-sm">
    <div class="wrapper">

        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <section class="content">
                    <div class="container-fluid ">
                        <div class="row mt-auto">
                            <div class="container-fluid">
                                <div class="form-group row">
                                    <div class="col-lg-3">

                                    </div>
                                    <div class="col-lg-6 col-sm-6" style="margin-top: 8%;">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                Diplôme obtenu
                                            </div>
                                            <form action="" method="post">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="genre" class="col-sm-4">Niveau d'étude</label>
                                                        <div class="col-sm-6">
                                                            <select name="niveau" id="" class="form-control form-control-sm select2 niveau" required>
                                                                <option value="">Sélectionner un niveau</option>
                                                                <option value="Terminale">Terminale</option>
                                                                <option value="BAC +1">BAC +1</option>
                                                                <option value="BAC +2">BAC +2</option>
                                                                <option value="BAC +3">BAC +3</option>
                                                                <option value="BAC +4">BAC +4</option>
                                                                <option value="BAC +5">BAC +5</option>
                                                                <option value="">Autre</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="lastdiplome" class="col-sm-4">Dernier Diplôme</label>
                                                        <div class="col-sm-6">
                                                            <select name="genre" id="" class="form-control form-control-sm select2 lastdiplome" required >
                                                                <option value="">Sélectionner votre dernier diplôme</option>
                                                                <option value="">BAC</option>
                                                                <option value="">BTS</option>
                                                                <option value="">LICENCE</option>
                                                                <option value="">MASTER</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" name="ok" class="btn btn-sm btn-primary float-right">Suivant</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
            </div>

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- Main Footer -->
        <?php include 'assets/footer.php' ?>
        <!-- ./wrapper -->
        <?php include 'assets/script.php' ?>
    </div>
</body>

</html>