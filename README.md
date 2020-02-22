# Teste de Desenvolvimento - Br24
Teste técnico realizado para o processo de seleção da Br24.

## Observações
Considerações e decisões tomadas durante o desenvolvimento.

#### Utilização dos Requests para separação dos dados do formulário
Como o formulário contém informações de duas entidades, foi utilizado recurso de classes de `Requests`, que remove código de validação de dentro dos controladores, e permite criação de métodos para separação e renomeação dos dados dos formulários para facilitar utilização do método `fill()` nos models.

#### Verificação do token de autenticação da Bitrix24 nos webhooks
Para verificar autenticidade dos webhooks, a Bitrix24 envia um token de autenticação em todos os requests de webhooks de saída, que devem ser verificados antes de serem processados.

Para isso foi definido um novo arquivo de rotas, chamado `webhooks`, que são carregados com um conjunto de `Middleware` semelhantes ao do conjunto `API`, com adição de um middleware que realiza a verificação do token de autenticação antes da requisição chegar no controladores.

#### Laravel Mix
Para unificar os arquivos carregados pela página de layout, foi utilizado Laravel Mix, onde qualquer dependência CSS ou Javascript, possa ser concatenado e minificado em ambiente de produção.

#### Regras de validação de CPF e CNPJ
As regras customizadas de validação de CPF e CNPJ foram importadas utilizando o pacote `laravellegends/pt-br-validator` que também validam o formato. Por causa disso a biblioteca `inputmask` foi adicionada para manter a formatação nos campos do formulário e auxiliar o usuário ao completar o campo.


#### Falta de testes
Diversas funcionalidades da aplicação poderiam ser facilmente testadas para garantir o funcionamento entre atualizações. Devido ao curto tempo disponível para implementação da aplicação, não foi possível implementar testes automatizados.

#### Possibilidade de um design melhor
O plano inicial era desenvolver um design totalmente novo utilizando o framework TailwindCSS. Essa ideia foi rapidamente descartada devido à falta de tempo. Como substituição, foi utilizado o framework Bootstrap, que conta com diversos componentes prontos e testados em diversos navegadores.

#### API da Bitrix24
Para uma aplicação final, seria necessário implementar um pacote mais robusto da API da Bitrix24, visto que muitas funcionalidades essenciais dependem nessa integração.

#### Colunas customizadas da Bitrix24
A identificação das colunas customizadas da plataforma Bitrix24 foram passadas como uma configuração manual. Para uma aplicação mais robusta, seria necessário detecção automática dessas colunas pelo nome usando o endpoint de `fields` da Bitrix24.

#### Documentação
A documentação de toda aplicação foi feita em inglês, com intuito de manter melhor consistência com o código e documentação existente no framework. 

#### Componentizar elementos do Form
Os componentes individuais do formulário podem ser componentizados de uma forma a facilitar manutenção futura da aplicação.
