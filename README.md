ESOO
====

**"es-o-o"** - An OO query layer for ES to make searching a little easier without having to constantly format arrays.

## Example

~~~
$c = new Esoo\Query();

$c->index = 'main_index';
$c->type = 'playlist';

$c->filtered = true;

if(isset($_GET['query'])){
	$c->query()->multiPrefix(array('burb', 'title', 'username'), $_GET['query']);
}

$c->filter()->and('term', array('userId' => strval($user->_id)))
			->and('term', array('deleted' => 0));
			
if(!$user === $o_user){
	$c->filter()->and('range', array('listing' => array('lt' => 1)));
}

$c->sort('created', 'desc');
$c->page(glue::http()->param('page', 1));

$es_client->search($c->get());
~~~

It essentially flatens the whole query strucutre a little so now you just got `query`, `filter` and `sort` and you toggle `filtered` as to whether or not the query should 
be wrapped in a `filtered` block. 

It reduces my code from 38 lines to about 14.

Includes a cursor which you can populate with the results of `search` to get a proper iterator with callbacks.

This repository may expand yet.
