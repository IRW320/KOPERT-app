<?php

namespace App\Filament\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Override;

class CustomEditProfile extends BaseEditProfile
{
   #[Override]
   public function getHeading(): string|Htmlable|null
   {
      return 'Edit Profil Pengguna';
   }
   #[Override]
   public function getSubheading(): string|Htmlable|null
   {
      return 'Update Informasi dan Keamanan Akun Anda';
   }
   #[Override]
   public function getSaveFormAction(): Action
   {
      return parent::getSaveFormAction()
      ->label('SIMPAN UPDATE PROFIL');
   }
   public function form(Schema $schema): Schema
   {
      return $schema
         ->components([
            TextInput::make('name')
               ->label('Nama Lengkap')
               ->disabled(),
            TextInput::make('nickname')
               ->label('Nama Panggilan')
               ->required(),
            TextInput::make('email')
               ->label('Email')
               ->disabled(),
            TextInput::make('phone')
               ->label('Tlp')
               ->tel()
               ->required(),
            TextInput::make('current_password')
               ->label('Password Lama (Verifikasi)')
               ->password()
               ->required()
               ->rules([
                  function () {
                     return function (string $attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                           $fail('Password lama yang Anda masukkan salah.');
                        }
                     };
                  },
               ]),
            TextInput::make('password')
               ->label('Password Baru')
               ->password()
               ->minLength(8)
               ->same('passwordConfirmation')
               ->dehydrated(fn($state) => filled($state))
               ->placeholder('Kosongkan jika tidak ingin mengubah password'),
            TextInput::make('passwordConfirmation')
               ->label('Konfirmasi Password Baru')
               ->password()
               ->required(fn($get) => filled($get('password')))
               ->dehydrated(false),
         ]);
   }
}
