<?php

namespace Kennedy\RandomBlogPackage\Tests\Unit;

use Illuminate\Support\Carbon;
use Orchestra\Testbench\TestCase;
use Kennedy\RandomBlogPackage\BlogFileParser;

class BlogFileParserTest  extends TestCase
{
    public function testSplitFileContentIntoHeadAndBody()
    {
        $markdownFilePath = __DIR__ . '/../blogs/markdown-file-1.md';

        $blogFileParser = new BlogFileParser($markdownFilePath);

        $data = $blogFileParser->getFileRawContent();

        $this->assertStringContainsString('title: Any Title', $data[1]);
        $this->assertStringContainsString('description: Any random description works here', $data[1]);
        $this->assertStringContainsString('Hello People...', $data[2]);
    }

    public function testSplitStringIntoHeadAndBody()
    {
        $markdown = "---\ntitle: Random Title\n---\nThis is just a random description.";

        $blogFileParser = new BlogFileParser($markdown);

        $data = $blogFileParser->getFileRawContent();

        $this->assertStringContainsString('title: Random Title', $data[1]);
        $this->assertStringContainsString('This is just a random description.', $data[2]);
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

        $this->assertEquals("<h1>Any Heading</h1>\n<p>Hello People...</p>", $fileData['body']);
    }

    public function testDateIsParsedCorrectly()
    {
        $markdown = "---\ndate: January 25, 2019\n---\n";

        $blogFileParser = new BlogFileParser($markdown);

        $data = $blogFileParser->getFileData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('25/01/2019', $data['date']->format('d/m/Y'));
    }

    public function testExtraFieldsAreSaved()
    {
        $markdown = "---\nauthor: John Doe\n---\n";

        $blogFileParser = new BlogFileParser($markdown);

        $data = $blogFileParser->getFileData();

        $expectedResult = json_encode(['author' => 'John Doe']);

        $this->assertEquals($expectedResult,  $data['meta']);
    }

    public function testMetaFieldCanAlsoTakeTwoOrMoreExtraData()
    {
        $markdown = "---\nauthor: John Doe\nimage: /random.image/xyz.jpg\n---\n";

        $blogFileParser = new BlogFileParser($markdown);

        $data = $blogFileParser->getFileData();

        $expectedResult = json_encode([
            'author' => 'John Doe',
            'image' => "/random.image/xyz.jpg",
        ]);

        $this->assertEquals($expectedResult,  $data['meta']);
    }
}
