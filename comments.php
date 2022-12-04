<?php include_once 'dbconfig.class.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Les Avis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <style type="text/css">
        body {
            margin-top: 20px;
        }

        .content-item {
            padding: 30px 0;
            background-color: #FFFFFF;
        }

        .content-item.grey {
            background-color: #F0F0F0;
            padding: 50px 0;
            height: 100%;
        }

        .content-item h2 {
            font-weight: 700;
            font-size: 35px;
            line-height: 45px;
            text-transform: uppercase;
            margin: 20px 0;
        }

        .content-item h3 {
            font-weight: 400;
            font-size: 20px;
            color: #555555;
            margin: 10px 0 15px;
            padding: 0;
        }

        .content-headline {
            height: 1px;
            text-align: center;
            margin: 20px 0 70px;
        }

        .content-headline h2 {
            background-color: #FFFFFF;
            display: inline-block;
            margin: -20px auto 0;
            padding: 0 20px;
        }

        .grey .content-headline h2 {
            background-color: #F0F0F0;
        }

        .content-headline h3 {
            font-size: 14px;
            color: #AAAAAA;
            display: block;
        }


        #comments {
            box-shadow: 0 -1px 6px 1px rgba(0, 0, 0, 0.1);
            background-color: #FFFFFF;
        }

        #comments form {
            margin-bottom: 30px;
        }

        #comments .btn {
            margin-top: 7px;
        }

        #comments form fieldset {
            clear: both;
        }

        #comments form textarea {
            height: 100px;
        }

        #comments .media {
            border-top: 1px dashed #DDDDDD;
            padding: 20px 0;
            margin: 0;
        }

        #comments .media>.pull-left {
            margin-right: 20px;
        }

        #comments .media img {
            max-width: 100px;
        }

        #comments .media h4 {
            margin: 0 0 10px;
        }

        #comments .media h4 span {
            font-size: 14px;
            float: right;
            color: #999999;
        }

        #comments .media p {
            margin-bottom: 15px;
            text-align: justify;
        }

        #comments .media-detail {
            margin: 0;
        }

        #comments .media-detail li {
            color: #AAAAAA;
            font-size: 12px;
            padding-right: 10px;
            font-weight: 600;
        }

        #comments .media-detail a:hover {
            text-decoration: underline;
        }

        #comments .media-detail li:last-child {
            padding-right: 0;
        }

        #comments .media-detail li i {
            color: #666666;
            font-size: 15px;
            margin-right: 10px;
        }
    </style>


</head>

<body>
    <section class="content-item" id="comments">
        <a class="btn btn-warning fw-bold " href="view" style="width: 15%;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Retour</a>
        <div class="d-flex justify-content-center align-items-center container">
            <div class="">
                <?php
                $database = new Connection();
                $db = $database->openConnection();
                //insert comment
                if(isset($_POST['btn_comnt'])){
                    @$full_name = $_POST['full_name'];
                    @$email = $_POST['email'];
                    @$comment = $_POST['comments'];
                    $query = "INSERT INTO comments (desc_com,id_img,full_name,email,date_created) VALUES(?,?,?,?,?)";
                    $statement = $db->prepare($query);
                    date_default_timezone_set('Europe/Madrid');
                    $statement->execute([$comment, $_REQUEST['id'], $full_name,$email,date('Y-m-d H:i:s')]);
                }
                
                //select image on comments page
                $stmt = $db->prepare('select * from images where id=' . $_REQUEST["id"] . '');
                $stmt->execute();
                $imagelist = $stmt->fetch();
                ?>
                <div class="w-50 ml-0 mr-0 mx-auto">
                    <img src="<?php echo $imagelist['image'] ?>" class="" alt="" width="360" height="360">

                </div>
                <form class="form" method="POST" action="">

                    <h2 class="h2"><span class="badge rounded-pill bg-info" style="text-transform: initial;">Ajouter un nouveau commentaire :</span></h2>
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-2 col-xs-1">
                                <img class="rounded-pill" src="uploads/koko.jpg" alt="" width="100" height="100">
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input class="form-control" name="full_name" type="text" placeholder="Nom complet" required>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group fl_icon">
                                    <div class="icon"><i class="fa fa-envelope-o"></i></div>
                                    <input class="form-control" name="email" type="email" placeholder="email" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control mt-2" name="comments" required="" placeholder="votre commentaire"></textarea>
                                </div>
                            </div class="col-sm-12">
                            <button type="submit" name="btn_comnt" class="btn btn-success fw-bold">Envoyer</button>
                        </div>
                    </fieldset>
                </form>
                <?php
                //select total comments
                $stmt2 = $db->prepare("SELECT count(*) as 'total' from comments where id_img=" . $_REQUEST["id"]);
                $stmt2->execute();
                $count = $stmt2->fetch();
                ?>
                <h3><span class="badge bg-primary rounded-pill"><?php echo $count['total'] ?> commentaire</span></h3>

                <!-- COMMENT 1 - START -->
                <?php
                $stmt2 = $db->prepare('SELECT * from comments where id_img=' . $_REQUEST['id'] . '');
                $stmt2->execute();
                $comment = $stmt2->fetchAll();
                foreach ($comment as $avis) {
                ?>
                    <div class="media">
                        <a class="pull-left" href="#"><img class="media-object" src="uploads/profile.jpg" alt=""></a>
                        <div class="media-body">
                            <h3 class="h3"><span class="badge bg-black rounded-pill"><?php echo $avis['full_name'] ?></span></h3>
                            <p><?php echo $avis['desc_com'] ?></p>
                            <ul class="list-unstyled list-inline media-detail ">
                                <li ><i class="fa fa-calendar"></i ><span class="badge bg-secondary"><?php echo $avis['date_created'] ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- COMMENT 1 - END -->
                <?php
                    //end boucle
                    $database->closeConnection();
                }
                ?>



            </div>
    </section>


    <script type="text/javascript">

    </script>
</body>

</html>