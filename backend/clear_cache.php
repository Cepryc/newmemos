<?php
function cleanDir($dir) {
    $files = glob($dir."/*");
    $c = count($files);
    if (count($files) > 0) {
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}







cleanDir("../date/1hl");
cleanDir("../date/1hr");
cleanDir("../date/1hm");
cleanDir("../date/3dl");
cleanDir("../date/3dr");
cleanDir("../date/3dm");
cleanDir("../date/3hl");
cleanDir("../date/3hr");
cleanDir("../date/3hm");
cleanDir("../date/6hl");
cleanDir("../date/6hr");
cleanDir("../date/6hm");
cleanDir("../date/7dl");
cleanDir("../date/7dr");
cleanDir("../date/7dm");
cleanDir("../date/12hl");
cleanDir("../date/12hr");
cleanDir("../date/12hm");
cleanDir("../date/14dl");
cleanDir("../date/14dr");
cleanDir("../date/14dm");
cleanDir("../date/24hl");
cleanDir("../date/24hr");
cleanDir("../date/24hm");
cleanDir("../date/30dl");
cleanDir("../date/30dr");
cleanDir("../date/30dm");









?>