<?php
switch ($modx->event->name) {
    case 'OnWebPagePrerender':
        if ($modx->user->hasSessionContext('mgr')) {
            if (!$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'service/')) {
                $modx->log(modx::LOG_LEVEL_ERROR, ' The plugin could not load OrphoMan class!');
            } else {
                $auto_delete = (bool)$modx->getOption('orphoman.auto_delete', null, true);
                $highlight = (bool)$modx->getOption('orphoman.highlight', null, true);
                $tpl = $modx->getOption('orphoman.tpl', null, '<span class="error-text" title="{comment}">{text}</span>', true);
                $output = &$modx->resource->_output;
                $c = $modx->newQuery("OrphoMan");
                $c->select('id,resource_id,text,ip,comment,createdon');
                $c->where(array('resource_id' => $modx->resource->id));
                $words = $highlighted_words = $mustdelete = array();
                if ($c->prepare() && $c->stmt->execute()) {
                    while ($row = $c->stmt->fetch(PDO::FETCH_ASSOC)) {
                        if ($auto_delete) {
                            $exists = strpos($output, $row['text']);
                            if ($exists === false) {
                                $mustdelete[] = $row['id'];
                                continue;
                            }
                        }
                        if (!in_array($row['text'], $words)) {
                            $words[] = $row['text'];
                            $highlighted_words[] = str_replace(array('{text}', '{comment}'), array($row['text'], $row['comment']), $tpl);
                        }
                    }
                    //Удаляем слова, которых уже нет в контенте, предполагаем что исправлены.
                    if ($auto_delete && !empty($mustdelete)) {
                        $c = $modx->newQuery("OrphoMan");
                        $c->command('delete');
                        $c->where(array('id:IN' => $mustdelete));
                        $c->prepare();
                        if (!$c->stmt->execute()) {
                            $modx->log(modx::LOG_LEVEL_ERROR, 'Ошибка удаления исправленных слов из БД!');
                        }
                    }
                    // Выделяем слова с ошибками
                    if ($highlight && !empty($words)) {
                        $output = str_replace($words, $highlighted_words, $output);
                    }
                }
            }
        }
        break;
}