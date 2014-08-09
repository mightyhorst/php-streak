##php-streak
==========
A thin wrapper for building queries for Google Streak. 
###Init:
```php
$streak = new Streak('your_api_key_here');
```

###Building a Query:
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
