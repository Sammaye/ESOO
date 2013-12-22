<?php
namespace Esoo;

class Cursor implements \Iterator, \Countable{

	public $maxPage;
	public $matches;
	public $totalFound = 0;

	public $iteratorCallback;

	public function __construct($result)
	{
		if (isset($result['hits']) && isset($result['hits']['hits'])) {
			$this->totalFound=$result['hits']['total'];
			$this->matches = $result['hits']['hits'];
			reset($this->matches);
		}
	}

	public function setIteratorCallback($callback)
	{
		$this->iteratorCallback=$callback;
	}

	function matches()
	{
		return $this->matches;
	}

	function currentMatch()
	{
		return current($this->matches);
	}

	function current()
	{
		if (($c=current($this->matches)) !== false) {
			$fn=$this->iteratorCallback;
			$className=$this->className;
			
			if ((is_string($fn) && function_exists($fn)) || (is_object($fn) && $fn instanceof \Closure))
				return $fn($c,$this->className);
			else
				return (Object)$c;
		} else
			return  false;
	}

	public function count()
	{
		return count($this->matches);
	}

	public function key()
	{
		return key($this->matches);
	}

	public function next()
	{
		return next($this->matches);
	}

	public function valid()
	{
		return $this->currentMatch() !== false;
	}

	public function rewind()
	{
		reset($this->matches);
	}

	public function skip($n)
	{
		return $this;
	}

	public function limit($n)
	{
		return $this;
	}
}