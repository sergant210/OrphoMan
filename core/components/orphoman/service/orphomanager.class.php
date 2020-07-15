<?php

/**
 * OrphoManager class.
 *
 */
class OrphoManager
{

    /* @var modX $modx */
    public $modx;
    /** @var array $config */
    public $config;

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX $modx, array $config = array())
    {

        $this->modx = $modx;

        $corePath = $this->modx->getOption('orphoman_core_path', $config, $this->modx->getOption('core_path') . 'components/orphoman/');
        $assetsUrl = $this->modx->getOption('orphoman_assets_url', $config, $this->modx->getOption('assets_url') . 'components/orphoman/');
        $connectorUrl = $assetsUrl . 'connector.php';

        $config['min'] = !empty($config['min']) && is_numeric($config['min']) ? (int)$config['min'] : 5;
        $config['max'] = !empty($config['max']) && is_numeric($config['max']) ? (int)$config['max'] : 100;
        $this->config = array_merge(array(
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'connectorUrl' => $connectorUrl,
            'actionUrl' => $assetsUrl . 'action.php',
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'templatesPath' => $corePath . 'elements/templates/',
            'processorsPath' => $corePath . 'processors/',
            'css' => $this->modx->getOption('orphoman.frontend_css', null, ''),
            'js' => $this->modx->getOption('orphoman.frontend_js', null, ''),
        ), $config);
        $this->modx->addPackage('orphoman', $this->config['modelPath']);
        $this->modx->lexicon->load('orphoman:default');
    }

    /**
     * Initializes component into different contexts.
     *
     * @param string $ctx The context to load. Defaults to web.
     *
     * @return boolean
     */
    public function initialize($ctx = 'web')
    {
        switch ($ctx) {
            case 'mgr':
                break;
            default:
                if (!defined('MODX_API_MODE') || !MODX_API_MODE) {
                    $min = $this->modx->getOption('min', $this->config, 5);
                    $max = $this->modx->getOption('max', $this->config, 100);
                    $messageMin = $this->modx->lexicon('orphoman_message_min');
                    $messageMax = $this->modx->lexicon('orphoman_message_max');
                    $actionUrl = $this->config['actionUrl'];
                    $resource = $this->modx->resource->id;
//                    $style = $this->modx->getOption('orphoman.frontend_css',null,'');
                    $style = $this->config['css'];
                    if ($style) {
                        $this->modx->regClientCSS($style);
                    }
//                    $js = $this->modx->getOption('orphoman.frontend_js',null,'');
                    $js = $this->config['js'];
                    if ($js) {
                        $this->modx->regClientScript($js);
                    }

                    $config_js = "<script>\n var orphoConfig = {\n\tactionUrl:'{$actionUrl}',\n\tmin:{$min},\n\tmax:{$max},\n\tresource:{$resource},
\tmessageMin:'{$messageMin}',\n\tmessageMax:'{$messageMax}'\n};\n</script>";
                    $this->modx->regClientStartupScript($config_js, true);
                    if ($confirmDlg = $this->modx->getChunk($this->config['tpl'])) {
                        $this->modx->regClientHTMLBlock($confirmDlg);
                    };
                    //Показываем кнопку //Show the button "Found a mistake"
                    if ($tpl = $this->modx->getChunk($this->config['tplButton'])) {
                        $this->modx->regClientHTMLBlock($tpl);
                    };
                    // Подключаем jGrowl, если загрузка не отключена. //Register jGrowl if set to true
                    if ($this->config['loadjGrowl']) {
                        $this->modx->regClientCSS($this->config['cssUrl'] . 'jquery.jgrowl.css');
                        $this->modx->regClientScript($this->config['jsUrl'] . 'jquery.jgrowl.min.js');
                    }
                }
                break;
        }
        return true;
    }

    /** Save text
     * @param array $data POST data
     * @return array
     */
    public function saveError($data = array())
    {
        $text = $this->sanitizeString($data['text']);
        if ($error = $this->validateText($text)) {
            $this->error($error);
        }
        $comment = $this->sanitizeString($data['comment']);
        $resource_url = MODX_MANAGER_URL . 'index.php?a=resource/update&id=' . (int)$data['resource'];
        $OrphoMan = $this->modx->newObject('OrphoMan');
        $OrphoMan->fromArray(
            array(
                'resource_id' => (int)$data['resource'],
                'text' => $text,
                'comment' => $comment,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'createdon' => date('d.m.Y H:i:s'),
                'resource_url' => $resource_url,
            )
        );
        if (!$OrphoMan->save()) {
            return $this->error($this->modx->lexicon('orphoman_err_save'));
        }
        $this->sendMail($data);
        return $this->success($this->modx->lexicon('orphoman_success_save'));
    }

    /**
     * @param $string
     * @return string
     */
    protected function sanitizeString($string)
    {
        $string = strip_tags(trim($string));
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * @param $string
     * @return string|null
     */
    protected function validateText($string)
    {
        switch (true) {
        	case empty($string):
        	    $response = $this->modx->lexicon('orphoman_err_empty_string');
        		break;
        	case mb_strlen($string) < $this->config['min']:
        	    $response = $this->modx->lexicon('orphoman_message_min') . $this->config['min'] . '!';
        		break;
        	case mb_strlen($string) > $this->config['max']:
        	    $response = $this->modx->lexicon('orphoman_message_max') . $this->config['max'] . '!';
        		break;
            default:
                $response = null;
        }

        return $response;
    }

    /** Send mail
     * @param array $data
     * @return bool
     */
    public function sendMail($data = array())
    {
        $email = $this->modx->getOption('orphoman.mail_to');
        if (empty($email)) {
            return false;
        }

        /* @var modPHPMailer $mail */
        $mail = $this->modx->getService('mail', 'mail.modPHPMailer');
        $mail->setHTML(true);
        $pageUrl = $this->modx->makeUrl($data['resource'], '', '', 'full');
        $subject = $this->modx->getOption('orphoman.email_subject', null, $this->modx->lexicon('orphoman_email_subject'), true);
        $res = $this->modx->getObject('modResource', $data['resource']);
        $pagetitle = $res->get('pagetitle');
        $body = $this->modx->getOption('orphoman.email_body', null, $this->modx->lexicon('orphoman_email_body'), true);
        $body = str_replace(array('{id}', '{pagetitle}', '{error}', '{comment}'), array($pageUrl, $pagetitle, $data['text'], $data['comment']), $body);

        $mail->set(modMail::MAIL_SUBJECT, $subject);
        $mail->set(modMail::MAIL_BODY, $body);
        $mail->set(modMail::MAIL_SENDER, $this->modx->getOption('emailsender'));
        $mail->set(modMail::MAIL_FROM, $this->modx->getOption('emailsender'));
        $mail->set(modMail::MAIL_FROM_NAME, $this->modx->getOption('site_name'));

        $mail->address('to', $email);


        if (!$mail->send()) {
            $this->modx->log(modx::LOG_LEVEL_ERROR, 'An error occurred while trying to send the email: ' . $mail->mailer->ErrorInfo);

            $mail->reset();
            return false;
        }

        $mail->reset();
        return true;
    }

    /** This method returns an error
     *
     * @param string $message Error message
     * @param array $data .Additional data
     *
     * @return array $response
     */
    protected function error($message = '', $data = array())
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
    }

    /** This method returns a success
     *
     * @param string $message Success message
     *
     * @return array $response
     * */
    protected function success($message = '')
    {
        return [
            'success' => true,
            'message' => $message,
        ];
    }

}