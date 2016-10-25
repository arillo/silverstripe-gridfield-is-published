<?php

class GridFieldIsPublishedExtension extends DataExtension
{

	public static function recordIsPublished($record) {
		if (!$record->hasExtension('Versioned')) {
			return false;
		}

		if (!$record->isInDB()) {
			return false;
		}

		$table = $record->class;

		while (($p = get_parent_class($table)) !== 'DataObject') {
			$table = $p;
		}

		return (bool) DB::query("SELECT \"ID\" FROM \"{$table}_Live\" WHERE \"ID\" = {$record->ID}")->value();
	}

	/**
	* Make use of RowExtraClassesGridField used via Injector in config.yml
	*
	* @return Array
	*/
	public function GridFieldRowClasses() {
		$classes = array();
		if($this->owner->stagesDiffer('Stage','Live')) $classes[] = "is-modified";
		if(self::recordIsPublished($this->owner)){
			$classes[] = "is-published";
		} else {
			$classes[] = "is-unpublished";
		}
		return $classes;
	}
}
