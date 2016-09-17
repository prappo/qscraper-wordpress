<?php
namespace MyPlugin\Controllers;
use Herbert\Framework\Http;

class TwitterController{
    public function index(){
        $url = get_site_url();
        return view('@MyPlugin/twitter.twig',['url'=>$url]);
    }

    public function scraper(Http $re){

        $consumerKey = SettingsController::get('twConKey');
        $consumerSecret = SettingsController::get('twConSec');
        $accessToken = SettingsController::get('twToken');
        $tokenSecret = SettingsController::get('twTokenSec');

        $query = $re->data;
        $limit = $re->limit;
        $type = strtolower($re->type);


        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        if ($type == 'tweets') {
            $datas = $twitter->request('search/tweets', 'GET', array('q' => $query, 'count' => $limit));

            echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>ID</th>
                                <th>Tweets</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Tweet link</th>
                                <th>Tweet details</th>
                                
                            </tr>
                            </thead>
                            <tbody>';
            foreach ($datas->statuses as $no => $data) {
//

                echo "<tr>";
                echo "<td>{$data->id}</td>";
                echo "<td>{$data->text}</td>";
                echo "<td>".SettingsController::date($data->created_at)."</td>";
                echo "<td>".
                    '<img class="img-circle" src="' . $data->user->profile_image_url . '"><br>'.
                    "<a target='_blank' href='https://twitter.com/".$data->user->screen_name."'>{$data->user->name}</a>"
                    ."</td>";
                echo "<td><a target='_blank' href='https://twitter.com/".$data->user->screen_name."/status/".$data->id."'>Click here</a></td>";
                echo "<td>".
                    "Retweeted : ".$data->retweet_count."<br>".
                    "Favorite : ".$data->favorite_count
                    ."</td>";
                echo '</tr>';
            }


            echo '</tbody><tfoot>
                            <tr> 
                                <th>ID</th>
                                <th>Tweets</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Tweet link</th>
                                <th>Tweet details</th>
                                
                            </tr>
                            </tfoot>
                        </table>';



        } elseif ($type == 'user') {
            $datas = $twitter->request('users/search', 'GET', array('q' => $query, 'count' => $limit));
            echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Followers</th>
                                <th>Friends</th>
                                <th>Joined</th>
                                
                                <th>Statuses</th>
                            </tr>
                            </thead>
                            <tbody>';

            foreach ($datas as $datano => $data){
                echo "<tr>";
                echo "<td>".'<img class="img-circle" src="'.$data->profile_image_url.'"><br>'.'<a target="_blank" href="https://twitter.com/'.$data->screen_name.'">'.$data->name. "</a></td>";
                echo "<td>".$data->screen_name."</td>";
                echo "<td>".$data->location."</td>";
                echo "<td>".$data->description."</td>";
                echo "<td>".$data->followers_count."</td>";
                echo "<td>".$data->friends_count."</td>";
                echo "<td>".SettingsController::date($data->created_at)."</td>";

                echo "<td>".$data->statuses_count."</td>";
                echo "</tr>";
            }

            echo '</tbody><tfoot>
                            <tr> 
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Followers</th>
                                <th>Friends</th>
                                <th>Joined</th>
                                
                                <th>Total Status</th>
                            </tr>
                            </tfoot>
                        </table>';
        } elseif ($type == 'geo') {
            $datas = $twitter->request('geo/search', 'GET', array('query' => $query, 'count' => $limit));
            print_r($datas);
        }
        echo "<script>
 var table = $('#mytable').DataTable({

        dom: '<\"\"flB>tip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class=\"fa fa-file-excel-o\"></i> Export all to excel'
            },
            {
                extend: 'csv',
                text: '<i class=\"fa fa-file-o\"></i> Export all to csv'
            },
            {
                extend: 'pdf',
                text: '<i class=\"fa fa-file-pdf-o\"></i> Export all to pdf'
            },
            {
                extend: 'print',
                text: '<i class=\"fa fa-print\"></i> Print all'
            },
            {
                extend: 'colvis',
                text: '<i class=\"fa fa-eye\"></i> Column visibility'
            },
        ]
    });
               </script>
        ";
    }
}