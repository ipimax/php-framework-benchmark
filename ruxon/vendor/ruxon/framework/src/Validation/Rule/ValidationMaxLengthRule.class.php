<?php

class ValidationMaxLengthRule extends ValidationRule
{
	protected $sAlias;

	protected $sTitle;
    
    protected $nMaxLength = 255;

	protected $sErrorText = 'Field "{Field}" should be up to {EndLength} characters.';

	public function __construct($aParams)
	{
		$this->sAlias   = $aParams[0];
		$this->sTitle   = $aParams[1];
        $this->nMaxLength = $aParams[2];
        
		if (isset($aParams[3])) {
			$this->sErrorText = $aParams[3];
		}
	}

	public function getAlias()
	{
		return $this->sAlias;
	}

	public function getTitle()
	{
		return $this->sTitle;
	}

	public function getErrorText()
	{
		return $this->sErrorText;
	}

	public function check($sValue)
	{
		if ((is_numeric($sValue) && $sValue > 0) || (!is_numeric($sValue))) {
			
            if (mb_strlen($sValue, "utf8") <= $this->nMaxLength) {
                return true;
            }
		}

        return Core::app()->t('Ruxon', $this->getErrorText(), [
            'Field' => $this->getTitle(),
            'EndLength' => $this->nMaxLength
        ], null, 'ruxon/framework/messages');
	}
}

?>
