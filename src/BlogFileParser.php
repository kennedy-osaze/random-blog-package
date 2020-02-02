<?php

namespace Kennedy\RandomBlogPackage;

use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Kennedy\RandomBlogPackage\Facades\Blog;

class BlogFileParser
{
    protected $filename;

    protected $fileRawContent = [];

    protected $fileData = [];

    public function __construct(string $filename)
    {
        $this->filename = $filename;

        $this->parseFile();
    }

    public function parseFile()
    {
        $this->splitFile();

        $this->explodeFileRawContent();

        $this->processFields();
    }

    public function getFileData(): array
    {
        return $this->fileData;
    }

    public function getFileRawContent(): array
    {
        return $this->fileRawContent;
    }

    public function explodeFileRawContent()
    {
        $formattedFileData = [];

        foreach (explode("\n", trim($this->fileRawContent[1])) as $fieldString) {
            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);

            $formattedFileData[$fieldArray[1]] = $fieldArray[2];
        }

        $formattedFileData['body'] = trim($this->fileRawContent[2]);

        $this->fileData += $formattedFileData;
    }

    protected function splitFile(): void
    {
        preg_match(
            '/^\-{3}(.*)\-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $this->fileRawContent
        );
    }

    protected function processFields()
    {
        foreach ($this->fileData as $field => $value) {
            $class = $this->getField(Str::studly($field));

            if (! class_exists($class) || ! method_exists($class, 'process')) {
                $class = "Kennedy\RandomBlogPackage\Fields\Meta";
            }

            $this->fileData = array_merge(
                $this->fileData,
                $class::process($field, $value, $this->fileData),
            );
        }
    }

    protected function getField(string $field)
    {
        foreach (Blog::getFields() as $availableFields) {
            $class = new ReflectionClass($availableFields);

            if ($class->getShortName() === $field) {
                return $class->getName();
            }
        }
    }
}
