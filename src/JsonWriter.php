<?php

namespace Manojkiran\JsonWriter;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Model;
use Manojkiran\JsonWriter\Exceptions\FileNotLoadedException;
use Manojkiran\JsonWriter\Exceptions\FileNotValidExtension;

/**
 * Read and write 
 * PHP array|Laravel Collection | EloquentCollection
 * to json file
 */
class JsonWriter
{
    /**
     * The Current Path To File.
     *
     * @var string
     */    
    protected $filePath = null;

    /**
     * The Current File Name.
     *
     * @var string
     */
    protected $fileName = null;

    /**
     * Number of bytes that were written to the file.
     *
     * @var string
     */
    protected $writtenSize = false;

    /**
     * Valid Extension of the File.
     *
     * @var string
     */
    protected $fileExtension = null;

    /**
     * Loads the New File
     *
     * @param string $filePath
     * @return $this
     **/
    public function load( $filePath)
    {
        $this->filePath = $filePath;

        $this->fileName = $this->getFileFormPath();

        $this->fileExtension = $this->getExtensionOfFile();

        return $this;
    }

    /**
     * Gets the Extension for the File
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function getExtensionOfFile()
    {
        $path = pathinfo( $this->filePath);

        $extension = isset($path['extension']) ? $path['extension'] : null;

        if ($extension !== 'json') {
            throw new FileNotValidExtension( 'is Not a Valid Json File');
        }
    }

    /**
     * Get the File Name from the Path
     *
     * @author Manojkiran.A <manojkiran10031998@gmail.com>
     * @return string
     * 
     **/
    protected function getFileFormPath(): string
    {
        $exploded = explode(DIRECTORY_SEPARATOR, $this->filePath);
        return  (new SupportCollection( $exploded))->last();
    }

    /**
     * Write array data to file by appending to previous contents
     *
     * @param array|SupportCollection $contents
     * @param bool $allowDuplicate
     * @return $this
     **/
    public function write($contents, $allowDuplicate = false)
    {
        if( $this->filePath === null){
            throw new FileNotLoadedException( 'Json File is Not Loaded');
        }
        if ( $contents instanceof SupportCollection) 
        {
            if( $contents->first() instanceof Model)
            {
                foreach ($contents as  $eachArray) {

                    $newContents[] =  $eachArray->toArray();
                }
            }else{
                foreach ($contents as  $eachArray) {

                    $newContents[] =   (array) $eachArray;
                }
            }
        }elseif (is_array( $contents)) 
        {
            $newContents = $contents;
        }

        $result = false;

        if (!$allowDuplicate) {
            $isDuplicate = $this-> searchForExisting( $newContents);

            if (!$isDuplicate) {

                $result = file_put_contents($this->filePath, json_encode( $newContents) . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        } else {
            
            $result = file_put_contents($this->filePath, json_encode( $newContents) . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        $this->writtenSize = $result;

        return $this;
    }

    /**
     * Formats written json data as Collection
     *
     * @author Manojkiran.A <manojkiran10031998@gmail.com>
     * @param bool $skipEmptyLines
     * @return SupportCollection
     **/
    public function parseFile($skipEmptyLines = false)
    {
        return (new SupportCollection($this->parseFileAsArray($skipEmptyLines)));
    }

    /**
     * Parse the File to the Array
     * 
     * @author Manojkiran.A <manojkiran10031998@gmail.com>
     * @param bool $skipEmptyLines
     * @return array
     **/
    protected function parseFileAsArray($skipEmptyLines = false)
    {
        $finalArray = [];

        if ($skipEmptyLines) {
            $fileLines = file($this->filePath, FILE_SKIP_EMPTY_LINES);
        } else {
            $fileLines = file($this->filePath);
        }

        foreach ($fileLines as $lineNumber => $eachLine) {
            $finalArray[] = json_decode($eachLine, true);
        }
        
        return $finalArray;
    }
    /**
     * Search for the Existing Content in the json file
     *
     * @author Manojkiran.A <manojkiran10031998@gmail.com>
     * @param array $arrayOfData
     * @return bool
     **/
    public function searchForExisting($arrayOfData)
    {
        $fileData = $this->parseFile();

        if ($fileData) {
            foreach ($fileData as $subArray) {
                if ($arrayOfData === $subArray) {
                    return true;
                }
            }
        }

        return false;
    }

}
