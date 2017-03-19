<?php

/**
 * Get an Item
 */
class OrphoManGetProcessor extends modObjectGetProcessor {
    public $objectType = 'OrphoMan';
    public $classKey = 'OrphoMan';
    public $languageTopics = array('orphoman:default');
    //public $permission = 'view';

    /**
     * {@inheritdoc}
     */
    public function cleanup() {
        $output =  $this->object->toArray();
        $output['comment'] = htmlspecialchars_decode($output['comment'], ENT_QUOTES);
        $output['pagetitle'] = html_entity_decode($this->object->Resource->pagetitle);
        return $this->success('',$output);
    }
}

return 'OrphoManGetProcessor';