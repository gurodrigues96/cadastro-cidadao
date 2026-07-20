<?php
require_once __DIR__ . '/../src/config/Database.php';
require_once __DIR__ . '/../src/models/Cidadao.php';
require_once __DIR__ . '/../src/models/ValidadorCPF.php';
require_once __DIR__ . '/../src/controllers/CidadaoController.php';

use App\Controllers\CidadaoController;

$controller = new CidadaoController();$respostaCadastro = null;
$respostaBusca = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) &&$_POST['action'] === 'cadastrar') {
    $respostaCadastro =$controller->cadastrar();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['busca'])) {
    $respostaBusca =$controller->pesquisar();
}

require_once __DIR__ . '/../src/views/main_view.php';