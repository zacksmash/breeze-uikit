<?php

namespace Zacksmash\BreezeUIkit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BreezeUIkitCommand extends Command
{
    public $signature = 'breeze:uikit';

    public $description = 'Install UIkit preset, with views and resources';

    public function handle()
    {
        Artisan::call('breeze:install');
        
        $this->publishAssets();
        $this->updateWebpackUrl();

        $this->info('UIkit scaffolding installed successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }

    protected function publishAssets()
    {
        File::delete(base_path('tailwind.config.js'));
        File::deleteDirectory(resource_path('css'));
        File::deleteDirectory(resource_path('js'));

        $this->callSilent('vendor:publish', ['--tag' => 'breeze-uikit-resources', '--force' => true]);
    }

    protected function updateWebpackUrl()
    {
        File::put(
            base_path('webpack.mix.js'),
            str_replace(
                'http://CHANGE_ME.test',
                env('APP_URL'),
                File::get(base_path('webpack.mix.js'))
            )
        );
    }
}
