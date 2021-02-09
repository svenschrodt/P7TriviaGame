# P7TriviaGame

## Description 
Simple trivia game app

  - consuming "Open Trivia DB" API 
  - compatible with PHP 7.4+

## installation

## usage

You can directly use the application without external API call using the dumped questions in file cache

--> @see P7TriviaGame\Persistence\FileCacheApi

## Technical documentation

### Caching / Persistence

#### File cache persistence

## Apendix

- For opentdb api documentation @see https://opentdb.com/api_config.php


### Used API endpoints

- https://opentdb.com/api.php?amount=10
- https://opentdb.com/api.php?amount=10&token=YOURTOKENHERE
- https://opentdb.com/api_token.php?command=request
- https://opentdb.com/api_token.php?command=reset&token=YOURTOKENHERE
- 


### Directory structure
<pre>

</pre>

### Changelog


### TODOs | future goals

- Caching API response to file cache (later: DB etc.)
- Using token to suppress duplicates for six hours
- PSR-* compliance
- Deployable via composer
- 100% code coverage in unit testing
- 