<?php

return [
    'key' => [
        'warning' => 'Parece que você já configurou uma chave de criptografia do aplicativo. Continuando com esse processo, sobrescrever essa chave e causar corrupção de dados para todos os dados criptografados existentes. NÃO CONTINUE A MENOS QUE VOCÊ SAIBA O QUE ESTÁ A FAZER.',
        'confirm' => 'Eu entendo as consequências de executar este comando e aceito toda a responsabilidade pela perda de dados criptografados.',
        'final_confirm' => 'Tem certeza que deseja continuar? Alterar a chave de criptografia do aplicativo CAUSARÁ PERDA DE DADOS.',
    ],
    'location' => [
        'no_location_found' => 'Could not locate a record matching the provided short code.',
        'ask_short' => 'Localização de Código Curto',
        'ask_long' => 'Descrição da localização',
        'created' => 'Novo local criado com sucesso (:name) com um ID de :id.',
        'deleted' => 'Excluiu com sucesso o local solicitado.',
    ],
    'user' => [
        'search_users' => 'Insira um nome de usuário, UUID ou endereço de e-mail',
        'select_search_user' => 'ID do usuário a ser excluído (Enter \'0\' Para voltar a pesquisar)',
        'deleted' => 'Usuário excluído com sucesso do painel.',
        'confirm_delete' => 'Tem certeza que deseja excluir este usuário do painel?',
        'no_users_found' => 'Nenhum usuário foi encontrado para o termo de pesquisa fornecido.',
        'multiple_found' => 'MVárias contas foram encontradas para o usuário fornecido, incapaz de excluir um usuário devido ao sinalizador de comando --no-interaction .',
        'ask_admin' => 'Este usuário é um administrador?',
        'ask_email' => 'Endereço de e-mail',
        'ask_username' => 'Nome do usuário',
        'ask_name_first' => 'Primeiro nome',
        'ask_name_last' => 'Último nome',
        'ask_password' => 'Senha',
        'ask_password_tip' => 'Se você gostaria de criar uma conta com uma senha aleatória enviada por email para o usuário, execute novamente este comando (CTRL + C) e passe o comando `--no-password` .',
        'ask_password_help' => 'As senhas devem ter pelo menos 8 caracteres e conter pelo menos uma letra maiúscula e um número(a-Z | 0-9).',
        '2fa_help_text' => [
            'Este comando desabilitará a autenticação de 2 fatores para a conta de um usuário se estiver habilitada. Isso só deve ser usado como um comando de recuperação de conta se o usuário não tiver acesso à conta.',
            'Se não era isso que você queria fazer, pressione CTRL + C para sair deste processo.',
        ],
        '2fa_disabled' => 'A autenticação de 2 fatores foi desativada para o endereço :email.',
    ],
    'schedule' => [
        'output_line' => 'Despachando trabalho para a primeira tarefa em `:schedule` (:hash).',
    ],
    'maintenance' => [
        'deleting_service_backup' => 'Excluindo arquivo de backup de serviço :file.',
    ],
    'server' => [
        'rebuild_failed' => 'Solicitação de reconstrução para ":name" (#:id) no node ":node" falhou com erro: :message',
        'reinstall' => [
            'failed' => 'Solicitação de reinstalação para ":name" (#:id) no node ":node" failed with error: :message',
            'confirm' => 'Você está prestes a reinstalar em um grupo de servidores. Você deseja continuar?',
        ],
        'power' => [
            'confirm' => 'Você está prestes a realizar um :action contra :count servidores. Do you wish to continue?',
            'action_failed' => 'Pedido de ação de energia para ":name" (#:id) no node ":node" falhou com erro: :message',
        ],
    ],
    'environment' => [
        'mail' => [
            'ask_smtp_host' => 'SMTP Host (e.g. smtp.gmail.com)',
            'ask_smtp_port' => 'Porta SMTP',
            'ask_smtp_username' => 'Usuario SMTP',
            'ask_smtp_password' => 'Password SMTP',
            'ask_mailgun_domain' => 'Domínio Mailgun',
            'ask_mailgun_secret' => 'Mailgun Secret',
            'ask_mandrill_secret' => 'Mandrill Secret',
            'ask_postmark_username' => 'Postmark API Key',
            'ask_driver' => 'Qual driver deve ser usado para enviar e-mails?',
            'ask_mail_from' => 'O endereço de e-mail deve ser originado de',
            'ask_mail_name' => 'Nome de onde os e-mails devem aparecer',
            'ask_encryption' => 'Método de criptografia a ser usado',
        ],
        'database' => [
            'host_warning' => 'É altamente recomendado não usar "localhost" como seu host de banco de dados, pois temos visto problemas frequentes de conexão de soquete. Se você deseja usar uma conexão local, deve usar "127.0.0.1".',
            'host' => 'Host de banco de dados',
            'port' => 'Porta de banco de dados',
            'database' => 'Nome do banco de dados',
            'username_warning' => 'Usar a conta "root" para conexões MySQL não é apenas altamente desaprovado, também não é permitido por este aplicativo. Você precisará criar um usuário MySQL para este software.',
            'username' => 'Nome de usuário do banco de dados',
            'password_defined' => 'Parece que você já tem uma senha de conexão MySQL definida, gostaria de alterá-la?',
            'password' => 'Senha do banco de dados',
            'connection_error' => 'Não foi possível conectar ao servidor MySQL usando as credenciais fornecidas. O erro retornado foi ":error".',
            'creds_not_saved' => 'Suas credenciais de conexão NÃO foram salvas. Você precisará fornecer informações de conexão válidas antes de continuar.',
            'try_again' => 'Voltar atrás e tente novamente?',
        ],
        'app' => [
            'settings' => 'Habilitar editor de configurações baseado em IU?',
            'author' => 'Egg Author Email',
            'author_help' => 'Forneça o endereço de e-mail de onde os ovos exportados por este painel devem vir. Este deve ser um endereço de e-mail válido.',
            'app_url_help' => 'O URL do aplicativo DEVE começar com https:// ou http:// dependendo se você está usando SSL ou não. Se você não incluir o esquema, seus e-mails e outros conteúdos direcionarão para o local errado.',
            'app_url' => 'URL da aplicação',
            'timezone_help' => 'O fuso horário deve corresponder a um dos PHP\'s fusos horários suportados. Se você não tiver certeza, consulte http://php.net/manual/en/timezones.php.',
            'timezone' => 'Fuso horário da aplicação',
            'cache_driver' => 'Cache Driver',
            'session_driver' => 'Session Driver',
            'queue_driver' => 'Queue Driver',
            'using_redis' => 'Você selecionou o driver Redis para uma ou mais opções; forneça informações de conexão válidas abaixo. Na maioria dos casos, você pode usar os padrões fornecidos, a menos que tenha modificado sua configuração.',
            'redis_host' => 'Redis Host',
            'redis_password' => 'Redis Password',
            'redis_pass_help' => 'Por padrão, uma instancia de um servidor Redis não tem senha porque está rodando localmente e é inacessível para o mundo exterior. Se for esse o caso, simplesmente pressione Enter sem inserir um valor.',
            'redis_port' => 'Porta Redis',
            'redis_pass_defined' => 'Parece que já existe uma senha definida para o Redis, gostaria de alterá-la?',
        ],
    ],
];
