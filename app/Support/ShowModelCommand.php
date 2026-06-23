<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;

if (!class_exists(\Illuminate\Foundation\Console\ShowModelCommand::class)) {
    class ShowModelCommand extends Command
    {
        protected $signature = 'model:show {model}';
        protected $description = 'Show an Eloquent model summary (compat stub).';

        public function handle(): int
        {
            $this->warn('model:show is not available in this Laravel version.');

            return 0;
        }
    }
}
