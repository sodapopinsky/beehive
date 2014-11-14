<?php 
namespace NS\Core;

use Config;
use Aws\S3\S3Client;
class S3
{
    public $client;

    public function __construct()
    {
        $this->client = S3Client::factory(array(
                'key'    => Config::get('constants.amazonS3Key'),
                'secret' => Config::get('constants.amazonS3Secret')
                ));
    }

}