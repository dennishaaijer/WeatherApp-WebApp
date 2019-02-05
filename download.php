<?php

session_start();
if (!isset($_SESSION['user'])){
  header("Location: index.php");
}
$path = $_GET['l'];

// Get real path for our folder
switch ($path) {
  case 'ALL':
    $rootPath = realpath('weather');
    break;

  case 'BA':
    $rootPath = realpath('weather/BA');
    break;

  case 'BU':
    $rootPath = realpath('weather/BU');
    break;

  case 'CH':
    $rootPath = realpath('weather/CH');
    break;

  case 'FR':
    $rootPath = realpath('weather/FR');
    break;

  case 'GE':
    $rootPath = realpath('weather/GE');
    break;

  case 'IN':
    $rootPath = realpath('weather/IN');
    break;

  case 'SP':
    $rootPath = realpath('weather/SP');
    break;

  case 'UK':
    $rootPath = realpath('weather/UK');
    break;

  case 'US':
    $rootPath = realpath('weather/US');
    break;

  default:
    echo "<script>alert('Something went wrong!'); window.history.back(); </script>";
    break;
}
$filename = "WeatherData_". $path .".zip";

// Initialize archive object
$zip = new ZipArchive();
$zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
  new RecursiveDirectoryIterator($rootPath),
  RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
  if (!$file->isDir())
  {
        // Get real and relative path for current file
    $filePath = $file->getRealPath();
    $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
    $zip->addFile($filePath, $relativePath);
  }
}

// Zip archive will be created only after closing object
$zip->close();

$download_path = $filename;
      $file_to_download = $download_path; // file to be downloaded
      header("Expires: 0");
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");  header("Content-type: application/file");
      header('Content-length: '.filesize($file_to_download));
      header('Content-disposition: attachment; filename='.basename($file_to_download));
      readfile($file_to_download);


      unlink('WeatherData_' . $path . '.zip');
      header("Location: export.php");
      ?>
