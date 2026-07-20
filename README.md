# Sistema de Controle e Cadastro de Cidadãos

Aplicação web desenvolvida como projeto técnico para processo seletivo de estágio. O sistema permite realizar o cadastro estruturado de cidadãos brasileiros com validação matemática automática de CPF (Módulo 11), prevenção de duplicidade e consulta integrada por Nome ou CPF.

---

## Tecnologias e Arquitetura

- **Backend:** PHP 8.5.8
- **Frontend:** HTML5, CSS3 Moderno (Variáveis Nativas) e JavaScript Vanilla (Máscara Dinâmica)
- **Banco de Dados:** SQLite (Armazenamento leve e portátil em arquivo local)
- **Gerenciador de Pacotes & Autoload:** Composer (Padrão PSR-4)
- **Testes Automatizados:** PHPUnit
- **Padrões Arquiteturais:** MVC (Model-View-Controller) & Singleton (Conexão PDO)

---

## Funcionalidades e Diferenciais Técnicos

- ✅ **Validação Matemática do CPF:** Algoritmo oficial de verificação dos dois dígitos verificadores (Módulo 11 da Receita Federal).
- ✅ **Tratamento de Duplicidade:** Se um CPF já estiver cadastrado, a aplicação intercepta a requisição e exibe o Nome e o CPF da pessoa cadastrada.
- ✅ **Máscara Dinâmica em Tempo Real:** JavaScript no frontend formatando a digitação no padrão `000.000.000-00`.
- ✅ **Sanitização de Dados:** O backend limpa caracteres especiais e armazena apenas os 11 dígitos numéricos puros no banco de dados.
- ✅ **Segurança contra SQL Injection:** Uso rigoroso de *Prepared Statements* via PDO.
- ✅ **Consulta Híbrida:** Busca inteligente por aproximação de Nome (`LIKE`) ou exata por CPF.
- ✅ **Testes Automatizados:** Suíte de testes unitários validando casos de borda do algoritmo de CPF.

---

## Estrutura do Projeto

```text
cadastro-cidadao/
│
├── src/
│   ├── config/
│   │   └── Database.php          # Conexão PDO SQLite (Singleton)
│   ├── controllers/
│   │   └── CidadaoController.php # Orquestrador da regra de negócio (MVC)
│   ├── models/
│   │   ├── Cidadao.php           # Operações de banco (SQL)
│   │   └── ValidadorCPF.php      # Algoritmo Módulo 11 do CPF
│   └── views/
│       └── main_view.php         # Interface do usuário (HTML/PHP)
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css         # Estilização responsiva
│   │   └── js/
│   │       └── main.js           # Máscara em tempo real
│   └── index.php                 # Front Controller / Ponto de Entrada
│
├── database/
│   └── database.sqlite           # Gerado automaticamente no 1º acesso
│
├── tests/
│   └── ValidadorCPFTest.php      # Testes unitários com PHPUnit
│
├── composer.json                 # Mapeamento do Autoload (PSR-4)
├── phpunit.xml                   # Configuração da suíte de testes
└── README.md                     # Documentação
```

---

## Como Executar a Aplicação

### Pré-requisitos

- PHP **8.0** ou superior instalado.
- Composer instalado.

### 1. Clonar o Repositório

```bash
git clone https://github.com/seu-usuario/cadastro-cidadao.git
cd cadastro-cidadao
```

### 2. Instalar as Dependências

```bash
composer install
```

### 3. Iniciar o Servidor Embutido do PHP

Execute o comando abaixo apontando para a pasta `public`:

```bash
php -S localhost:8000 -t public
```

### 4. Acessar a Aplicação

Abra o navegador e acesse:

```text
http://localhost:8000
```

> **Observação:** O arquivo `database.sqlite` será criado automaticamente na pasta `database/` no primeiro acesso.

---

## Como Executar os Testes Automatizados

Após instalar as dependências com `composer install`, execute:

### Linux / macOS

```bash
./vendor/bin/phpunit
```

### Windows (PowerShell ou CMD)

```bash
vendor\bin\phpunit
```

### Casos de Teste Cobertos

- ✅ Aceitação de CPFs matematicamente válidos.
- ✅ Rejeição de CPFs com dígitos repetidos (ex.: `111.111.111-11`).
- ✅ Rejeição de CPFs incompletos ou inválidos.
- ✅ Validação do algoritmo oficial de cálculo dos dígitos verificadores.

---

## Como Resetar a Base de Dados

Como o projeto utiliza **SQLite**, limpar os dados é muito simples:

1. Exclua o arquivo:

```text
database/database.sqlite
```

2. Recarregue a aplicação (`F5`).

3. O sistema recriará automaticamente o banco de dados e a estrutura necessária.

---

## Observações Técnicas

- O banco de dados é criado automaticamente na primeira execução.
- Os CPFs são armazenados apenas com seus **11 dígitos numéricos**, independentemente da máscara utilizada no formulário.
- Toda comunicação com o banco é realizada por meio de **Prepared Statements**, prevenindo ataques de SQL Injection.
- O projeto segue a arquitetura **MVC**, utilizando **Composer (PSR-4)** para autoload e **PDO** para acesso ao banco de dados.

---

## Autor

Desenvolvido por **Gustavo Rodrigues de Oliveira** como projeto técnico para processo seletivo de estágio.
