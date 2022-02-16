<?php
include '../db.php';

//récupère le dernier article dans la base de données

$req = $bdd->query('SELECT * FROM etudiant ORDER BY mat DESC LIMIT 1');
$dernier_etudiant = $req->fetch();
$req->closeCursor();
$increment = "ETUDIANT_1";

/*
Si le dernier etudiant n'est pas vide, ce qui montre qu'il y a des données dans la base de données
 */
if (!empty($dernier_etudiant)) {

    /*
     * Je sépare le mot etudiant de la partie à incrémenter
     * $part[0] aura le mot ETUDIANT et $part[1] aura le dernier l'id (ex 1)
     */
    $part = explode('_', $dernier_etudiant['mat']);

    /*
     * J'incrémente la partie incrémentable et je le concatène sur le mot etudiant.
     * J'ai profité au passage pour caster $part[1] en int pour s'assurer que j'aurais bien une
     * valeur numérique à incrémenter
     */
    $increment = $part[0] . '_' . (int)$part[1] += 1;
}
function valid_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['ok'])) {
    $req = $bdd->prepare("INSERT INTO etudiant(mat,nom_etudiant,pnom_etudiant,date_naissance,contact,mail,genre) VALUES(?,?,?,?,?,?,?)");
    $res = $req->execute([$increment, valid_data($_POST['nom']), valid_data($_POST['prenom']), $_POST['date'], $_POST['contact'], valid_data($_POST['mail']), $_POST['genre']]);
    if ($res) {
        header("location: newNext.php");
    }
}
?>
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
                                    <div class="col-lg-3 col-sm-3">

                                    </div>
                                    <div class="col-lg-6 col-sm-6" style="margin-top: 6%;">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                Informations de Base
                                            </div>
                                            <form role="form" method="post" id="info">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="pseudo" class="col-sm-2">Nom</label>
                                                        <div class="col-sm-10 ">
                                                            <input type="text" class="form-control form-control-sm" id="nom" name="nom" value="" placeholder="Entrer votre nom" required pattern="[A-Za-z]{2,15}" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="prenom" class="col-sm-2">Prénom(s)</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" value="" placeholder="Entrer le(s) Prénom(s)" required pattern="[A-Za-z\s]{4,40}" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-lg-2 col-md-2 col-sm-2" for="">Date de naissance</label>
                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                            <div id="datepicker" class="input-group input-group-sm date" data-target-input="nearest">
                                                                <input type="date" class="form-control datetimepicker-input " name="date" data-target="#datepicker" required min="1990-01-01" max="2005-01-01" />
                                                                <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                                                    <div class="input-group-text" id="inputGroupappend">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="genre" class="col-sm-2">Genre</label>
                                                        <div class="col-sm-10">
                                                            <select name="genre" id="" class="form-control form-control-sm select2 genre" required>
                                                                <option value="">Sélectionner un genre</option>
                                                                <option value="M">Masculin</option>
                                                                <option value="F">Féminin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="contact" class="col-sm-2">Contact</label>
                                                        <div class="col-sm-10">
                                                            <input type="tel" class="form-control form-control-sm" id="contact" name="contact" value="" placeholder="Entrer votre contact" required minlength="10" maxlength="14" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="mail" class="col-sm-2">Email</label>
                                                        <div class="col-sm-10">
                                                            <input type="mail" class="form-control form-control-sm" id="mail" name="mail" value="" placeholder="Entrer votre mail" required pattern="[A-Za-z0-9]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" name="ok" class="btn btn-sm btn-success float-right">Suivant</button>
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