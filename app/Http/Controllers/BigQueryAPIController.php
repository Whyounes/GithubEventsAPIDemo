<?php

namespace app\Http\Controllers;

class BigQueryAPIController extends Controller
{
    /**
     * @var \Google_Service_Bigquery
     */
    protected $bigqueryService;

    public function __construct()
    {
        $this->bigqueryService = \App::make('bigquery');
    }

    public function topTen()
    {
        if (!\Input::has('language')) {
            return \View::make('home', ['repos' => null]);
        }

        $language = \Input::get('language', 'PHP');
        $projectID = 'modular-robot-647';
        $query_str = 'SELECT repository_url, MAX(repository_forks) as max_forks'.
            ' FROM githubarchive:year.2014'.
            " WHERE repository_language='$language'".
            ' GROUP EACH BY repository_url'.
            ' ORDER BY max_forks DESC'.
            ' LIMIT 10';

        $query = new \Google_Service_Bigquery_QueryRequest();
        $query->setQuery($query_str);

        $result = $this->bigqueryService->jobs->query($projectID, $query);
        $fields = $result->getSchema()->getFields();
        $repos = $result->getRows();

        return \View::make('home', ['repos' => $repos, 'tableHeader' => $fields]);
    }
}
