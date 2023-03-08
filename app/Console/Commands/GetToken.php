<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GetToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getToken:user { --login= : login user } { --password= : password user }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command returns a token';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('login') && $this->option('password')) {

            /* @var Users */
            $users = Users::where('login', $this->option('login'))->where('password', $this->option('password'))->first();
            if (!$users) {
                $this->error('Пользователь не найден  с таким логином ' . $this->option('login') . ' и паролем ' . $this->option('password'));
                return 1;
            }
            $token = User::where('login', $this->option('login'))->where('password', $this->option('password'))->first();
            $name = $token->id.'_'.$token->login.'_'.$token->password;
            $users->login_verified_at = (Carbon::now())->addMinute(5);
            $token = $token->createToken($name,['*'],$users->login_verified_at);
            print_r('      Cкопируйте ваш токен он действует 5 минут   ');
            echo "\n";
            $this->alert($token->plainTextToken);
            echo "\n";
            return 0;

        } else {
            ($this->option('login')) ? '' : $this->error('Введите логин пользователь ');
            ($this->option('password')) ? '' : $this->error('Введите пароль пользователь ');
            return 1;
        }
    }
}
