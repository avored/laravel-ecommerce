<?php

namespace Mage2\Common\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Migrations\Migrator;
use Symfony\Component\Console\Input\InputOption;

class Mage2Migrate extends Command {

    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mage2:migrate {--database=} {--force} {--path=} {--pretend} {--seed} {--step}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the database migrations for Mage2 Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator) {
        $this->migrator = $migrator;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->info("Building Command Artisan");

        if (!$this->confirmToProceed()) {
            return;
        }
        $this->prepareDatabase();

        // Next, we will check to see if a path option has been defined. If it has
        // we will use the path relative to the root of this installation folder
        // so that migrations may be run for any path within the applications.
        $this->migrator->run($this->getMigrationPaths(), [
            'pretend' => $this->option('pretend'),
            'step' => $this->option('step'),
        ]);

        // Once the migrator has run we will grab the note output and send it out to
        // the console screen, since the migrator itself functions without having
        // any instances of the OutputInterface contract passed into the class.
        foreach ($this->migrator->getNotes() as $note) {
            $this->output->writeln($note);
        }

        // Finally, if the "seed" option has been given, we will re-run the database
        // seed task to re-populate the database, which is convenient when adding
        // a migration and a seed at the same time, as it is only this command.
        if ($this->option('seed')) {
            $this->call('db:seed', ['--force' => true]);
        }
    }

    /**
     * Prepare the migration database for running.
     *
     * @return void
     */
    protected function prepareDatabase() {
        $this->migrator->setConnection($this->option('database'));

        if (!$this->migrator->repositoryExists()) {
            $options = ['--database' => $this->option('database')];

            $this->call('migrate:install', $options);
        }
    }

    public function getMigrationPaths() {
        $mage2Modules = config('module');
        $migrationPath = [];
        foreach ($mage2Modules as $namespace => $path) {
            $migrationPath [] = $path . DIRECTORY_SEPARATOR . "migration";
        }
        return $migrationPath;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
            ['path', null, InputOption::VALUE_OPTIONAL, 'The path of migrations files to be executed.'],
            ['pretend', null, InputOption::VALUE_NONE, 'Dump the SQL queries that would be run.'],
            ['seed', null, InputOption::VALUE_NONE, 'Indicates if the seed task should be re-run.'],
            ['step', null, InputOption::VALUE_NONE, 'Force the migrations to be run so they can be rolled back individually.'],
        ];
    }

}
