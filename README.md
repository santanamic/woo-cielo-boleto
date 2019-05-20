<p align="center">
  <a href="#">
    <img width="300" alt="WooCommerce Cielo Boleto" src="https://santanamic.github.io/woo-cielo-boleto/_media/logo.svg">
  </a>
</p> 

<p align="center">
  Emita boletos usando a API Cielo eCommerce v3.
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/php->=5.6-8892BF.svg"></a>
  <a href="#"><img src="https://img.shields.io/badge/license-GPLv2-brightgreen.svg?style=flat-square"></a>
  <a href="#"><img src="https://img.shields.io/appveyor/ci/gruntjs/grunt.svg"></a>
  <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SFLXNSMJU6S6G&source=url"><img src="https://img.shields.io/badge/%24-donate-ff69b4.svg?style=flat-square"></a>
  <a href="#"><img src="https://img.shields.io/badge/version-1.0.1-orange.svg"></a>
  <a href="#"><img src="https://img.shields.io/badge/wordpress-%3E%3D%204.6-blue.svg"></a>
</p>


O plugin WooCommerce Cielo Boleto permite que lojistas aceitem pagamentos via boleto usando a API Cielo. Ao finlizar uma compra os usuários são redirecionados para a URL do boleto.

[Acesse a documentação para mais informações](https://santanamic.github.io/woo-cielo-boleto/)

## Links

- [Cadastro Cielo](https://www.cielo.com.br/e-commerce/)
- [Obtendo Credenciais](https://santanamic.github.io/woo-cielo-boleto/#/?id=obtendo-credenciais)
- [Processo de compra](https://santanamic.github.io/woo-cielo-boleto/#/?id=processo-de-compra)
- [Perguntas Frequentes](https://santanamic.github.io/woo-cielo-boleto/#/?id=perguntas-frequentes)

## Instalação

1. Acesse o painel de administrador do WordPress.
2. Na barra lateral direita, vá para: Plugins > Adicionar novo.
3. No campo de buscas entre com "WooCommerce Cielo Boleto". 
4. Selecione nosso plugin na lista e clique em "Instalar agora".
5. Por fim, clique no botão "Ativar" após a instalação.

## Requisitos

- Uma conta Cielo e-commerce
- Credenciais de acesso para API. (As credenciais são obtidas através do suporte Cielo)
- Certificado SSL.
- Plugin "WooCommerce" ativado e instalado.
- Plugin "WooCommerce Extra Checkout Fields for Brazil" ativado e instalado.
- Versão mínima do PHP  5.6

## Ativando forma de pagamento

1. Acesse o painel de administrador do WordPress.
2. Na barra lateral direita, vá para: WooCommerce > Configurações.
3. Na nova página aberta localize e selecione a aba "Pagamentos".
4. Marque o boão corresponente ao "Cielo Boleto" para selecioná-lo como ativo no checkout.
5. Click em "Gerenciar" para abrir a tela principal de configurações.

## Configuração

Na tela de configurções do plugin insira as demais informações:

- **Ativar / Desativar**  - Ativar para usar. Desativar para desligar.
- **Título**  - Escolha o título exibido aos clientes durante o checkout.
- **Descrição**  - Adicionar informações mostradas aos clientes no checkout.
- **MerchantId** - Identificador da loja na API Cielo eCommerce.	.
- **MerchantKey** - Chave Publica para Autenticação Dupla na API Cielo eCommerce.
- **Boleto Vencimento** - O número de dias para o vencimento do Boleto.
- **Boleto Provider** - Banco emissor, cadastrado junto ao suporte Cielo.
- **Key da URL de notificação** - Um parâmetro key para a validação do header da requisição.
- **Value da URL de notificação** - Um parâmetro value para a validação do header da requisição.
- **Sandbox Merchant ID** - Merchant ID do sandbox.
- **Sandbox Merchant Key** - Merchant Key do sandbox.
- **Habilitar Log** - Quando estiver marcado ativa o registro de log para o plugin.