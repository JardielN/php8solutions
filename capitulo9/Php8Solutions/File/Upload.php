<?php
namespace Php8Solutions\File;
class Upload{
    protected $permitted = [
        'image/gif',
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/webp'
    ];
    protected $messages = [];
    protected $newName;
    // Al usar protected, PHP crea automaticamente esas
    // propiedades en la clase y les asigna el valor
    // que reciban al instanciar la clase.
    public function __construct(
        string $field,
        protected string $path,
        protected int $max = 51200,
        string|array|null $mime = null,
        bool $rename = true
    )
    {
        // Antes de hacer nada, comprueba si la carpeta donde
        // se quiere guardar exista, y el servidor tenga permisos
        // de escritura.
        if(!is_dir($this->path) && !is_writable($this->path))
        {
            //Al estar dentro de un namespace, aqui usamos
            // la clase Exception core de PHP. No una
            // personalizada.
            throw new \Exception("$this->path must be a valid, 
            writable directory.");
        }
        else
        {
            // No importa si pasaste la ruta con '/' o '\'
            // rtrim() limpia eso y DIRECTORY_SEPARATOR pone
            // la barra correcta segun el sistema operativo
            $this->path = rtrim($this->path, '/\\') . DIRECTORY_SEPARATOR;
            if(!is_null($mime))
            {
                // Si $mime no es null
                // se agrega al array permitted[]
                $this->permitted = array_merge($this->permitted, (array) $mime);
            }
            $uploaded = $_FILES[$field];
            if(is_array($uploaded['name']))
            {
                // deal with multiple uploads
                $numFiles = count($uploaded['name']);
                $keys = array_keys($uploaded);
                /**
                 * El bucle reorganiza el contenido de $_FILES
                 * para que los detalles de cada archivo esten
                 * disponibles como si se trataran de subir
                 * individualmente.
                 */
                for($i = 0; $i < $numFiles; $i++)
                {
                    /**
                     * array_column() extrae todos los elementos
                     * de los subarray que contienen la misma clave.
                     * Por ejemplo, al inicio en 0, extrae el valor 0
                     * de cada subarray en $uploaded.
                     */
                    $values = array_column($uploaded, $i);
                    /**
                     * array_combine crea el array, asignando cada
                     * valor a su clave relativa. el subarray name()
                     * se vuelve $currentFile['name']
                     */
                    $currentFile = array_combine($keys, $values);
                    $this->processUpload($currentFile, $rename);
                }
            }
            else
            {
                $this->processUpload($_FILES[$field], $rename);
            }
        }
    }

    // Como la variable messages esta en protected
    // dado que los mensajes son emitidos por la clase
    // se crea este metodo para obtenerlos.
    public function getMessages()
    {
        return $this->messages;
    }

    public function getMaxSize()
    {
        return number_format($this->max/1024, 1) . ' KB.';
    }

    protected function checkFile($file)
    {
        $errorCheck = $this->getErrorLevel($file);
        if($errorCheck !== true)
        {
            $this->messages[] = $errorCheck;
            $errorCheck = false;
        }
        $sizeCheck = $this->checkSize($file);
        $typeCheck = false;
        if(!empty($file['type']))
        {
            $typeCheck = $this->checkType($file);
        }
        return $errorCheck && $sizeCheck && $typeCheck;
    }

    /**
     * Este metodo nos permitira procesar las cargas tanto
     * individuales como multiples
     * cambiamos $_FILES[$field] por $uploaded
     */
    protected function processUpload($uploaded, $rename)
    {
        if($this->checkFile($uploaded))
        {
            $this->checkName($uploaded, $rename);
            $this->moveFile($uploaded);
        }
    }

    protected function moveFile($file)
    {
        // Si se cambio el nombre, moveFile() debe tratar
        // con el nuevo nombre
        $filename = $this->newName ?? $file['name'];
        $success = move_uploaded_file($file['tmp_name'],
        $this->path . $filename);
        if($success)
        {
            $result = $file['name'] . ' was uploaded successfully.';
            // Notificar al usuario del nuevo nombre
            if(!is_null($this->newName))
            {
                $result .= ', and was renamed ' . $this->newName;
            }
            $this->messages[] = $result;
        }
        else
        {
            $this->messages[] = 'Could not upload ' . $file['name'];
        }
    }

    protected function getErrorLevel($file)
    {
        $result = match($file['error'])
        {
            0 => true,
            1, 2 => $file['name'] . ' is too big: (max: ' . 
            $this->getMaxSize() . ').',
            3 => $file['name'] . ' was only partially uploaded.',
            4 => 'No file submitted.',
            default => 'Sorry, there was a problem uploading ' .
            $file['name']
        };
        return $result;
    }

    protected function checkSize($file)
    {
        if($file['error'] == 1 || $file['error'] == 2)
        {
            return false;
        }
        elseif ($file['size'] == 0)
        {
            $this->messages[] = $file['name'] . ' is an empty file.';
            return false;
        }
        elseif ($file['size'] > $this->max)
        {
            $this->messages[] = $file['name'] . ' exceeds the maximum size
            for a file (' . $this->getMaxSize() . ')';
            return false;
        }
        return true;
    }

    protected function checkType($file)
    {
        if(!in_array($file['type'], $this->permitted))
        {
            $this->messages[] = $file['name'] . ' is not a permitted type.';
            return false;
        }
        return true;
    }

    protected function checkName($file, $rename)
    {
        $this->newName = null;
        $nospaces = str_replace(' ', '_', $file['name']);
        if($nospaces != $file['name'])
        {
            $this->newName = $nospaces;
        }
        if($rename)
        {
            $name = $this->newName ?? $file['name'];
            // verificar si ya existe un archivo con el mismo nombre
            // concatenando $name a la propiedad path,
            // obteniendo la ruta completa.
            // Devolvera true si existe un archivo con ese nombre
            // en la carpeta upload_test.
            if(file_exists($this->path . $name))
            {
                // rename file
                $basename = pathinfo($name, PATHINFO_BASENAME);
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $this->newName = $basename . '_' . time() . ".$extension";
            }
        }
    }
}