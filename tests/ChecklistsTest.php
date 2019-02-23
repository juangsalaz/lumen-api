<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ChecklistsTest extends TestCase
{

    public function testShouldShowChecklist(){
        $this->get("checklists/1?api_token=WlJvREQ4bzhZbW1wc0FsREY5UmpEVGx1eXRxUGNJRlFoTGxWZzNpaw==", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' => [
                    'type',
                    'id',
                    'attributes',
                    'links' => [
                        'self'
                    ]
                ]
            ]    
        );
    }

    public function testShouldDeleteChecklist(){
        $this->delete("checklists/1", ['api_token'=>'WlJvREQ4bzhZbW1wc0FsREY5UmpEVGx1eXRxUGNJRlFoTGxWZzNpaw=='], []);
        $this->seeStatusCode(204);
        $this->seeJsonStructure([]);
    }
}
