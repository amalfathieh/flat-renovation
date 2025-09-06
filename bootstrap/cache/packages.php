<?php
return array(
    'anourvalar/eloquent-serialize' => array(
        'aliases' => array(
            'EloquentSerialize' => 'AnourValar\\EloquentSerialize\\Facades\\EloquentSerializeFacade',
        ),
    ),
    'bezhansalleh/filament-shield' => array(
        'aliases' => array(
            'FilamentShield' => 'BezhanSalleh\\FilamentShield\\Facades\\FilamentShield',
        ),
        'providers' => array(
            'BezhanSalleh\\FilamentShield\\FilamentShieldServiceProvider',
        ),
    ),
    'blade-ui-kit/blade-heroicons' => array(
        'providers' => array(
            'BladeUI\\Heroicons\\BladeHeroiconsServiceProvider',
        ),
    ),
    'blade-ui-kit/blade-icons' => array(
        'providers' => array(
            'BladeUI\\Icons\\BladeIconsServiceProvider',
        ),
    ),
    'filament/actions' => array(
        'providers' => array(
            'Filament\\Actions\\ActionsServiceProvider',
        ),
    ),
    'filament/filament' => array(
        'providers' => array(
            'Filament\\FilamentServiceProvider',
        ),
    ),
    'filament/forms' => array(
        'providers' => array(
            'Filament\\Forms\\FormsServiceProvider',
        ),
    ),
    'filament/infolists' => array(
        'providers' => array(
            'Filament\\Infolists\\InfolistsServiceProvider',
        ),
    ),
    'filament/notifications' => array(
        'providers' => array(
            'Filament\\Notifications\\NotificationsServiceProvider',
        ),
    ),
    'filament/support' => array(
        'providers' => array(
            'Filament\\Support\\SupportServiceProvider',
        ),
    ),
    'filament/tables' => array(
        'providers' => array(
            'Filament\\Tables\\TablesServiceProvider',
        ),
    ),
    'filament/widgets' => array(
        'providers' => array(
            'Filament\\Widgets\\WidgetsServiceProvider',
        ),
    ),
    'jaocero/filachat' => array(
        'aliases' => array(
            'FilaChat' => 'JaOcero\\FilaChat\\Facades\\FilaChat',
        ),
        'providers' => array(
            'JaOcero\\FilaChat\\FilaChatServiceProvider',
        ),
    ),
    'kirschbaum-development/eloquent-power-joins' => array(
        'providers' => array(
            'Kirschbaum\\PowerJoins\\PowerJoinsServiceProvider',
        ),
    ),
    'kreait/laravel-firebase' => array(
        'aliases' => array(
            'Firebase' => 'Kreait\\Laravel\\Firebase\\Facades\\Firebase',
        ),
        'providers' => array(
            'Kreait\\Laravel\\Firebase\\ServiceProvider',
        ),
    ),
    'laravel/breeze' => array(
        'providers' => array(
            'Laravel\\Breeze\\BreezeServiceProvider',
        ),
    ),
    'laravel/pail' => array(
        'providers' => array(
            'Laravel\\Pail\\PailServiceProvider',
        ),
    ),
    'laravel/reverb' => array(
        'aliases' => array(
            'Output' => 'Laravel\\Reverb\\Output',
        ),
        'providers' => array(
            'Laravel\\Reverb\\ApplicationManagerServiceProvider',
            'Laravel\\Reverb\\ReverbServiceProvider',
        ),
    ),
    'laravel/sail' => array(
        'providers' => array(
            'Laravel\\Sail\\SailServiceProvider',
        ),
    ),
    'laravel/sanctum' => array(
        'providers' => array(
            'Laravel\\Sanctum\\SanctumServiceProvider',
        ),
    ),
    'laravel/socialite' => array(
        'aliases' => array(
            'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
        ),
        'providers' => array(
            'Laravel\\Socialite\\SocialiteServiceProvider',
        ),
    ),
    'laravel/tinker' => array(
        'providers' => array(
            'Laravel\\Tinker\\TinkerServiceProvider',
        ),
    ),
    'livewire/livewire' => array(
        'aliases' => array(
            'Livewire' => 'Livewire\\Livewire',
        ),
        'providers' => array(
            'Livewire\\LivewireServiceProvider',
        ),
    ),
    'monzer/filament-chatify-integration' => array(
        'providers' => array(
            'Monzer\\FilamentChatifyIntegration\\ChatifyServiceProvider',
        ),
    ),
    'munafio/chatify' => array(
        'aliases' => array(
            'Chatify' => 'Chatify\\Facades\\ChatifyMessenger',
        ),
        'providers' => array(
            'Chatify\\ChatifyServiceProvider',
        ),
    ),
    'nesbot/carbon' => array(
        'providers' => array(
            'Carbon\\Laravel\\ServiceProvider',
        ),
    ),
    'nunomaduro/collision' => array(
        'providers' => array(
            'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
        ),
    ),
    'nunomaduro/termwind' => array(
        'providers' => array(
            'Termwind\\Laravel\\TermwindServiceProvider',
        ),
    ),
    'ryangjchandler/blade-capture-directive' => array(
        'aliases' => array(
            'BladeCaptureDirective' => 'RyanChandler\\BladeCaptureDirective\\Facades\\BladeCaptureDirective',
        ),
        'providers' => array(
            'RyanChandler\\BladeCaptureDirective\\BladeCaptureDirectiveServiceProvider',
        ),
    ),
    'spatie/laravel-pdf' => array(
        'aliases' => array(
            'LaravelPdf' => 'Spatie\\LaravelPdf\\Facades\\Pdf', // تم تصحيح alias
        ),
        'providers' => array(
            'Spatie\\LaravelPdf\\PdfServiceProvider',
        ),
    ),
    'spatie/laravel-permission' => array(
        'providers' => array(
            'Spatie\\Permission\\PermissionServiceProvider',
        ),
    ),
    'tomatophp/console-helpers' => array(
        'providers' => array(
            'TomatoPHP\\ConsoleHelpers\\ConsoleHelpersServiceProvider',
        ),
    ),
    'tomatophp/filament-fcm' => array(
        'providers' => array(
            'TomatoPHP\\FilamentFcm\\FilamentFcmServiceProvider',
        ),
    ),
);
