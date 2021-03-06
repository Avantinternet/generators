<?php

namespace Avantinternet\Generators;

use Avantinternet\Generators\Migrations\SchemaParser;

class ModelGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'model';

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return app_path();
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath().'/'.$this->getName().'.php';
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'fillable' => $this->getFillable(),
        ]);
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->fillable);
    }

    /**
     * Get the fillable attributes.
     *
     * @return string
     */
    public function getFillable()
    {
        if (!$this->fillable) {
            return '[]';
        }

        $results = '['.PHP_EOL;

        foreach ($this->getSchemaParser()->toArray() as $column => $value) {
            $results .= "\t\t'{$column}',".PHP_EOL;
        }

        return $results."\t".']';
    }
}
