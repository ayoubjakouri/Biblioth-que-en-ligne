<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class listUsers extends Command
{
     /**
      * The name and signature of the console command.
      *
      * @var string
      */
     protected $signature = 'users:list {--table}';

     /**
      * The console command description.
      *
      * @var string
      */
     protected $description = 'Affiche la liste de tous les utilisateurs';

     /**
      * Execute the console command.
      */
     public function handle()
     {
          $users = User::all(['id', 'name', 'email']);
          $tableOption = $this->option('table');
          if ($users->isEmpty()) {
               $this->warn('Aucun utilisateurs trouve.');
               return;
          }
          if ($tableOption) {
               $this->table(
                    ['ID', 'Nom', 'Email'],
                    $users
               );
          } else {
               $this->info('Liste des utilisateurs :');
               foreach ($users as $user) {
                    $this->line("ID: {$user->id} | Nom : {$user->name} | Email: {$user->email}");
               }
          }
     }
}
