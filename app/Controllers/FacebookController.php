<?php
namespace MyPlugin\Controllers;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Herbert\Framework\Http;
use MyPlugin\Models\Data;

class FacebookController
{
    public function index()
    {
        $url = get_site_url();
        return view('@MyPlugin/facebook.twig', ['url' => $url]);
    }

    public function scraper(Http $re)
    {
        if(SettingsController::get('fbToken') == ""){
            return "Facebook Token not found . Please go to <a href='admin.php?page=qscrapersettings'>settings page</a>";
        }

        if(SettingsController::get('fbAppSec') == ""){
            return "Facebook App secret not found . Please go to <a href='admin.php?page=qscrapersettings'>settings page</a>";
        }

        if(SettingsController::get('fbAppId') == ""){
            return "Facebook App Id not found . Please go to <a href='admin.php?page=qscrapersettings'>settings page</a>";
        }



        $query = $re->data;
        $type = strtolower($re->type);
        $limit = $re->limit;
        if ($limit == "") {
            $limit = 10;
        }


        $token = SettingsController::get('fbToken');

        $fb = new Facebook([
            'app_id' => SettingsController::get('fbAppId'),
            'app_secret' => SettingsController::get('fbAppSec'),
            'default_graph_version' => 'v2.6',
        ]);


        try {
            if ($type == 'page') {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,name,picture,link,phone,website,location,fan_count,about,emails' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Emails</th>
                                <th>Likes</th>
                                <th>About</th>
                            </tr>
                            </thead>
                            <tbody>';
                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $picture = "";
                    $name = "";
                    $phone = "";
                    $website = "";
                    $location = "";
                    $emails = "";
                    $about = "";
                    $likes = "";
                    $lo = "";
                    $em = "";
                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['picture'])) {
                            $picture = $data['picture'];
                        }

                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['phone'])) {
                            $phone = $data['phone'];
                        }
                        if (isset($data['website'])) {
                            $website = $data['website'];
                        }

                        if (isset($data['location'])) {
                            $location = $data['location'];
                        }

                        if (isset($data['emails'])) {
                            $emails = $data['emails'];
                        }

                        if (isset($data['about'])) {
                            $about = $data['about'];
                        }
                        if (isset($data['fan_count'])) {
                            $likes = $data['fan_count'];
                        }
                        if (isset($data['link'])) {
                            $link = $data['link'];
                        }
                    }

//                    Save phone and email into database
                    if ($phone != "" || $emails != "") {
                        if (is_array($emails)) {
                            foreach ($emails as $email) {
                                $em .= $email . " ";
                            }

                        }

                        try {
                            if (!Data::where('name', $name)->exists()) {
                                $data = new Data();
                                $data->name = $name;
                                $data->phone = $phone;
                                $data->email = $em;
                                $data->user = wp_get_current_user()->user_login;
                                $data->save();
                                $em = "";
                            }

                        } catch (\Exception $e) {
                        }

                    }

//                  check data if all are vailable

//                    echo '<td>' . $id . '</td>';
                    echo '<td>' . $picture = isset($picture['data']['url']) ? "<img class='img-thumbnail' src='{$picture['data']['url']}'>" : 'Not found' . '</td>';
                    echo '<td><a target="_blank" href="' . $link . '">' . $name . '</a></td>';
                    echo '<td>' . $phone = ($phone == "") ? "<span class='label label-danger'><i class='glyphicon glyphicon-remove badge-danger'></i></span>" : $phone . '</td>';
                    echo '<td>' . $website = (isset($website)) ? $website : 'Not found' . '</td>';
                    if (isset($location['country'])) {
                        foreach ($location as $field => $value) {
                            if ($field == 'latitude' || $field == 'longitude') {

                            } else {
                                $lo .= $value . "<br>";
                            }

                        }
                        if (isset($location['latitude'])) {
                            $lo .= '<a class="btn btn-primary btn-xs" target="_blank" href="http://maps.google.com/?q=' . $location['latitude'] . ',' . $location['longitude'] . '">Show Map</a>';
                        }
                        echo '<td>' . $lo . '</td>';
                    } else {
                        echo '<td>' . "<span class='label label-danger'><i class='glyphicon glyphicon-remove badge-danger'></i></span>" . '</td>';
                    }
                    if (is_array($emails)) {
                        foreach ($emails as $email) {
                            $em .= $email;
                        }
                        echo '<td>' . $em . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    }
                    echo '<td>' . $likes . '</td>';
                    echo '<td>' . $about . '</td>';

                    echo '</tr>';
                }
                echo '</tbody><tfoot>
                            <tr> 
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Emails</th>
                                <th>Likes</th>
                                <th>About</th>
                            </tr>
                            </tfoot>
                        </table>';
