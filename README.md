ESOO
====

**"es-oo"** - An OO layer for ES to make searching a little easier without having to constantly format arrays.

## Example

~~~
[php]
$q = new esoo\client()
  ->index('main')
  ->type('user')
  ->body()
    ->bool()
    ->must()
      ->match(array('username' => array(
        'query' => 'sammaye'
      )))
      ->match(array('tags' => 'weekend'))
      ->range(array('created' => array('gte' => date('c',time()-3600), 'lte' => date('c',time()+3600))));

$q->body()->bool()->->must()->must_not()->range(array( /* ... */ ));
$q->search();

// Can use Elastic Searches normal API
$q->index(array( /* ... */ ));
~~~
