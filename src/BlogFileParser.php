<?php

namespace Kennedy\RandomBlogPackage;

use Illuminate\Support\Facades\File;

class BlogFileParser
{
    protected $filename;

    protected $fileData = [];

    public function __construct(string $filename)
    {
        $this->filename = $filename;

        $this->splitFile();

        $this->explodeFileData();
    }

    public function getFileData(): array
    {
        return $this->fileData;
    }

    public function explodeFileData()
    {
        $formattedFileData = [];

        foreach (explode("\n", trim($this->fileData[1])) as $fieldString) {
            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);

            $formattedFileData[$fieldArray[1]] = $fieldArray[2];
        }

        $formattedFileData['body'] = trim($this->fileData[2]);

        $this->fileData += $formattedFileData;
    }

    protected function splitFile(): void
    {
        preg_match(
            '/^\-{3}(.*)\-{3}(.*)/s',
            File::get($this->filename),
            $this->fileData
        );
    }
}
