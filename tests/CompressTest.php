<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./tests/CompressTest.php
 */
namespace JaegerApp\tests;

use JaegerApp\Compress;

/**
 * Jaeger - Compress object Unit Tests
 *
 * Contains all the unit tests for the \JaegerApp\Compress object
 *
 * @package Jaeger\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class CompressTest extends \PHPUnit_Framework_TestCase
{

    protected $test_file_name = 'compress.test.file.php';

    protected $test_dir = 'compress_data';

    protected $working_dir = 'working_dir';

    /**
     * Ensures the Bootstrap object has all the proper attributes available
     */
    public function testBootstrapAttributes()
    {
        $this->assertClassHasAttribute('archiver', '\JaegerApp\Compress');
        $this->assertClassHasAttribute('keep_original', '\JaegerApp\Compress');
        $this->assertClassHasAttribute('archive_name', '\JaegerApp\Compress');
        
        $m62 = new Compress();
        $this->assertObjectHasAttribute('archiver', $m62);
        $this->assertObjectHasAttribute('keep_original', $m62);
        $this->assertObjectHasAttribute('archive_name', $m62);
    }

    public function testGetArchiver()
    {
        $m62 = new Compress();
        $this->assertInstanceOf('\ZipArchive', $m62->getArchiver());
    }

    public function testSetArchiveName()
    {
        $compress = new Compress();
        $this->assertInstanceOf('JaegerApp\Compress', $compress->setArchiveName('my-test-file'));
        $this->assertEquals('my-test-file.zip', $compress->getArchiveName());
    }

    public function testKeepOriginal()
    {
        $compress = new Compress();
        $this->assertTrue($compress->getKeepOriginal());
        $this->assertInstanceOf('JaegerApp\Compress', $compress->setKeepOriginal(false));
        $this->assertFalse($compress->getKeepOriginal());
    }

    public function testArchiveSingle()
    {
        $compress = new Compress();
        
        // verify compression
        $backup_file_path = $this->dataPath() . DIRECTORY_SEPARATOR . $this->test_dir;
        $destination = $backup_file_path . DIRECTORY_SEPARATOR . $this->working_dir;
        $backup_file = $backup_file_path . DIRECTORY_SEPARATOR . $this->test_file_name;
        $compressed_path = $compress->setKeepOriginal(true)
            ->setArchiveName($this->test_file_name)
            ->archiveSingle($backup_file);
        
        // check we have a zip in the same lcoation as original
        $compress_file_path = $compressed_path;
        $this->assertTrue(file_exists($compress_file_path));
        
        // ensure we can extract the single file
        $compress->extract($compress_file_path, $destination);
        $this->assertTrue(file_exists($destination . DIRECTORY_SEPARATOR . $this->test_file_name));
        unlink($destination . DIRECTORY_SEPARATOR . $this->test_file_name);
        unlink($compress_file_path);
        
        // check we can save the zip elsewhere
        $compressed_path = $compress->setKeepOriginal(true)
            ->setArchiveName($this->test_file_name)
            ->archiveSingle($backup_file, $destination);
        $compress_file_path = $compressed_path;
        $this->assertTrue(file_exists($compress_file_path));
        unlink($compress_file_path);
    }
    
    /**
     * The full path to the data directory
     *
     * @return string
     */
    protected function dataPath()
    {
        return realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR.'data');
    }
}