//                print_r($response);
            } elseif ($type == 'user') {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,name,picture,link,age_range,gender' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Age range</th>
                                <th>Gender</th>
                                <th>Profile</th>
                            </tr>
                            </thead>

                            <tbody>';

                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $picture = "";
                    $name = "";
                    $age_range = "";
                    $gender = "";

                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['picture'])) {
                            $picture = $data['picture'];
                        }

                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }
                        if (isset($data['link'])) {
                            $link = $data['link'];
                        }
                        if (isset($data['age_range'])) {
                            $age_range = $data['age_range'];
                        }
                        if (isset($data['gender'])) {
                            $gender = $data['gender'];
                        }
                    }
//                  check data if all are vailable
                    echo '<td>' . $id . '</td>';
                    echo '<td>' . $picture = isset($picture['data']['url']) ? "<img src='{$picture['data']['url']}'>" : 'Not found' . '</td>';
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $age_range . '</td>';
                    echo '<td>' . $gender . '</td>';
                    echo '<td><a target="_blank" href="' . $link . '">Profile</a></td>';
//                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    echo '</tr>';
                }
                echo '</tbody>
                            <tfoot>
                            <tr>   
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Age range</th>
                                <th>Gender</th>
                                <th>Profile</th>
                            </tr>
                            </tfoot>
                        </table>';
            } elseif ($type == "event") {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,picture,name,place,attending_count,interested_count,noreply_count,declined_count,start_time,end_time,description,link,owner{name,link,picture}' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                
                                <th>Name</th>
                                <th>Place</th>
                                <th>End time</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>More info</th>
                                
                            </tr>
                            </thead>

                            <tbody>';

                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $name = "";
                    $location = "";
                    $end_time = "";
                    $description = "";
                    $lo = "";

                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['place'])) {
                            $location = $data['place'];
                        }
                        if (isset($data['end_time'])) {
                            $end_time = $data['end_time'];
                        }

                        if (isset($data['description'])) {
                            $description = $data['description'];
                        }
                        if (isset($data['id'])) {
                            $link = $data['id'];
                        }


                    }
//                  check data if all are vailable

                    echo '<td><img class="img-thumbnail" src="' . $data['picture']['data']['url'] . '"><br><a target="_blank" href="https://facebook.com/' . $link . '">' . $name . '</a></td>';
                    if (isset($location['location']['country'])) {
                        foreach ($location['location'] as $field => $value) {
                            if ($field == 'latitude' || $field == 'longitude') {

                            } else {
                                $lo .= $value . "<br>";
                            }

                        }
                        if (isset($location['location']['latitude'])) {
                            $lo .= '<a class="btn btn-primary btn-xs" target="_blank" href="http://maps.google.com/?q=' . $location['location']['latitude'] . ',' . $location['location']['longitude'] . '">Show Map</a>';
                        }
                        echo '<td>' . $lo . '</td>';
                    } else {
                        echo '<td>' . "<span class='label label-danger'><i class='glyphicon glyphicon-remove badge-danger'></i></span>" . '</td>';
                    }
                    echo '<td>' . SettingsController::date($end_time) . '</td>';
                    echo '<td>' . $description . '</td>';
                    echo '<td><img class="img-circle" src="' . $data['owner']['picture']['data']['url'] . '"><br><a target="_blank" href="' . $data['owner']['link'] . '">' . $data['owner']['name'] . '</a></td>';
                    echo '<td>' .
                        '<span class="text-green">Attending ' . $data['attending_count'] . '</span><br>' .
                        '<span class="text-blue">Interested ' . $data['interested_count'] . '</span><br>' .
                        '<span class="text-yellow">Noreply ' . $data['noreply_count'] . '</span><br>' .
                        '<span class="text-red">Declined ' . $data['declined_count'] . '</span><br>' .
                        '</td>';
//                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    echo '</tr>';
                }
                echo '</tbody>
                            <tfoot>
                            <tr>   
                                
                                <th>Name</th>
                                <th>Place</th>
                                <th>End time</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>More info</th>
                            </tr>
                            </tfoot>
                        </table>';
            } elseif ($type == 'group') {
                $response = $fb->get('search?q=' . $query . '&type=' . $type . '&fields=id,name,privacy,link,picture,description,owner{id,name,picture,link}' . '&limit=' . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Privacy</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>Link</th>
                            </tr>
                            </thead>

                            <tbody>';

                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $name = "";
                    $privacy = "";

                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['id'])) {
                            $link = $data['id'];
                        }
                        if (isset($data['privacy'])) {
                            $privacy = $data['privacy'];
                        }
                        if (isset($data['owner'])) {
                            $owner_id = $data['owner']['id'];
                            $owner_name = $data['owner']['name'];
                            $owner_picture = $data['owner']['picture']['data']['url'];
                        }


                    }
