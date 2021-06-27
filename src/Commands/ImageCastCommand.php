<?php

namespace Konnco\ImageCast\Commands;

use Illuminate\Console\Command;

class ImageCastCommand extends Command
{
    public $signature = 'laravel-imagecast';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
