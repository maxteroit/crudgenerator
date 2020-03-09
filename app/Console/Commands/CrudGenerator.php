<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use App\Http\Middleware\VerifyCsrfToken;
use File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple create CRUD operation using this command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        if ($this->confirm('Do you want to create a migration file?')) {
            Artisan::call('make:migration create_'.strtolower(Str::plural($name)).'_table');
        }

        $this->controller(ucfirst($name));
        $this->model(ucfirst($name));
        $this->request(ucfirst($name));

        File::append(base_path('routes/api.php'), 'Route::resource(\'' . Str::plural(strtolower($name)) . "', '{$name}Controller');\n");
        // File::append(base_path('app/Http/Middleware/VerifyCsrfToken.php'),array_push($except,"'". Str::plural(strtolower($name))."',"));
        $this->info('Crud ' .$name.' created Successfully');
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($name)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}', '{{modelNamePlural}}'],
            [$name, strtolower(Str::plural($name))],
            $this->getStub('Model')
         );
         file_put_contents(app_path("/{$name}.php"), $modelTemplate);
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
        [
            '{{modelName}}',
            '{{modelNamePluralLowerCase}}',
            '{{modelNameSingularLowerCase}}'
        ],
        [
            $name,
            strtolower(Str::plural($name)),
            strtolower($name)
        ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }
}
