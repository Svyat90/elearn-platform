<?php

namespace App\Console\Commands;

use App\Document;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all documents to Elasticsearch';

    /**
     * @var Client
     */
    private Client $elasticSearch;

    /**
     * ReindexCommand constructor.
     * @param Client $elasticSearch
     */
    public function __construct(Client $elasticSearch)
    {
        parent::__construct();

        $this->elasticSearch = $elasticSearch;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');

        // ToDo clear old data

        foreach (Document::cursor() as $article) {
            $this->elasticSearch->index([
                'index' => $article->getSearchIndex(),
                'type' => $article->getSearchType(),
                'id' => $article->getKey(),
                'body' => $article->toSearchArray(),
            ]);

            $this->output->write('.');
        }

        $this->info('\nDone!');
    }
}
