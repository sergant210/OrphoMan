<?php

/**
 * Get a list of Items
 */
class OrphoManGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'OrphoMan';
	public $classKey = 'OrphoMan';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	//public $permission = 'list';


	/**
	 * * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return boolean|string
	 */
	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		$query = trim($this->getProperty('query'));
		if ($query) {
			$c->where(array(
				'text:LIKE' => "%{$query}%",
				'OR:comment:LIKE' => "%{$query}%",
			));
		}

		return $c;
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$array['actions'] = array();

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-black',
			'title' => $this->modx->lexicon('orphoman_item_remove'),
			'multiple' => $this->modx->lexicon('orphoman_items_remove'),
			'action' => 'removeItem',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'OrphoManGetListProcessor';