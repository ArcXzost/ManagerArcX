<?php

// use Kreait\Firebase;
// use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
// $serviceAccount = ServiceAccount::fromJsonFile(config('services.firebase.private_key'));
// $firebase = (new Factory)
//     ->withServiceAccount($serviceAccount)
//     ->create();

// // Access Firebase Storage
// $storage = $firebase->getStorage();

// // Specify the source folder in your Laravel app
// $sourceFolder = 'C:\xampp\htdocs\taskManager';

// // Specify the destination folder in Firebase Storage
// $destinationFolder = 'gs://managerarcx.appspot.com/';

// // Get a reference to the Firebase Storage location
// $storageRef = $storage->getBucket()->object($destinationFolder);

// // Upload files from the source folder to Firebase Storage
// foreach (glob($sourceFolder . '/*') as $file) {
//     $filename = basename($file);
//     $object = $storageRef->object($filename);
//     $object->upload(fopen($file, 'r'));
// }

