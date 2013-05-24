<?php

    namespace net\pancakehttp;

    class Version {
		use Cache;

	    public $version = "";
	    public $shortDescription = "";
	    public $longDescription = "";
	    public $release = 0;
	    public $major = false;

	    private static $cacheIndices = array('version');

	    const TABLE = "versions";
	    const SORT_FUNCTION = "rsort";

	    public function getChangelog() {
		    return ChangelogEntry::getElementsByForeignKey('version', $this->id);
	    }
    }
?>
