<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class makeListSelectable extends Command
{

    public $pathName, $nameComponent, $nameView, $pathNameView;

    // public function __construct()
    // {


    // }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ListSelectable {name}';
    // protected $signature = 'make:custom-component {name} {dato1=default1} {dato2=default2}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        /* En el constructor tenemos que obtener basicamente 4 cosas:

            1- pathName: es la ruta original que ingresa el cliente, por ejemplo Manage/Products/EditProduct/Albums/ListLocacionsSeleccionable
            2- nameComponent: Apartir del pathName, obtendremos el nombre del componente, siguiendo con el ejemplo seria: ListLocacionsSeleccionable

            3- pathNameView: es la ruta del la vista de livewire donde se ha creado, ejemplo: Manage/Products/EditProduct/Albums/list-locacions-seleccionable.blade.php
            4- nameView: Apartir del pathNameView, obtendremos el nombre de la vista, siguiendo con el ejemplo seria: list-locacions-seleccionable.blade.php

        */

        //obtenemos el path original, ejemplo:  Albums/CustomLivewire
        $this->pathName = $this->argument('name'); //(1)

        //Aqui extraemos el nombre y le asignamos a name el resukltado, quedar asi: CustomLivewire
        //strrpos busca la ultima '/' y apartir de ahi divide la cadena en 2 posiciones: 0 y 1, cero es el principio de la cadena y 1 es el final de la cadena
        //$name = substr($this->pathName, 1, strrpos($this->pathName, "/"));; //(2)
        
        //Pero mas facil es usando basename

        //Obtenemos solo el nombre (nameComponent), ejemplo: CustomLivewire
        //de esto "Manage/Products/EditProduct/Albums/ListLocacionsSeleccionable" se obtine "ListLocacionsSeleccionable"

        $this->nameComponent = basename($this->pathName); //(2) Manage/Personalizado/Peruanitos 

        Log::info($this->pathName); //Manage/Personalizado/Peruanitos 
        Log::info($this->nameComponent); //Peruanitos

        //Analogamente para las vistas, este es el path completo con el nombre de la plantilla

        $this->nameView = $this->pascalCasetoGuiones($this->nameComponent);  //(4) custom-livewire

        Log::info('imprimendo el pacal case de Peruanitos');
        Log::info($this->nameView);

        // Obtener la parte del path antes de la última barra diagonal (para solo obtener la ruta sin el nombre)
        $parentPath = dirname($this->pathName);

        Log::info('imprimiendo solo "Manage/Personalizado"');
        Log::info($parentPath);

        if ($parentPath == ".") {
            $parentPath = "";
        }
        
        // Log::info($this->pathName);
        // Log::info($parentPath);

        $this->pathNameView = $parentPath . '/' . $this->nameView;  //(3) Albums/custom-livewire
        //Y este solo es el nombre de la plantilla

        Log::info('imprimiendo ($this->pathNameView) ahora pero personalizado en minisculas con el formato culebcase deberia quedar asi Manage/Personalizado/peruanitos');
        Log::info($this->pathNameView);

        //para llamar al make:livewire lo hacemos con todo el path que el cliente ha ingresado por ejemplo Albums/CustomLivewire
        $this->call('make:livewire', [
            'name' => $this->pathName,
        ]);

        // Update the component view with the form and custom data
        $this->updateComponentView();

        $this->updateComponent();

        $this->info('El componente se ha creado correctamente');

    }

    
    function pascalCasetoGuiones($input)
    {
        // Convierte el primer carácter de una cadena en minúsculas
        $input = lcfirst($input);

        // Ahora usamos las letras mayusculas centrales como separadores: 
        // Separar las palabras basadas en mayúsculas
        $words = preg_split('/(?=[A-Z])/', $input, -1, PREG_SPLIT_NO_EMPTY);

        // Unir las palabras separadas por guiones
        $output = implode('-', $words);

        return strtolower($output);
    }

    protected function updateComponent()
    {

        $livewirePath = app_path('Http/Livewire/' . $this->pathName . '.php');

        // Log::info($livewirePath);
        //Leemos la plantilla
        $fileContent = File::get(app_path('Console/Commands/makeSelectable.blade.php'));

        $updatedContents = str_replace(
            ['{{ $nameComponent }}', '{{ $pathNameView }}'],
            //Aqui corregimos porque si hay 2 puntos lo reemplazamos por un punto
            [$this->nameComponent, str_replace('..','.','livewire.'.strtolower(str_replace('/','.', $this->pathNameView)))],
            $fileContent
        );

        file_put_contents($livewirePath, $updatedContents);

    }

    protected function updateComponentView()
    {
        $viewPath = resource_path('views/livewire/' . $this->pathNameView . '.blade.php');
        // $viewContents = file_get_contents($viewPath); //lee la informacion del archivo $viewPath
        $updatedContents = "";
        //en la cadena que hemos leido buscamos {{ data1 }} y {{ dato2 }} si existen lo reemplazamos $dato1 por $dato2 
        // $updatedContents = str_replace(
        //     ['{{ $dato1 }}', '{{ $dato2 }}'],
        //     [$dato1, $dato2],
        //     $viewContents
        // );

        //como hemos comentado la linea anterior nos estamos saltando el reemplazo por "Mientras"
        // $updatedContents =  $viewContents;

        // preparando el html
        $updatedContents .=
            <<<HTML
            <div>
                <form>
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" value="{{ \$name }}" />

                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" value="{{ \$email }}" />

                    <button type="submit">Enviar</button>
                </form>
            </div>
        HTML;

        file_put_contents($viewPath, $updatedContents);
    }
}
