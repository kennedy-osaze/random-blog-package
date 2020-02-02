<?php

namespace Kennedy\RandomBlogPackage\Drivers;

use Illuminate\Support\Str;
use Kennedy\RandomBlogPackage\BlogFileParser;
use Illuminate\Support\Facades\File as FileSystem;
use Kennedy\RandomBlogPackage\Exception\FileDriverDirectoryNotFoundException;

class File extends Driver
{
    public function retrievePosts()
    {
        foreach (FileSystem::files($this->config['path']) as $file) {
            $this->posts[] = $this->parse($file->getPathname(), $file->getFilename());
        }

        return $this->posts;
    }

    protected function parse($content, $identifier)
    {
        return array_merge(
            (new BlogFileParser($content))->getFileData(),
            ['identifier' => Str::slug($identifier)],
        );
    }

    protected function validateSource()
    {
        if (! FileSystem::exists($this->config['path'])) {
            throw new FileDriverDirectoryNotFoundException(
                "Directory at '{$this->config['path']}' does not exist.
                Check the directory path in the config file"
            );
        }
    }
}