//                  check data if all are vailable
                    echo '<td>' . $id . '</td>';
                    echo '<td><img class="img-thumbnail" src="' . $data['picture']['data']['url'] . '"><br><a target="_blank" href="https://facebook.com/' . $link . '">' . $name . '</a></td>';
                    echo '<td>' . $privacy . '</td>';
                    if (isset($data['description'])) {
                        echo '<td>' . $data['description'] . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    }
                    if (isset($data['owner'])) {
                        echo '<td><img src="' . $data['owner']['picture']['data']['url'] . '"><br>' . '<a target="_blank" href="' . $data['owner']['link'] . '">' . $data['owner']['name'] . '</a></td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    }
                    echo '<td><a target="_blank" href="https://facebook.com/' . $data['id'] . '">Link</a>';

                    echo '</tr>';
                }
                echo '</tbody>
                            <tfoot>
                            <tr>   
                                <th>ID</th>
                                <th>Name</th>
                                <th>Privacy</th>
                                <th>Description</th>
                                <th>Owner</th>
                                <th>Link</th>
                            </tr>
                            </tfoot>
                        </table>';
            } elseif ($type == 'place') {

                $response = $fb->get("search?q=" . $query . "&type=" . $type . "&fields=id,name,category,picture,location,link,website,phone,description,about" . "&limit=" . $limit, $token)->getDecodedBody();
                echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>Name</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>About</th>
                            </tr>
                            </thead>
                            <tbody>';
                foreach ($response['data'] as $data) {
                    $id = "";
                    $link = "";
                    $picture = "";
                    $name = "";
                    $phone = "";
                    $website = "";
                    $location = "";
                    $about = "";
                    $lo = "";
                    $em = "";
                    $description = "";
                    echo '<tr>';
//                    check if all fields are available
                    foreach ($data as $field => $value) {
                        if (isset($data['id'])) {
                            $id = $data['id'];
                        }
                        if (isset($data['picture'])) {
                            $picture = $data['picture']['data']['url'];
                        }

                        if (isset($data['name'])) {
                            $name = $data['name'];
                        }

                        if (isset($data['phone'])) {
                            $phone = $data['phone'];
                        }
                        if (isset($data['website'])) {
                            $website = $data['website'];
                        }

                        if (isset($data['location'])) {
                            $location = $data['location'];
                        }
                        if (isset($data['link'])) {
                            $link = $data['link'];
                        }
                        if(isset($data['emails'])){
                            $emails = $data['emails'];
                        }

                    }

                    if ($phone != "" || $emails != "") {
                        if (is_array($emails)) {
                            foreach ($emails as $email) {
                                $em .= $email . " ";
                            }

                        }

                        try {
                            if (!Data::where('name', $name)->exists()) {
                                $data = new Data();
                                $data->name = $name;
                                $data->phone = $phone;
                                $data->email = $em;
                                $data->user = wp_get_current_user()->user_login;
                                $data->save();
                                $em = "";
                            }

                        } catch (\Exception $e) {
                        }

                    }
//                  check data if all are vailable

                    echo '<td><img class="img-thumbnail" src="' . $picture . '"><br>' . '<a target="_blank" href="' . $link . '">' . $name . '</a></td>';
                    echo '<td>' . $data['category'] . '</td>';
                    if ($phone != "") {
                        echo '<td>' . $phone . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    }
                    echo '<td>' . $website . '</td>';
                    if (isset($location['country'])) {
                        foreach ($location as $field => $value) {
                            if ($field == 'latitude' || $field == 'longitude') {

                            } else {
                                $lo .= $value . "<br>";
                            }

                        }
                        if (isset($location['latitude'])) {
                            $lo .= '<a class="btn btn-primary btn-xs" target="_blank" href="http://maps.google.com/?q=' . $location['latitude'] . ',' . $location['longitude'] . '">Show Map</a>';
                        }
                        echo '<td>' . $lo . '</td>';
                    } else {
                        echo '<td>' . "<span class='label label-danger'><i class='glyphicon glyphicon-remove badge-danger'></i></span>" . '</td>';
                    }
                    if (isset($data['description'])) {
                        echo '<td>' . $data['description'] . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    }

                    if (isset($data['about'])) {
                        echo '<td>' . $data['about'] . '</td>';
                    } else {
                        echo '<td> <span class=\'label label-danger\'><i class=\'glyphicon glyphicon-remove badge-danger\'></i></span> </td>';
                    }


//
                    echo '</tr>';
                }
                echo '</tbody><tfoot>
                            <tr> 
                                <th>Name</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>About</th>
                            </tr>
                            </tfoot>
                        </table>';
            }


        } catch (FacebookSDKException $sdk) {
            return $sdk->getMessage();

        } catch (\Exception $e) {
            return $e->getMessage();
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