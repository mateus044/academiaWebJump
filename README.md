# README

<p align="center">Backend Academia WebJump Trilha01</p>

<p align="center">
    <a href="#Login">Login</a> -
    <a href="#Criar Correntista">Criar Correntista</a> -
    <a href="#Conta">criar conta bancaria</a> -
    <a href="#Depositar">Depositar</a> -
    <a href="#Retirar">Retirar</a> -
    <a href="#Transferir">Transferência</a>
</p>


# Login
<br>
<h3>Login</h3>
<br>
<p>Para efetuar o login e assim gerar o token que permitirá a execução das principais funcionalidades, basta inserir os seguintes dados.</p>

    * Rota: http://webjump.academia.localhost/login

    {
        "login": 123456879
        "password":123456
    }

    * login: CPF ou CNPJ cadastrado.
    * password: senha cadastrada.



# Criar Correntista

<br>

<p>Para cadastrar um correntista basta passar as seguintes informações.</p>

    *Rota: http://webjump.academia.localhost/storage

    {
      	"name":"Samara",
	    "cpf":null,
	    "cnpj":null,
	    "password":"123456",
	    "rg":"48.579.005-1",
	    "stateRegistration":"066.201.087.346",
 	    "birthDate":"14-01-2022",
 	    "foundationDate":"16-11-2003",
	    "cellphone":"2799778-4554",  
        
        "address":{
            "street":"50",
		 	"number":"100",
		 	"cep":"38441-294",
		 	"city":"Valaquia",
		 	"uf":"GO" 
        }
    }

    *OBS: Não é possivel cadastrar um correntista com um CPF e um CNPJ ao mesmo tempo. Os demais campos são obrigatorios.

# Conta

<br>

<p>Tendo um correntista cadastrado, para adicionar uma conta bancaria basta informar as seguintes informações.</p>

    * Rota: http://webjump.academia.localhost/accountholder/createAccount

    {
        "accountHolder":3,
		"value":0.00
    }

    *OBS: O campo <strong>accountHolder</strong> é o ID do correntista que adicionaremos uma conta bancaria.

<br>

# Depositar

<br>

<p>Para efetuarmos um deposito, basta informar as seguintes informações.</p>

    * Rota: http://webjump.academia.localhost/accountholder/deposit

    {
        "accountHolder":2,
	    "value": 40000.00
    }

    *OBS: O campo <strong>accountHolder</strong> é o ID do correntista que faremos o deposito.


<br>

# Retirar

<p>Para retiar algum valor da conta, basta informar as seguintes informações.</p>

    *Rota: http://webjump.academia.localhost/accountholder/withdraw

    {
        "accountHolder":2,
	    "value": 2000.00
    }

    *OBS: O campo <strong>accountHolder</strong> é o ID do correntista que faremos a retirada.

<br>

# Transferir

<p>Para efetuarmos uma transferência, basta informar as seguintes informações.</p>

    * Rota: http://webjump.academia.localhost/accountholder/transfer

    {
        "accountHolder": 2,
		"numberAccount":40380712194128,
	    "value": 6500.90
    }

    *accountHolder: Refere ao ID do correntista que fara a transferência.
    *numberAccount: Número da conta do correntista que receberá a transferência.
    *value: valor da transferência.






