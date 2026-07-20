<?php
namespace App\Controllers;

use App\Models\Cidadao;
use App\Models\ValidadorCPF;

class CidadaoController {
    private Cidadao $model;

    public function __construct() {
        $this->model = new Cidadao();
    }

    // Processa a requisição de cadastro
    public function cadastrar(): array {
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');

        // Validações de Campos Obrigatórios
        if (empty($nome)) {
            return ['status' => 'erro', 'mensagem' => 'Nome obrigatório.'];
        }
        if (empty($cpf)) {
            return ['status' => 'erro', 'mensagem' => 'CPF obrigatório.'];
        }

        // Limpa o CPF para trabalhar apenas com os 11 números brutos
        $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf);

        // Validação Matemática do CPF
        if (!ValidadorCPF::validar($cpfLimpo)) {
            return ['status' => 'erro', 'mensagem' => 'CPF inválido.'];
        }

        // --- BLOCO ATUALIZADO: Tratamento de duplicidade de CPF ---
        if ($this->model->cpfExiste($cpfLimpo)) {
            // Busca o registro existente no banco de dados para recuperar o nome
            $registroExistente = $this->model->buscar($cpfLimpo);
            
            if (!empty($registroExistente)) {
                $cidadao = $registroExistente[0];
                return [
                    'status' => 'sucesso', 
                    'mensagem' => 'Cidadão já cadastrado no sistema!',
                    'dados' => [
                        'nome' => $cidadao['nome'], 
                        // Formata o CPF recuperado com a máscara visual na tela
                        'cpf' => substr($cidadao['cpf'], 0, 3) . '.' . substr($cidadao['cpf'], 3, 3) . '.' . substr($cidadao['cpf'], 6, 3) . '-' . substr($cidadao['cpf'], 9, 2)
                    ]
                ];
            }
        }

        // Se tudo estiver correto e não for duplicado, tenta salvar
        if ($this->model->salvar($nome, $cpfLimpo)) {
            // --- AJUSTE AQUI: Reconstrói a máscara a partir do CPF limpo ---
            $cpfFormatado = substr($cpfLimpo, 0, 3) . '.' . substr($cpfLimpo, 3, 3) . '.' . substr($cpfLimpo, 6, 3) . '-' . substr($cpfLimpo, 9, 2);

            return [
                'status' => 'sucesso', 
                'mensagem' => 'Cadastro realizado com sucesso.',
                'dados' => ['nome' => $nome, 'cpf' => $cpfFormatado] // Retorna formatado perfeitamente
            ];
        }

        return ['status' => 'erro', 'mensagem' => 'Erro interno ao salvar dados.'];
    }

    // Processa a requisição de busca
    public function pesquisar(): array {
        $termo = trim($_GET['busca'] ?? '');
        if (empty($termo)) {
            return ['status' => 'erro', 'mensagem' => 'Digite um termo para pesquisar.'];
        }

        $termoLimpo = preg_replace('/[^0-9]/', '', $termo);
        $buscaFinal = empty($termoLimpo) ? $termo : $termoLimpo;

        $resultados = $this->model->buscar($buscaFinal);

        if (empty($resultados)) {
            return ['status' => 'erro', 'mensagem' => 'Cidadão não encontrado.'];
        }

        return ['status' => 'sucesso', 'dados' => $resultados];
    }
}