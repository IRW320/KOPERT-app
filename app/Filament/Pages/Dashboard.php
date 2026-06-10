<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as FilamentDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Override;

class Dashboard extends FilamentDashboard
{
   #[Override]
   public function getHeading(): string|Htmlable|null
   {
      return Auth::user()?->role === 'admin' ? 'Dashboard Admin' : 'Dashboard User';
   }
   #[Override]
   public static function getNavigationLabel(): string
   {
      return Auth::user()?->role === 'admin' ? 'Dashboard Admin' : 'Dashboard User';
   }
   #[Override]
   public function getTitle(): string|Htmlable
   {
      return Auth::user()?->role === 'admin' ? 'Dashboard Admin' : 'Dashboard User';
   }
}
