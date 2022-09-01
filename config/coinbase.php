<?php

/*     'apiKey' => '50ad4521-baab-4968-8d3a-b53d1837bb56',
'apiVersion' => '2018-03-22',
'webhookSecret' => '07cd3629-8421-45fa-94be-dbd6624d1eab', */

return [
    'apiKey' => config('apicoinbase.apiKey'),
    'apiVersion' => config('apicoinbase.apiVersion'),
    'webhookSecret' => config('apicoinbase.webhookSecret'),
    'webhookJobs' => [
        'charge:created' => \App\Jobs\CoinbaseWebhooks\HandleCreatedCharge::class,
        // 'charge:confirmed' => \App\Jobs\CoinbaseWebhooks\HandleConfirmedCharge::class,
        // 'charge:failed' => \App\Jobs\CoinbaseWebhooks\HandleFailedCharge::class,
        // 'charge:delayed' => \App\Jobs\CoinbaseWebhooks\HandleDelayedCharge::class,
        // 'charge:pending' => \App\Jobs\CoinbaseWebhooks\HandlePendingCharge::class,
        // 'charge:resolved' => \App\Jobs\CoinbaseWebhooks\HandleResolvedCharge::class,
    ],
    'webhookModel' => Shakurov\Coinbase\Models\CoinbaseWebhookCall::class,
];
