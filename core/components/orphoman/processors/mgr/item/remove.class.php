<?php

/**
 * Remove an Items
 */
class OrphoManRemoveProcessor extends modObjectProcessor {
	public $objectType = 'OrphoMan';
	public $classKey = 'OrphoMan';
	public $languageTopics = array('orphoman');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('orphoman_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var OrphoMan $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('orphoman_item_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'OrphoManRemoveProcessor';