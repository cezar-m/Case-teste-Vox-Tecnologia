<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nome da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor é o nome da sua aplicação, que será usado quando o framework
    | precisar exibir o nome da aplicação em notificações ou outros elementos
    | de interface onde o nome da aplicação precisa aparecer.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Ambiente da Aplicação
    |--------------------------------------------------------------------------
    |
    | Este valor determina o "ambiente" em que sua aplicação está rodando.
    | Pode ser local, produção, teste, etc. Isso também influencia em algumas
    | configurações de cache, debug e log.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de Debug
    |--------------------------------------------------------------------------
    |
    | Quando a aplicação está em modo de debug, mensagens detalhadas de erro
    | com rastreamento de pilha serão exibidas. Caso esteja desativado, será
    | exibida uma página de erro simples e genérica.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL da Aplicação
    |--------------------------------------------------------------------------
    |
    | Esta URL é usada pelo console para gerar URLs corretamente ao usar o
    | Artisan. Defina como a raiz da sua aplicação para que esteja disponível
    | em todos os comandos Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Fuso Horário da Aplicação
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão para sua aplicação,
    | que será usado pelas funções de data/hora do PHP. O padrão foi ajustado
    | para São Paulo (GMT-3).
    |
    */

    'timezone' => 'America/Sao_Paulo',

    /*
    |--------------------------------------------------------------------------
    | Configuração de Localidade
    |--------------------------------------------------------------------------
    |
    | A localidade da aplicação determina o idioma padrão que será usado pelos
    | métodos de tradução e localização do Laravel.
    |
    */

    'locale' => 'pt_BR',

    /*
    |--------------------------------------------------------------------------
    | Localidade de Backup
    |--------------------------------------------------------------------------
    |
    | Localidade usada quando a tradução para a localidade principal não existir.
    |
    */

    'fallback_locale' => 'pt_BR',

    /*
    |--------------------------------------------------------------------------
    | Localidade do Faker
    |--------------------------------------------------------------------------
    |
    | Localização usada pelo Faker para gerar dados falsos (ex: nomes, endereços).
    |
    */

    'faker_locale' => 'pt_BR',

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Esta chave é usada pelos serviços de criptografia do Laravel e deve ser
    | uma string aleatória de 32 caracteres. Garanta que seja configurada antes
    | de implantar a aplicação.
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Modo de Manutenção
    |--------------------------------------------------------------------------
    |
    | Configurações para o modo de manutenção, permitindo bloquear o site
    | quando necessário.
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Componentes adicionais (se necessário)
    |--------------------------------------------------------------------------
    |
    | Outras configurações do Laravel podem ser adicionadas aqui.
    |
    */

];
