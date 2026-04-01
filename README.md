![CI](https://github.com/thiagodevmaster/SnapUrl/actions/workflows/main.yml/badge.svg)

# SnapURL
Este projeto tem como objetivo ser capaz de transformar URLs longas em URLs curtas e redirecionar os usuários para o link original de forma eficiente , segura e em alta escala.

## Requisitos Funcionais
<ul>
  <li><strong>Encurtamento de URL: </strong>Receber uma URL longa e retornar uma URL curta exclusiva.</li>
  <li><strong>Redirecionamento: </strong>Ao acessar a URL curta, o sistema deve redirecionar o navegador para a URL original.</li>
  <li><strong>Analytics: </strong>Capacidade de rastrear métricas como número de acessos e origem do tráfego.</li>
</ul>

## Requisitos Não Funcionais
<ul>
  <li><strong>Alta Volumetria: </strong>Suportar a geração de 100 milhões de URLs por dia.</li>
  <li><strong>Escalabilidade de Leitura: </strong>Proporção de 10 leituras para cada 1 escrita (aprox. 11.600 leituras/segundo)</li>
  <li><strong>Armazenamento de Longo Prazo: </strong>Guardar os dados por 10 anos (totalizando ~365 bilhões de registros e 36,5 TB de dados).</li>
  <li><strong>Alta Disponibilidade:</strong> Operação 24x7 sem pontos únicos de falha.</li>
  <li><strong>URLs Curtas:</strong> O código encurtado deve ser o menor possível.</li>
</ul>