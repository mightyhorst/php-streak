##php-streak
==========
A thin wrapper for building queries for Google Streak. All responses are returned in JSON, so no parsing is taking place, yet. 
###Start:
```php
$streak = new Streak('your_api_key_here');
```

###Building a Query:
All queries follow one of two patterns:
```
class->Method(Method_param)->verb();
```
or
```
class->Method(Method_param)->subMethod(subMethod_param)->verb();
```
Parameters are optional. This was built to remain readable, but functional.
####Getting all Pipelines:
```php
$pipelines = $streak->Pipeline()->get();
$pipelines = json_decode($pipelines, true);
foreach($pipelines as $pipeline) {
  print("Pipeline:".$pipeline['name']);
  print("Key:".$pipeline['key']);
}
```
####Getting all Boxes in Pipeline:
```php
$pipelines = $streak->Pipeline('pipeline_key_here')->Boxes()->get();
```
####Editing a Box:
```php
$important_stage_key = 5005;
$box_contents = ("notes"=>"Updated notes.", stageKey=>$important_stage_key);
$box = $streak->Box('box_key_here')->post($box_contents);
```
