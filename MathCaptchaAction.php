<?php

namespace long399\captcha;

use yii\captcha\CaptchaAction;
use yii\base\InvalidConfigException;

/**
 * Class implements advanced captcha action with mathematical expressions. Based on [[yii\captcha\CaptchaAction]].
 * @see yii\captcha\CaptchaAction
 * @link https://github.com/samdark/yii2-cookbook/blob/master/book/forms-captcha.md
 * @author r_prokopenko
 */
class MathCaptchaAction extends CaptchaAction
{
    /** @var int minimal value for generating code */
    public $minLength = 0;

    /** @var int maximal value for generating code */
    public $maxLength = 100;

    /** @var array operations list for captcha */
    public $operations = ['+', '-'];

    /** @var array available operarations list for captcha */
    const AVAILABLE_OPERATIONS = ['+', '-'];

    /**
     * {@inheritDoc}
     * @see \yii\captcha\CaptchaAction::init()
     */
    public function init()
    {
        foreach($this->operations as $operation) {
            if (!in_array($operation, self::AVAILABLE_OPERATIONS)) {
                throw new InvalidConfigException(
                    'The `operations` config option must contain only ['.implode(', ', self::AVAILABLE_OPERATIONS).'] operations.'
                );
            }
        }
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    protected function generateVerifyCode()
    {
        return mt_rand((int)$this->minLength, (int)$this->maxLength);
    }

    /**
     * {@inheritdoc}
     */
    protected function renderImage($code)
    {
        return parent::renderImage($this->getText($code));
    }

    /**
     * Get mathematical expression for image rendering.
     * @param string $code
     * @return string
     */
    protected function getText($code)
    {
        $code = (int)$code;
        $rand = mt_rand(min(1, $code - 1), max(1, $code - 1));
        $operation = mt_rand(0, count($this->operations) - 1);

        switch($this->operations[$operation]) {
            case '+': return $code - $rand . '+' . $rand;
            case '-': return $code + $rand . '-' . $rand;
        }
    }
}
