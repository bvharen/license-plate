<?php

declare(strict_types=1);

namespace Bvanharen\LicensePlate;

class LicensePlate
{
    private $licensePlate;
    private $formattedLicensePlate;
    private $validate = false;
    private $valid =[
        'XX-99-99',
        '99-99-XX',
        '99-XX-99',
        'XX-99-XX',
        'XX-XX-99',
        '99-XX-XX',
        '99-XXX-9',
        '9-XXX-99',
        'XX-999-X',
        'X-999-XX',
    ];

    public function check(string $licensePlate):string{
        $this->validate();
    }

    public function set(string $licensePlate){
        $this->licensePlate = $licensePlate;
    }

    public function get():string{
        $this->generateFormat();
        return $this->formattedLicensePlate;
    }

    public function setValid(array $licenses){
        $this->valid = $licenses;
    }

    public function addValid(string $license){
        $this->valid[] = $license; 
    }

    public function getValid():array{
        return $this->valid;
    }

    protected function generateFormat(){
        foreach($this->valid as $licenseFormat){
            $regex = $this->fromLicenseToRegEx($licenseFormat);
            preg_match($regex, $this->licensePlate, $matches);
            if(count($matches) > 0){
                array_shift($matches);
                $this->formattedLicensePlate = implode('-',$matches);
                break;
            }
        }
    }

    public function setValidate(bool $validate){
        $this->validate = $validate;
    }

    public function validate(){
        if($this->validate){
			$this->checkIsFormatted();
            $this->checkChars();
            $this->checkLength();
            $this->checkEmpty();
        }
    }

    private function checkLength(){
        if(strlen($this->licensePlate) !== 6){
            throw new Exception('licensePlate is not 6 characters');
        }
    }

    private function checkEmpty(){
        if($this->licensePlate === ''){
            throw new Exception('License plate is empty');
        }
    }

    private function checkChars(){
        if(!ctype_alnum($this->licensePlate)){
            throw new Exception('License plate is not valid'); 
        }
    }

    private function checkIsFormatted(){
        if(strpos($this->licensePlate,'-') !== false){
            throw new Exception('License plate already formatted');
        }
    }
 
    private function fromLicenseToRegEx($licensePlate){
        $exploded = explode('-',$licensePlate);
        $regex = [];
        foreach($exploded as $chapters){
            if (is_numeric($chapters)) {  
                $regex[] = '(\d{'.strlen($chapters).'})'; 
            } else { 
                $regex[] = '([A-Z]{'.strlen($chapters).'})'; 
            } 
        } 
        return '/^'.implode($regex).'$/';
    }
}

