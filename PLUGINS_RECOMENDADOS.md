# Plugins Recomendados para Arqfy

Este documento lista os plugins recomendados para otimizar sua loja Arqfy.

---

## 1. 🚀 Cache & Performance

### LiteSpeed Cache
- **URL Oficial**: https://wordpress.org/plugins/litespeed-cache/
- **Tipo**: Cache de Alta Performance
- **Benefícios**:
  - Cache de página completa (até 10x mais rápido)
  - Otimização automática de imagens
  - Minificação de CSS/JS
  - CDN integrado gratuito
  - Suporte a HTTP/2 PUSH
  - Database cleaner

**Instalação**:
1. Painel WordPress → Plugins → Adicionar Novo
2. Procure por "LiteSpeed Cache"
3. Clique em "Instalar Agora"
4. Ative o plugin
5. Configure em **Painel → LiteSpeed Cache**

---

## 2. 💳 Gateways de Pagamento

### Mercado Pago para WooCommerce
- **URL Oficial**: https://www.mercadopago.com.br/developers/pt
- **Tipo**: Gateway de Pagamento
- **Formas de Pagamento**:
  - Cartão de crédito
  - Boleto bancário
  - PIX (instantâneo)
  - Conta digital
  
**Benefícios**:
- Proteção contra fraude
- Checkout transparente ou redirect
- Taxas competitivas
- Notificações em tempo real

**Instalação**:
1. Painel WordPress → Plugins → Adicionar Novo
2. Procure por "Mercado Pago for WooCommerce"
3. Clique em "Instalar Agora" e ative
4. Vá em **WooCommerce → Configurações → Pagamentos**
5. Configure suas credenciais do Mercado Pago

---

### PagSeguro para WooCommerce
- **GitHub**: https://github.com/r-martins/PagSeguro-WooCommerce
- **Autor**: Ricardo Martins
- **Tipo**: Gateway de Pagamento
- **Formas de Pagamento**:
  - Cartão de crédito (com parcelamento)
  - Transferência bancária
  - Saldo PagSeguro
  
**Benefícios**:
- Módulo mantido pela comunidade
- Descontos especiais para usuários
- Relatórios detalhados
- Suporte ativo
- Controle de promoções

**Instalação**:
1. Clone o repositório ou baixe no GitHub
2. Faça upload para `/wp-content/plugins/`
3. Ative em **Painel → Plugins**
4. Configure em **WooCommerce → Configurações → Pagamentos**

---

### WooPayments (Oficial WooCommerce)
- **URL Oficial**: https://woocommerce.com/products/woo-payments/
- **Tipo**: Gateway de Pagamento Oficial
- **Formas de Pagamento**:
  - Cartão de crédito (parcelado em até 12x)
  - Apple Pay
  - Google Pay
  - Acesso USD (para vendedores internacionais)
  
**Benefícios**:
- Desenvolvido pela Automattic (criadora WooCommerce)
- Dashboard integrado
- Payout automático em conta bancária
- Suporte oficial
- Sem intermediários (mais transparente)

**Instalação**:
1. Painel WordPress → Plugins → Adicionar Novo
2. Procure por "WooPayments"
3. Clique em "Instalar Agora" e ative
4. Siga o guia de configuração automático
5. Verifique sua conta em minutos

---

## 3. 📋 Comparação Rápida

| Feature | Mercado Pago | PagSeguro | WooPayments |
|---------|--------------|-----------|------------|
| Cartão Crédito | ✅ | ✅ | ✅ |
| PIX | ✅ | ❌ | ❌ |
| Boleto | ✅ | ❌ | ❌ |
| Parcelamento | ✅ | ✅ | ✅ (até 12x) |
| Apple/Google Pay | ❌ | ❌ | ✅ |
| Taxa (%) | 2.49% | 2.19% | 2.9% |
| Suporte | 24/7 | 24/7 | 24/7 |

---

## 4. 🔧 Ativação Recomendada

**Para melhor performance, ative nesta ordem**:
1. LiteSpeed Cache (melhora velocidade geral)
2. Mercado Pago (maior cobertura de clientes)
3. WooPayments (para Apple/Google Pay)
4. PagSeguro (opcional, para taxa reduzida)

---

## 5. 📞 Suporte

Para dúvidas sobre integração:
- **Mercado Pago**: support@mercadopago.com.br
- **PagSeguro**: https://atendimento.pagseguro.com.br
- **WooPayments**: https://woocommerce.com/contact/
- **LiteSpeed**: https://www.litespeedtech.com/support/

---

## 6. 💡 Dicas de Otimização

✅ **Após instalar os plugins**:
- Teste os pagamentos em Sandbox/Beta antes de ativar
- Configure notificações de vendas
- Habilite cupons de desconto
- Configure dados de frete automático
- Faça a integração com seu email marketing

---

**Última atualização**: 24 de Fevereiro de 2026
