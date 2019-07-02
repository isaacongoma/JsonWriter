<?php

namespace Manojkiran\JsonWriter;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Model;

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
     * Loads the New File
     *
     * @param string $filePath
     * @return $this
     **/
    public function load( $filePath)
    {
        $this->filePath = $filePath;

        $this->fileName = $this->getFileFormPath();

        return $this;
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
    public function write($contents, $allowDuplicate = true)
    {
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
     * @param bool $skipEmptyLines
     * @return SupportCollection
     **/
    public function parseFile($skipEmptyLines = false)
    {
        $finalArray = [];

        if ($skipEmptyLines) {
            $fileLines = file($this->filePath, FILE_SKIP_EMPTY_LINES);
        } else {
            $fileLines = file($this->filePath);
        }

        foreach ( $fileLines as $lineNumber => $eachLine) {
            $finalArray[] = json_decode( $eachLine, true);
        }
        return (new SupportCollection( $finalArray));
    }

    

    // search in given file for specified array
    public function searchForExisting(array $array)
    {
        $fileData = $this->parseFile();

        if ( $fileData) {
            foreach ( $fileData as $subArray) {
                if ($array === $subArray) {
                    return true;
                }
            }
        }

        return false;
    }

}
