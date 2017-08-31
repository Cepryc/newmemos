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







cleanDir("../../memes/date/1hl");
cleanDir("../../memes/date/1hr");
cleanDir("../../memes/date/1hm");
cleanDir("../../memes/date/3dl");
cleanDir("../../memes/date/3dr");
cleanDir("../../memes/date/3dm");
cleanDir("../../memes/date/3hl");
cleanDir("../../memes/date/3hr");
cleanDir("../../memes/date/3hm");
cleanDir("../../memes/date/6hl");
cleanDir("../../memes/date/6hr");
cleanDir("../../memes/date/6hm");
cleanDir("../../memes/date/7dl");
cleanDir("../../memes/date/7dr");
cleanDir("../../memes/date/7dm");
cleanDir("../../memes/date/12hl");
cleanDir("../../memes/date/12hr");
cleanDir("../../memes/date/12hm");
cleanDir("../../memes/date/14dl");
cleanDir("../../memes/date/14dr");
cleanDir("../../memes/date/14dm");
cleanDir("../../memes/date/24hl");
cleanDir("../../memes/date/24hr");
cleanDir("../../memes/date/24hm");
cleanDir("../../memes/date/30dl");
cleanDir("../../memes/date/30dr");
cleanDir("../../memes/date/30dm");









?>