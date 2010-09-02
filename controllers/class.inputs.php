<?php
class Input {
	private $input;
	private $output;

	public function Input($input) {
		$this->input = $input;
    $this->output = $this->processInput($this->input);
	}

  private function sanitise($src) {
    //Replace all funny characters with good equivelants
    $replaces =
    array(
      "\x80" => "e",  "\x81" => " ",    "\x82" => "'", "\x83" => 'f',
      "\x84" => '"',  "\x85" => "...",  "\x86" => "+", "\x87" => "#",
      "\x88" => "^",  "\x89" => "0/00", "\x8A" => "S", "\x8B" => "<",
      "\x8C" => "OE", "\x8D" => " ",    "\x8E" => "Z", "\x8F" => " ",
      "\x90" => " ",  "\x91" => "`",    "\x92" => "'", "\x93" => '"',
      "\x94" => '"',  "\x95" => "*",    "\x96" => "-", "\x97" => "--",
      "\x98" => "~",  "\x99" => "(TM)", "\x9A" => "s", "\x9B" => ">",
      "\x9C" => "oe", "\x9D" => " ",    "\x9E" => "z", "\x9F" => "Y");
    $src = strtr($src, $replaces);

    //Remove all non ascii chars (aka: bad Microsoft Word and Word Perfect)
    $src = preg_replace('/[^(\x20-\x7F)\x0A]*/','', $src);
    $src = addslashes(trim(strip_tags($src)));
    return $src;
	}

  public function processInput($input) {
    if (!is_array($input))
    {
      return $this->sanitise($input);
    } else {
      $out = array();
      foreach ($input as $key => $value) {
        $out[$key] = $this->processInput($value);
        if (strpos($key, "_") !== false)
        {
          $key = explode("_", $key);
          $index = array();
          for ($i=1; $i<count($key); $i++) {
            $index[] = $key[$i];
          }
          $out[$key[0]][implode("_", $index)] = $this->processInput($value);
        }
      }
      return $out;
    }
  }

	public function getOutput() {
    return $this->output;
	}
}

global $inputs;

$inputResults = new Input($_REQUEST);
$inputs = $inputResults->getOutput();
?>