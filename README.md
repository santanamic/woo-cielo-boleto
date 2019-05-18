<p align="center">
  <a href="#">
    <img width="300" alt="PicPay WooCommerce" src="https://santanamic.github.io/woo-cielo-boleto/_media/logo.svg">
  </a>
</p>

<p align="center">
  Receba Pagamentos com PicPay no WooCommerce.
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/php->=5.6-8892BF.svg"></a>
  <a href="#"><img src="https://img.shields.io/badge/license-GPLv2-brightgreen.svg?style=flat-square"></a>
  <a href="#"><img src="https://img.shields.io/appveyor/ci/gruntjs/grunt.svg"></a>
  <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SFLXNSMJU6S6G&source=url"><img src="https://img.shields.io/badge/%24-donate-ff69b4.svg?style=flat-square"></a>
  <a href="#"><img src="https://img.shields.io/badge/version-1.2.0-orange.svg"></a>
  <a href="#"><img src="https://img.shields.io/badge/wordpress-%3E%3D%204.6-blue.svg"></a>
</p>


WooCommerce PicPay Pagamentos permite que sua loja aceite pagamentos via PicPay. Os usuários são redirecionados para o site do PicPay onde podem concluir o pagamento usando seus smartphones. 

## Links

- [Ponto de partida](https://santanamic.github.io/woo-cielo-boleto/#/README)
- [Obtendo credenciais](https://santanamic.github.io/woo-cielo-boleto/#/credentials)
- [Processo de compra](https://santanamic.github.io/woo-cielo-boleto/#/process)
- [Perguntas Frequentes](https://santanamic.github.io/woo-cielo-boleto/#/faq)
 
## Instalação

1. Acesse o painel de administrador do WordPress.
2. Na barra lateral direita, vá para: Plugins > Adicionar novo.
3. No campo de buscas entre com "WooCommerce PicPay Pagamentos". 
4. Selecione nosso plugin na lista e clique em "Instalar agora".
5. Por fim, clique no botão "Ativar" após a instalação.

## Requisitos

- Uma conta PicPay e-commerce
- Credenciais de acesso para API. [Clique aqui para obter.](https://lojista.picpay.com/dashboard/ecommerce-token "Credenciais PicPay")
- Plugin "WooCommerce" ativado e instalado.
- Plugin "WooCommerce Extra Checkout Fields for Brazil" ativado e instalado.
- Versão mínima do PHP  5.6

## Ativando forma de pagamento

1. Acesse o painel de administrador do WordPress.
2. Na barra lateral direita, vá para: WooCommerce > Configurações.
3. Na nova página aberta localize e selecione a aba "Pagamentos".
4. Marque o boão corresponente ao "PicPay Pagamentos" para selecioná-lo como ativo no checkout.
5. Click em "Gerenciar" para abrir a tela principal de configurações.

## Configuração

Na tela de configurções do plugin insira as demais informações:

- **Ativar / Desativar**  - Ativar para usar. Desativar para desligar.
- **Título**  - Escolha o título exibido aos clientes durante o checkout.
- **Descrição**  - Adicionar informações mostradas aos clientes no checkout.
- **x-picpay-token** - Token Único para comunicação com a API.
- **x-seller-token** - Token Único para validação de endpoint.
- **Habilitar Log** - Quando estiver marcado ativa o registro de log para o plugin.

