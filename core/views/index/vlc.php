<?php
$file_encoded=str_replace(' ', '%20', $file);
$file_encoded=str_replace('[', '%5b', $file_encoded);
$file_encoded=str_replace('[', '%5d', $file_encoded);
?>
<playlist version="1" xmlns="http://xspf.org/ns/0/">
    <trackList>
        <track>
            <title><?php echo $file; ?></title>
            <location><?php echo $file_encoded; ?></location>
        </track>
    </trackList>
</playlist>