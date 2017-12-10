<?php
require_once 'classes\User.class.php';
require_once 'classes\Funcoes.class.php';

$objUser = new User();

session_start();
if(isset($_SESSION['count'])){
    $count = $_SESSION['count'];
    $count++; 
    $count = $_SESSION['count'] = $count;
} else {
    $count = $_SESSION['count'] = 0;
}
if($count == 0){
    $idusario = (int)$_SESSION['user'];
    $objUser->addtolog($idusario);
}

if ($_SESSION['logado'] == "sim") {
    $objUser->userlogado($_SESSION['user']);
    
} else {
    header('location: /MPSCloud/');
}

if (!empty($_GET['sair']) == "sim") {
    $objUser->logout();
}



?>

<!doctype html>
<html lang="pt-br">

<head>
<title>MPS Cloud</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="/MPSCloud/assets/css/dashboard.css">

</head>
<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        MPS CLOUD
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                </li>
                <li>
                    <a href="?sair=sim">Sair</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <header>
                    <h1 style="display: inline-block; text-transform: capitalize;">Olá <?php echo $_SESSION['nome'] ?></h1>
                    <a  style="background: #e2e2e2;  padding: 6px 20px;    border-radius: 9px;    margin: 0 20px;    border: 3px solid #000;    text-transform: uppercase;    font-weight: bold;    color: #000;" href="?sair=sim">Sair</a>
                </header>
                <h4>O seu dados de acessos</h4>
                <table class="table">
                    <tr>
                        <th>Usuário</th>
                        <th>Último acesso</th>
                      </tr>
                    <?php 
                    $var = $objUser->logdeacesso($_SESSION['user']);
                    foreach ($var as $rst) { ?>
                        <tr>
                            <th><?=$rst['nome']?></th>
                            <th><?=$rst['data_acesso']?></th>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/MPSCloud/assets/js/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


    <!-- JS -->
    <script src="/MPSCloud/assets/js/login.js"></script>
    <script type="text/javascript">
        $("#wrapper").toggleClass("toggled");
    </script>


</body>

</html>