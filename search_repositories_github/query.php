<?php
class Query
{
  public $query = '
    query q{
        search(query: "stars:>{stars}", type: REPOSITORY, first:{first}{after}){
        pageInfo{
            hasNextPage
            endCursor
        }
        nodes{
            ... on Repository{
              name
              owner{
                login
              }
      
              stargazers {
              totalCount
            }
              pullRequests(states: MERGED){
              totalCount
              
            }
              releases{
              totalCount
            }
              primaryLanguage{
              name
              
            }
              issuesCloseds:issues (states: CLOSED){
              totalCount
            }
            
            issues{
              totalCount
            }
              createdAt
              pushedAt
              
            }
          }
        }
        rateLimit {
            limit
            remaining
          }
      }
      ';

  function mountQuery($stars = 1000, $first = 100, $after = null)
  {
    if ($after != null) {
      $after = ', after:"' . $after . '"';
    }
    if ($stars == null) {
      $stars = 1000;
    }
    if ($first == null) {
      $first = 100;
    }

    $readyQuery = str_replace(array('{stars}', '{first}', '{after}'), array($stars, $first, $after), $this->query);
    return $readyQuery;
  }
}
