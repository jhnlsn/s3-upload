<?php
require('vendor/autoload.php');

$file = $argv[1];

$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');

try {
  $s3->putObject([
    'Key' => $file,
    'SourceFile' => __DIR__ . DIRECTORY_SEPARATOR . $file,
    'Bucket' => $bucket
  ]);
} catch(Exception $e) {
  echo $e->getMessage();
}
