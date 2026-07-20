<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Nacional de Cidadãos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Controle de Cidadãos Brasileiros</h1>
        
        <div class="card">
            <h2>Novo Cadastro</h2>
            
            <?php if (isset($respostaCadastro)): ?>
                <div class="alert <?= $respostaCadastro['status'] === 'sucesso' ? 'alert-success' : 'alert-danger' ?>">
                    <?= htmlspecialchars($respostaCadastro['mensagem']) ?>
                </div>
                <?php if ($respostaCadastro['status'] === 'sucesso'): ?>
                    <div class="dados-retorno">
                        <p><strong>Dados Cadastrados:</strong></p>
                        <p>Nome: <?= htmlspecialchars($respostaCadastro['dados']['nome']) ?></p>
                        <p>CPF: <?= htmlspecialchars($respostaCadastro['dados']['cpf']) ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form action="index.php" method="POST">
                <input type="hidden" name="action" value="cadastrar">
                
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF *</label>
                    <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" required>
                </div>

                <button type="submit" class="btn-primary">Cadastrar Cidadão</button>
            </form>
        </div>

        <div class="card">
            <h2>Consultar Cidadão</h2>
            <form action="index.php" method="GET">
                <div class="search-group">
                    <input type="text" name="busca" placeholder="Pesquise por Nome ou CPF..." required value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
                    <button type="submit" class="btn-secondary">Buscar</button>
                </div>
            </form>

            <?php if (isset($respostaBusca)): ?>
                <div class="resultado-busca">
                    <?php if ($respostaBusca['status'] === 'sucesso'): ?>
                        <table class="table-resultados">
                            <thead>
                                <tr>
                                    <th>Nome do Cidadão</th>
                                    <th>CPF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($respostaBusca['dados'] as $c): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($c['nome']) ?></td>
                                        <td>
                                            <?php 
                                            if (strlen($c['cpf']) === 11) {
                                                echo htmlspecialchars(substr($c['cpf'], 0, 3) . '.' . substr($c['cpf'], 3, 3) . '.' . substr($c['cpf'], 6, 3) . '-' . substr($c['cpf'], 9, 2));
                                            } else {
                                                echo htmlspecialchars($c['cpf']);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-error"><?= htmlspecialchars($respostaBusca['mensagem']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>