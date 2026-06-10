<?php

namespace App\Filament\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class CustomRegister extends BaseRegister
{
   #[Override]
   public function getHeading(): string|Htmlable|null
   {
      return 'Registrasi';
   }
   #[Override]
   public function getSubheading(): string|Htmlable|null
   {
      return 'User baru wajib Registrasi';
   }
   #[Override]
   public function getRegisterFormAction(): Action
   {
      return parent::getRegisterFormAction()
      ->label('DAFTAR AKUN BARU');
   }
   public function form(Schema $schema): Schema
   {
      return $schema
         ->components([
            TextInput::make('name')
               ->label('Nama Lengkap')
               ->required(),
            TextInput::make('nickname')
               ->label('Nama Panggilan')
               ->required(),
            TextInput::make('email')
               ->label('Email')
               ->email()
               ->required()
               ->unique(table: 'users', column: 'email'),
            TextInput::make('phone')
               ->label('Nomor Telepon')
               ->tel()
               ->required(),
            TextInput::make('password')
               ->label('Password')
               ->password()
               ->required()
               ->minLength(8)
               ->same('passwordConfirmation'),
            TextInput::make('passwordConfirmation')
               ->label('Konfirmasi Password')
               ->password()
               ->required()
               ->dehydrated(false),
         ]);
   }
   protected function mutateFormDataBeforeRegister(array $data): array
   {
      $data['role'] = 'user';
      return $data;
   }
}
