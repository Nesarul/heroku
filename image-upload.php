<?php
// example of a PHP server code that is called in `uploadUrl` above
// file-upload.php script
header('Content-Type: application/json'); // set json response headers
$outData = upload(); // a function to upload the bootstrap-fileinput files
echo json_encode($outData); // return json data
exit(); // terminate
 
// main upload function used above
// upload the bootstrap-fileinput files
// returns associative array
function upload() {
    $preview = $config = $errors = [];
    $targetDir = 'uploads';
    if (!file_exists($targetDir)) {
        @mkdir($targetDir);
    }
    $fileBlob = 'fileCust';                      // the parameter name that stores the file blob
    if (isset($_FILES[$fileBlob])) {
        $file = $_FILES[$fileBlob]['tmp_name'];  // the path for the uploaded file chunk 
        $fileName =  date('YmdHis.').'jpg';
        $targetFile = $targetDir.'/'.$fileName;  // your target file path
        if(move_uploaded_file($file, $targetFile)) {
            
            return [
                'chunkIndex' => $index,         // the chunk index processed
                'initialPreview' => $targetUrl, // the thumbnail preview data (e.g. image)
                'initialPreviewConfig' => [
                    [
                        'type' => 'image',      // check previewTypes (set it to 'other' if you want no content preview)
                        'caption' => $fileName, // caption
                        'key' => $fileId,       // keys for deleting/reorganizing preview
                        'fileId' => $fileId,    // file identifier
                        'size' => $fileSize,    // file size
                        'zoomData' => $zoomUrl, // separate larger zoom data
                    ]
                ],
                'append' => true
            ];
        } else {
            return [
                'error' => 'Error uploading chunk ' . $_POST['chunkIndex']
            ];
        }
    }
    return [
        'error' => 'No file found'
    ];
}
 
// combine all chunks
// no exception handling included here - you may wish to incorporate that
function combineChunks($chunks, $targetFile) {
    // open target file handle
    $handle = fopen($targetFile, 'a+');
    
    foreach ($chunks as $file) {
        fwrite($handle, file_get_contents($file));
    }
    
    // you may need to do some checks to see if file 
    // is matching the original (e.g. by comparing file size)
    
    // after all are done delete the chunks
    foreach ($chunks as $file) {
        @unlink($file);
    }
    
    // close the file handle
    fclose($handle);
}
 
// generate and fetch thumbnail for the file
function getThumbnailUrl($path, $fileName) {
    // assuming this is an image file or video file
    // generate a compressed smaller version of the file
    // here and return the status
    $sourceFile = $path . '/' . $fileName;
    $targetFile = $path . '/thumbs/' . $fileName;
    //
    // generateThumbnail: method to generate thumbnail (not included)
    // using $sourceFile and $targetFile
    //
    if (generateThumbnail($sourceFile, $targetFile) === true) { 
        return 'http://localhost/uploads/thumbs/' . $fileName;
    } else {
        return 'http://localhost/uploads/' . $fileName; // return the original file
    }
}