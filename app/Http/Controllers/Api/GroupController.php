<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use \App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Groups api controller
 *
 * Class GroupsController
 */
class GroupController extends Controller
{

    /**
     * Get all groups
     *
     * @method: GET
     * @url: .../api/groups
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllGroups()
    {
        $client = new Client();
        $req = $client->request('GET', 'http://api.rozklad.org.ua/v2/groups');
        $content = json_decode($req->getBody()->read(1000000));
        $count = $content->meta->total_count + 100;

        $result = [];
        for ($i = 0; $i < $count; $i += 100) {
            $url = 'http://api.rozklad.org.ua/v2/groups/?filter={"offset":' . $i . '}';
            $req = $client->request('GET', $url);
            $content = json_decode($req->getBody()->read(1000000));

            if (!empty($content) && isset($content->data)) {
                foreach ($content->data as $item) {
                    $temp['id'] = $item->group_id;
                    $temp['name'] = $item->group_full_name;
                    $result[] = $temp;
                }
            }
        }

        return response()->json($result);
    }

}
