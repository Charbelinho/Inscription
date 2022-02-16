<?php
include '../db.php';

//récupère le dernier article dans la base de données

$dos = $bdd->query('SELECT * FROM dossier ORDER BY num DESC LIMIT 1');
$dernier_dossier = $dos->fetch();
$dos->closeCursor();
$increment = "DOSSIER_1";

/*
Si le dernier dossier n'est pas vide, ce qui montre qu'il y a des données dans la base de données
 */
if (!empty($dernier_dossier)) {

    /*
     * Je sépare le mot dossie de la partie à incrémenter
     * $part[0] aura le mot DOSSIER et $part[1] aura le dernier l'id (ex 1)
     */
    $part = explode('_', $dernier_dossier['num']);

    /*
     * J'incrémente la partie incrémentable et je le concatène sur le mot dossie.
     * J'ai profité au passage pour caster $part[1] en int pour s'assurer que j'aurais bien une
     * valeur numérique à incrémenter
     */
    $increment = $part[0] . '_' . (int)$part[1] += 1;
}

//Requete pour recupérer le matricule du dernier etudiant enrégistrer
$matetud = $bdd->query('SELECT mat FROM etudiant ORDER BY mat DESC LIMIT 1')->fetch();

//Requête pour récupérer les infos concernant la filière
$fil = $bdd->query('SELECT * FROM filiere')->fetchAll();

//Requête pour recuperer le dernier diplome et le niveau d'étude
$last_diplome = $bdd->query('SELECT * FROM diplome')->fetchAll();
$level = $bdd->query('SELECT * FROM niveau_etude')->fetchAll();

if (isset($_POST['ok'])) {
    //Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    if ($_FILES['my_file']['error']) {
        switch ($_FILES['my_file']['error']) {
            case 1: // UPLOAD_ERR_INI_SIZE
                echo "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
                break;
            case 2: // UPLOAD_ERR_FORM_SIZE
                echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
                break;
            case 3: // UPLOAD_ERR_PARTIAL
                echo "L'envoi du fichier a été interrompu pendant le transfert !";
                break;
            case 4: // UPLOAD_ERR_NO_FILE
                echo "Le fichier que vous avez envoyé a une taille nulle !";
                break;
        }
    } else {
        $nom = $_FILES['my_file']['tmp_name'];
        $nomdestination = './dossierEtudiant/';
        move_uploaded_file($nom, $nomdestination);
    }
    //Insertion des infos concernant la filiere,le niveau d'etude et le dossier de l'etudiant
    $req = $bdd->prepare('INSERT INTO dossier(num,mat_etud,id_diplome,code_fil,id_niveau_etude,date_enregistrement,contenu_dossier) VALUES (?,?,?,?,?,?,?)');
    $exec = $req->execute([$increment, $matetud['mat'],$_POST['lastdiplome'], $_POST['fil'], $_POST['niveau'], $_POST['hid'], $_FILES['my_file']['name']]);
    if ($exec) {
        $mess = 'Pré-inscription éffectuée avec succès';
        header('location: ../index.php?mess=$mess');
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
                                    <div class="col-lg-3">

                                    </div>
                                    <div class="col-lg-6 col-sm-6" style="margin-top: 8%;">
                                        <div class="card card-outline card-success">
                                            <div class="card-header">
                                                Diplôme obtenu
                                            </div>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="genre" class="col-sm-4">Niveau d'étude</label>
                                                        <div class="col-sm-8">
                                                            <select name="niveau" id="" class="form-control form-control-sm select2 niveau" required>
                                                                <option value="">Sélectionner un niveau</option>
                                                                <?php foreach ($level as $niveau) { ?>
                                                                    <option value="<?= $niveau["id"] ?>"><?= $niveau["niveau"] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="lastdiplome" class="col-sm-4">Dernier Diplôme</label>
                                                        <div class="col-sm-8">
                                                            <select name="lastdiplome" id="" class="form-control form-control-sm select2 lastdiplome" required>
                                                                <option value="">Sélectionner votre dernier diplôme</option>
                                                                <?php foreach ($last_diplome as $diplome) { ?>
                                                                    <option value="<?= $diplome["id"] ?>"><?= $diplome["dernier_diplome"] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="filiere" class="col-sm-4">Filière souhaitée</label>
                                                        <div class="col-sm-8">
                                                            <select name="fil" id="" class="form-control form-control-sm select2 filiere" required>
                                                                <option value="">Sélectionner votre Filière souhaitée</option>
                                                                <?php
                                                                foreach ($fil as $key) { ?>
                                                                    <option value="<?= $key['code_filiere'] ?>"><?= $key['description'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="hid" value="<?= date("Y-m-d")?>">
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="custom-file">
                                                            <input type="file" name="my_file" class="custom-file-input" id="customFileLang" lang="fr" required>
                                                            <label class="custom-file-label" for="customFileLang" data-browse="Choisir">Fichier(s) à joindre </label>
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