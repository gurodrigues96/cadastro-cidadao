# 🇧🇷 Sistema de Controle e Cadastro de Cidadãos

Aplicação web desenvolvida como projeto técnico para processo seletivo de estágio. O sistema permite realizar o cadastro estruturado de cidadãos brasileiros com validação matemática automática de CPF (Módulo 11), prevenção de duplicidade e consulta integrada por Nome ou CPF.

---

## 🛠️ Tecnologias e Arquitetura

- **Backend:** PHP 8.x
- **Frontend:** HTML5, CSS3 Moderno (Variáveis Nativas) e JavaScript Vanilla (Máscara Dinâmica)
- **Banco de Dados:** SQLite (Armazenamento leve e portátil em arquivo local)
- **Gerenciador de Pacotes & Autoload:** Composer (Padrão PSR-4)
- **Testes Automatizados:** PHPUnit
- **Padrões Arquiteturais:** MVC (Model-View-Controller) & Singleton (Conexão PDO)

---

## ✨ Funcionalidades e Diferenciais Técnicos

- [x] **Validação Matemática do CPF:** Algoritmo oficial de verificação dos dois dígitos verificadores (Módulo 11 da Receita Federal).
- [x] **Tratamento de Duplicidade:** Se um CPF já estiver cadastrado, a aplicação intercepta a requisição e exibe o Nome e o CPF da pessoa cadastrada.
- [x] **Máscara Dinâmica em Tempo Real:** JavaScript no frontend formatando a digitação no padrão `000.000.000-00`.
- [x] **Sanitização de Dados:** O backend limpa caracteres especiais e armazena apenas os 11 dígitos numéricos puros no banco de dados.
- [x] **Segurança SQL Injection:** Uso rigoroso de *Prepared Statements* via PDO PHP.
- [x] **Consulta Híbrida:** Busca inteligente por aproximação de Nome (`LIKE`) ou exata por CPF.
- [x] **Testes Automatizados:** Suíte de testes unitários validando casos de borda do algoritmo de CPF.

---

## 📁 Estrutura do Projeto

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