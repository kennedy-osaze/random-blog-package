<?php

namespace Kennedy\RandomBlogPackage\Tests\Unit;

use Orchestra\Testbench\TestCase;
use Kennedy\RandomBlogPackage\BlogFileParser;

class BlogFileParserTest  extends TestCase
{
    public function testSplitFileContentIntoHeadAndBody()
    {
        $markdownFilePath = __DIR__ . '/../blogs/markdown-file-1.md';

        $blogFileParser = new BlogFileParser($markdownFilePath);

        $data = $blogFileParser->getFileData();

        $this->assertStringContainsString('title: Any Title', $data[1]);
        $this->assertStringContainsString('description: Any random description works here', $data[1]);
        $this->assertStringContainsString('Hello People...', $data[2]);
    }

    public function testEachHeadFileGetsSeparated()
    {
        $markdownFilePath = __DIR__ . '/../blogs/markdown-file-1.md';

        $fileData = (new BlogFileParser($markdownFilePath))->getFileData();

        $this->assertEquals('Any Title', $fileData['title']);
        $this->assertEquals('Any random description works here', $fileData['description']);
    }

    public function testTheBodyIsSavedAndTrimmed()
    {
        $markdownFilePath = __DIR__ . '/../blogs/markdown-file-1.md';

        $fileData = (new BlogFileParser($markdownFilePath))->getFileData();

        $this->assertEquals("# Any Heading\n\nHello People...", $fileData['body']);
    }
}
