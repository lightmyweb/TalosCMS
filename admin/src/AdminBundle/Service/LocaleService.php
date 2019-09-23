<?php
namespace AdminBundle\Service;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class LocaleService{

	private $config_path ;
	private $routing_path ;

	public function __construct($path){
		$this->config_path = $path.'locale.yml';
		$this->routing_path = $path.'../app/config/routing.yml';
	}
	public function changeDefaultLocale($locale){
		$data = Yaml::parseFile($this->config_path);
		$data['parameters']['locale'] = $locale;
		$data['framework']['translator']['fallbacks'] = array($locale);
		$data['a2lix_translation_form']['default_locale'] = $locale;
		$data['a2lix_translation_form']['required_locales'][0] =  $locale;
		$yaml = Yaml::dump($data);
		file_put_contents($this->config_path, $yaml);
	}

	public function setNewLocales($locale){
		$data = Yaml::parseFile($this->config_path);
		$result = false;
		$testIfExiste = $this->checkIfInArray($locale,$data['a2lix_translation_form']['locales']);
		if ( $testIfExiste == false ){
			$data['a2lix_translation_form']['locales'][] = $locale ;
			$yaml = Yaml::dump($data);
			file_put_contents($this->config_path, $yaml);
			$this->addLocaleToRouting($locale);
			$result = true;
		}
		return $result;
		
	}

	public function removeLocale($locale){
		$result = false;
		$data = Yaml::parseFile($this->config_path);
		$testIfExiste = $this->checkIfInArray($locale,$data['a2lix_translation_form']['locales']);
		if( $testIfExiste == true ){
			$data['a2lix_translation_form']['locales'] =  $this->removeFromArray( $locale,$data['a2lix_translation_form']['locales'] );
			$yaml = Yaml::dump($data);
			file_put_contents($this->config_path, $yaml);
			$this->delteLocaleFromRouting($locale);
			$result = true;
		}
		return $result;
	}

	private function removeFromArray($locale,$array){
		$result = false;
		$final_array = array();
		for( $i = 0; $i < sizeof( $array ) ; $i++ ){
			if ( $array[$i] != $locale ){
				$final_array[] = $array[$i] ;
			}
		}
		return $final_array;
	}

	private function checkIfInArray($locale,$array){
		$result = false;
		for( $i = 0; $i < sizeof( $array ) ; $i++ ){
			if ( $array[$i] == $locale ){
				$result = true;
			}
		}
		return $result;
	}	

	private function delteLocaleFromRouting($locale){
		$data = Yaml::parseFile($this->routing_path);
		$oldString = explode("|",$data['front']['requirements']['_locale']);
		$newString = '';
		for( $i = 0; $i < sizeof($oldString) ; $i++ ){
            if ( $oldString[$i] != $locale ){
                $newString = $newString.'|'.$oldString[$i];
            }
        }
        $newString = substr($newString, 1);
        $data['front']['requirements']['_locale'] = $newString ;
        $yaml = Yaml::dump($data);
		file_put_contents($this->routing_path, $yaml);
	}

	private function addLocaleToRouting($locale){
		$data = Yaml::parseFile($this->routing_path);
		$data['front']['requirements']['_locale'] = $data['front']['requirements']['_locale'].$locale.'|';
		$yaml = Yaml::dump($data);
		file_put_contents($this->routing_path, $yaml);
	}

}