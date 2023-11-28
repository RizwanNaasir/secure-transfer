<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('panel')
            ->path('panel')
            ->topNavigation()
            ->navigationItems([
                NavigationItem::make('Contract')
                    ->url(function (){
                        return '/panel/users/' . auth()->user()->id.'/edit';
                    })
                    ->icon('heroicon-o-document-text')
                    ->sort(1)->hidden(function (){
                        return auth()->user()->is_approved_by_admin;
                    }),
                NavigationItem::make('Payout Requests')
                    ->url(function (){
                        return '/panel/users/' . auth()->user()->id.'/edit';
                    })
                    ->icon('heroicon-o-rectangle-stack')
                    ->sort(2)->hidden(function (){
                        return auth()->user()->is_approved_by_admin;
                    }),
                NavigationItem::make('Products')
                    ->url(function (){
                        return '/panel/users/' . auth()->user()->id.'/edit';
                    })
                    ->icon('heroicon-o-shopping-cart')
                    ->sort(3)->hidden(function (){
                        return auth()->user()->is_approved_by_admin;
                    }),
                /*NavigationItem::make('Wallet')
                    ->url(function (){
                        return '/panel/users/' . auth()->user()->id.'/edit';
                    })
                    ->icon('heroicon-o-wallet')
                    ->sort(4)->hidden(function (){
                        return auth()->user()->is_approved_by_admin;
                    }),*/
            ])
            ->login()
            ->registration()
            ->profile()
            ->emailVerification()
            ->passwordReset()
            ->colors([
                'primary' => Color::Purple,
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->url(function () use ($panel) {
                        $userId = auth()->id();
                        return "/{$panel->getId()}/users/$userId/edit";
                    })
                    ->label('Edit profile'),
            ])
            ->spa()
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
