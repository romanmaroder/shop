<?php

return [
    'adminEmail'                    => 'admin@example.com',
    'supportEmail'                  => 'support@example.com',
    'senderEmail'                   => 'noreply@example.com',
    'senderName'                    => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.rememberMeDuration'       => 3600 * 24 * 30,
    'user.passwordMinLength'        => 8,
    'cookieDomain'                  => 'example.com',
    'frontendHostInfo'              => 'http://example.com',
    'backendHostInfo'               => 'http://example/admin.com',
    'staticHostInfo'                => 'http://static-example.com',
    'staticPath'                    => dirname(__DIR__, 2) . '/static',
    'bsVersion'                     => '4.x' // will enable Bootstrap 4.x globally
];
